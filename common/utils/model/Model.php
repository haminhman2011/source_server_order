<?php

namespace common\utils\model;

use common\utils\helpers\ArrayHelper;
use common\utils\helpers\StringHelper;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;

/**
 * Class Model
 * @package common\utils\model
 */
class Model extends \yii\base\Model
{
    /**
     * Lưu data dạng cha/con
     *
     * @param $model
     * @param array $subDetailDatas
     * @param ModelBuilder $builder
     *
     * @return array|bool
     * @throws \yii\base\InvalidCallException
     */
    public static function saveMultiple(ActiveRecord $model, ModelBuilder $builder, $subDetailDatas = null)
    {
        $modelId = $builder->mainModelId;
        /** @var ActiveRecord $subModel */
        $subModel = $builder->subModel;
        /** @var ActiveRecord $subModelDetail */
        $subModelDetail = $builder->subDetailModel;
        $subForeignKey  = $builder->subForeignKey;
        $foreignKey     = $builder->foreignKey;
        $relation       = $builder->relation;
        $subRelation    = $builder->subRelation;

        try {
            list($modelSubs, $deletedIDs, $oldIDs) = ModelBuilder::initSubModel([$modelId, $model, $subModel, $relation]);
            if (empty($modelSubs)) {
                if (count($oldIDs) > 0) {
                    $subModel::updateAll(['status' => -1], ['in', 'id', $oldIDs]);
                }

                return true;
            }

            if ( ! empty($deletedIDs)) {
                $subModel::updateAll(['status' => -1], ['in', 'id', $deletedIDs]);
                if ( ! empty($subModelDetail)) {
                    $subModelDetail::updateAll(['status' => -1], ['in', $subForeignKey, $deletedIDs]);
                }
            }
            if (empty($subDetailDatas)) {
                /** @var ActiveRecord[] $modelSubs */
                foreach ($modelSubs as $key => $modelSub) {

                    if ($modelSub->isNewRecord) {
                        $modelSub->$foreignKey = $model->id;
//						$modelSub->link( Inflector::variablize( $model::tableName() ), $model );
                    }
                    if ( ! $modelSub->save()) {
                        Yii::error($modelSub->getErrors() . "\n" . __FUNCTION__, 'system');

                        return $modelSub->getErrors();
                    }
                }

                return true;
            }

            /** @var ActiveRecord[] $modelSubs */
            foreach ($modelSubs as $key => $modelSub) {
                if ($modelSub->isNewRecord) {
                    $modelSub->$foreignKey = $model->id;
//					$modelSub->link( Inflector::variablize( $model::tableName() ), $model );
                }
                if ($modelSub->save()) {
                    if ( ! is_array($subDetailDatas) || ! array_key_exists($key, $subDetailDatas) || ! is_array($subDetailDatas[$key])) {
                        continue;
                    }
                    if ( ! empty($subModelDetail)) {
                        /** @var ActiveRecord[] $modelSubDetails */
                        $modelSubDetails = ModelBuilder::createMultiple($subModelDetail::className(), [], $subDetailDatas[$key]);
                        self::loadMultiple($modelSubDetails, $subDetailDatas[$key], '');
                        $tempSubModelDetails = $modelSub->$subRelation;
                        $oldIDs              = ArrayHelper::map($tempSubModelDetails, 'id', 'id');
                        if (empty($modelSubDetails) && count($oldIDs) > 0) {
                            $subModelDetail::updateAll(['status' => -1], ['in', 'id', $oldIDs]);
                        } else {
                            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelSubDetails, 'id', 'id')));
                            if ( ! empty($deletedIDs)) {
                                $subModelDetail::updateAll(['status' => -1], ['in', 'id', $deletedIDs]);
                            }
                        }

                        if ( ! empty($modelSubDetails)) {
                            $lastIndex = count($subDetailDatas[$key]);
                            foreach ($modelSubDetails as $detailKey => $modelSubDetail) {
                                if ($detailKey < $lastIndex) {
                                    $modelSubDetail->$subForeignKey = $modelSub->id;
                                    if ( ! $modelSubDetail->save()) {
                                        Yii::error($modelSubDetail->errors . "\n" . __FUNCTION__, 'system');

                                        return $modelSubDetail->errors;
                                    }
                                }
                            }
                        }
                    }
                } else {
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            Yii::error($e->getMessage(), 'system');

            return false;
        }
    }

    /**
     * Chức năng copy model, mặc đình thì cột name sẽ thêm ' - copy'
     * Nếu $modelDetails là associative array: mainModel --> subModels --> subDetailModels, ngược lại mainModel --> subModels
     *
     * Model::copy($style, ['styleSizes', 'styleColors']) or Model::copy($bom, ['materialBom' => 'materialBomDetails'])
     *
     * @param ActiveRecord $originModel
     * @param array $modelDetails
     * @param string $field
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function copy($originModel, array $modelDetails = array(), $field = 'name')
    {
        $modelClass             = $originModel::className();
        $newModel               = new $modelClass(['attributes' => $originModel->getAttributes()]);
        $newModel->$field       .= ' - copy';
        $newModel->created_date = time();

        if ($newModel->save(false)) {
            if ( ! empty($modelDetails)) {
                if (ArrayHelper::isAssociative($modelDetails)) {
                    foreach ($modelDetails as $modelDetail => $subModelDetail) {
                        /** @var ActiveRecord[] $relationDatas */
                        $relationDatas = $originModel->$modelDetail;
                        if ( ! empty($relationDatas)) {
                            $subClassName = Inflector::camel2id(Inflector::singularize($modelDetail), '_');

                            foreach ($relationDatas as $relationData) {
                                $subModel = new $subClassName(['attributes' => $relationData->getAttributes()]);
                                $subModel->link(Inflector::variablize($newModel::tableName()), $newModel);
                                $subModel->id           = '';
                                $subModel->created_date = time();
                                if ($subModel->save(false)) {
                                    $relationDetailDatas = $originModel->$subModelDetail;
                                    $subDetailClassName  = Inflector::camel2id(Inflector::singularize($subModelDetail), '_');
                                    /** @var ActiveRecord[] $relationDetailDatas */
                                    foreach ($relationDetailDatas as $relationDetailData) {
                                        $subDetailModel = new $subDetailClassName(['attributes' => $relationDetailData->getAttributes()]);
                                        $subDetailModel->link(Inflector::variablize($subModel::tableName()), $subModel);
                                        $subDetailModel->id           = '';
                                        $subDetailModel->created_date = time();
                                        if ( ! $subDetailModel->save(false)) {
                                            return false;
                                        }
                                    }
                                } else {
                                    return false;
                                }
                            }
                        }
                    }

                    return true;
                }

                foreach ($modelDetails as $modelDetail) {
                    /** @var ActiveRecord[] $relationAttributes */
                    $relationAttributes = $originModel->$modelDetail;
                    if ( ! empty($relationAttributes)) {
                        $detailDatas  = [];
                        $subClassName = Inflector::camel2id(Inflector::singularize($modelDetail), '_');
                        $relationId   = Inflector::camel2id(StringHelper::basename($modelClass), '_') . '_id';
                        $attributes   = $relationAttributes[0]->attributes();
                        foreach ($relationAttributes as $key => $relationAttribute) {
                            $detailDatas[]                     = $relationAttribute->attributes;
                            $detailDatas[$key][$relationId]    = $newModel->id;
                            $detailDatas[$key]['id']           = '';
                            $detailDatas[$key]['created_date'] = time();
                        }
                        Yii::$app->db->createCommand()->batchInsert($subClassName, $attributes, $detailDatas)->execute();
                    }
                }

                return true;
            }

            return true;
        }

        return false;
    }

    /**
     * Chức năng save file
     *
     * Model::saveFile('uploads/user/', $user, $fileName)
     *
     * @param $path
     * @param $model
     * @param string $fileName mặc định là file, nên đặt giống tên field trong model
     *
     * @return bool Lưu file thành công hay không
     * @throws \yii\base\Exception
     */
    public static function saveFile($path, &$model, $fileName = 'file')
    {
        if ( ! empty($_FILES) && array_key_exists($fileName, $_FILES)) {
            if ( ! is_dir($path)) {
                FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
            }
            if ( ! is_array($_FILES[$fileName]['name'])) {
                if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $path . basename($_FILES[$fileName]['name']))) {
                    $model->$fileName = $_FILES[$fileName]['name'];

                    return true;
                }

                return false;
            }

            $files = $_FILES[$fileName];
            /** @var array $files */
            foreach ($files as $file) {
                if (move_uploaded_file($file['tmp_name'], $path . basename($file['name']))) {
                    $model->$fileName .= $file['name'] . ', ';
                } else {
                    return false;
                }
            }
            $model->$fileName = substr($model->$fileName, 0, -2);

            return true;
        }

        $model->$fileName = '';

        return true;
    }
}