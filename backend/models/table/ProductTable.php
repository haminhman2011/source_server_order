<?php

namespace backend\models\table;

use \backend\models\Product;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class ProductTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách Product
.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-product' title='Xem' data-id='$model->id' href='".Url::to(['view', 'id' => $model->id])."'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) {
                $htmlAction .= " <a class='btn green-steel btn-update-product' title='Sửa' data-id='$model->id' href='".Url::to(['update', 'id' => $model->id])."'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            }
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'delete' )) {
                $htmlAction .= " <button class='btn red-mint btn-delete-product' title='Xóa' data-id='$model->id' data-url='".Url::to(['delete'])."'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            }
            // $url = Yii::getAlias('@web').'/uploads/product/'.$model->image;
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
				$model->code,
				$model->name,
				number_format( $model->price, 2 ),
				$model->product_type_id !== null ? $model->productType->displayText() : '',
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm Product.
	* @return Product[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
        $models = Product::find()->joinWith(['productType'])
                                            ->where(['product.status' => 1])
                                            ->andFilterWhere([
                                            	'and',
                                            	
                                            	['like', 'code', $this->filterDatas['code']],
                                            	['like', 'name', $this->filterDatas['name']],
                                            	['product_type_id' => $this->filterDatas['product_type_id']],
                                            	])->distinct();

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
				$field = 'price';
				break;
			case '3':
				$field = 'image';
				break;
			case '4':
				$field = 'note';
				break;
			case '5':
				$field = 'product_type_id';
				break;
			case '6':
				$field = 'code';
				break;
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>