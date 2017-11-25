<?php

namespace backend\models\table;

use \backend\models\ProductType;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class ProductTypeTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách ProductType
.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-product-type' title='Xem' data-id='$model->id' href='".Url::to(['view', 'id' => $model->id])."'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) {
                $htmlAction .= " <a class='btn green-steel btn-update-product-type' title='Sửa' data-id='$model->id' href='".Url::to(['update', 'id' => $model->id])."'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            }
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'delete' )) {
                $htmlAction .= " <button class='btn red-mint btn-delete-product-type' title='Xóa' data-id='$model->id' data-url='".Url::to(['delete'])."'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            }
            $urlImage = Yii::getAlias('@web').'/uploads/product_type/'.$model->image;
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
				$model->name,
			
				'<div class="fileinput-preview fileinput-exists thumbnail" style="width: 52px; height: 52px;">
                    <img src="'.$urlImage.'" alt="" style="width: 50px; height: 50px;">
                <div>',
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm ProductType.
	* @return ProductType[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
        $models = ProductType::find()->where(['product_type.status' => 1])
                                            ->andFilterWhere(['and', ['name' => $this->filterDatas['name']]])->distinct();

		$this->totalRecords = $models->count();
        return $models->limit($this->length)
						 ->offset($this->start)
						 ->orderBy([$column => $this->direction])
						 ->all();
	}

	/**
	 * Lấy cột muốn sắp xếp
	 * @return string
	 */
	public function getColumn()
	{
		switch ($this->column) {
			case '1':
				$field = 'name';
				break;
			case '2':
				$field = 'image';
				break;
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>