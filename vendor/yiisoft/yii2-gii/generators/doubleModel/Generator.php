<?php

namespace yii\gii\generators\doubleModel;

use common\utils\query\CustomActiveQuery;
use Yii;
use yii\gii\CodeFile;

/**
 *
 * @property string $name
 */
class Generator extends \yii\gii\generators\model\Generator
{
    public $generateDataTable = true;
    public $generateBeforeSave = false;
    public $generateQuery = true;
    public $tableNs = 'backend\models\table';
    public $ns = 'backend\models';
    public $queryNs = 'backend\models\query';
    public $queryBaseClass = CustomActiveQuery::class;
    public $messageCategory = 'backend';
    public $generateBaseOnly = false;
    public $createdAt = 'created_date';
    public $updatedAt = 'modified_date';
    public $createdBy = 'created_by';
    public $updatedBy = 'modified_by';
    public $UUIDColumn = '';
    public $enableI18N = false;
    public $skippedColumns = 'created_date, modified_date, created_by, modified_by, status, id';
    public $defaultLanguage = 'vi';
    public $isModal = false;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Double Model Generator';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'Tạo ActiveRecord, bao gồm: file model, file model base, file datatable(nếu có), file custom active query(nếu có)';
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return ['model.php', 'modelbase.php'];
    }

    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['UUIDColumn', 'generateBaseOnly', 'generateDataTable', 'generateBeforeSave', 'UUIDColumn', 'createdAt', 'updatedAt', 'createdBy', 'updatedBy', 'defaultLanguage', 'isModal', 'skippedColumns'], 'safe'],
            ]);
    }

//    public function stickyAttributes()
//    {
//        return array_merge(parent::stickyAttributes(), ['generateQuery']);
//    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),
            [
                'generateDataTable'  => 'Tạo data table',
                'generateBeforeSave' => 'Tạo giá trị mặc định trước khi save',
                'generateQuery'      => 'Sử dụng cutom active query',
                'messageCategory'    => 'Tên category đa ngôn ngữ',
                'enableI18N'         => 'Đa ngôn ngữ',
                'UUIDColumn'         => 'UUID Column',
                'generateBaseOnly'   => 'Chỉ tạo model base',
                'createdAt'          => 'Ngày tạo',
                'updatedAt'          => 'Ngày cập nhật',
                'createdBy'          => 'Người tạo',
                'updatedBy'          => 'Người cập nhật',
                'isModal'            => 'Sử dụng modal',
                'defaultLanguage'    => 'Ngôn ngữ mặc định',
                'tableName'          => 'Tên table trong database',
                'modelClass'         => 'Tên class tương ứng',
                'skippedColumns'      => 'Các cột bỏ qua',
            ]);
    }

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidParamException
     */
    public function generate()
    {
        $files     = [];
        $relations = $this->generateRelations();
        $db        = $this->getDbConnection();

        foreach ($this->getTableNames() as $tableName) {
            // model :
            $modelClassName = $this->generateClassName($tableName);
            $queryClassName = $this->generateQuery ? $this->generateQueryClassName($modelClassName) : false;
            $tableSchema    = $db->getTableSchema($tableName);
            $params         = [
                'tableName'      => $tableName,
                'className'      => $modelClassName,
                'queryClassName' => $queryClassName,
                'tableSchema'    => $tableSchema,
                'labels'         => $this->generateLabels($tableSchema),
                'rules'          => $this->generateRules($tableSchema),
                'relations'      => isset($relations[$tableName]) ? $relations[$tableName] : [],
            ];
            if ( ! $this->generateBaseOnly) {
                $files[] = new CodeFile(
                    Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/' . $modelClassName . '.php', $this->render('model.php', $params)
                );
            }
            $files[] = new CodeFile(
                Yii::getAlias('@' . str_replace('\\', '/', $this->ns)) . '/base/' . $modelClassName . 'Base.php', $this->render('modelbase.php', $params)
            );
            if ($this->generateDataTable) {
                $params  = [
                    'tableName'      => $tableName,
                    'className'      => $modelClassName,
                    'tableClassName' => $modelClassName . 'Table',
                    'tableNs'        => $this->tableNs,
                    'labels'         => $this->generateLabels($tableSchema),
                ];
                $files[] = new CodeFile(
                    Yii::getAlias('@' . str_replace('\\', '/', $this->tableNs)) . '/' . $modelClassName . 'Table.php', $this->render('table.php', $params)
                );
            }
            // query :
            if ($queryClassName && ! file_exists(Yii::getAlias('@' . str_replace('\\', '/', $this->queryNs)) . '/' . $queryClassName . '.php')) {
                $params['className']      = $queryClassName;
                $params['modelClassName'] = $modelClassName;
                $files[]                  = new CodeFile(
                    Yii::getAlias('@' . str_replace('\\', '/', $this->queryNs)) . '/' . $queryClassName . '.php', $this->render('query.php', $params)
                );
            }
        }

        return $files;
    }
}
