<?php

namespace backend\models\table;

use \backend\models\DetailOrderFood;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class DetailOrderFoodTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách DetailOrderFood
.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-detail-order-food' title='Xem' data-id='$model->id' href='".Url::to(['view', 'id' => $model->id])."'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) {
                $htmlAction .= " <a class='btn green-steel btn-update-detail-order-food' title='Sửa' data-id='$model->id' href='".Url::to(['update', 'id' => $model->id])."'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            }
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'delete' )) {
                $htmlAction .= " <button class='btn red-mint btn-delete-detail-order-food' title='Xóa' data-id='$model->id' data-url='".Url::to(['delete'])."'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            }
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
				$model->order_food_id !== null ? $model->orderFood->displayText() : '',
				$model->product_id !== null ? $model->product->displayText() : '',
				number_format( $model->quantity ),
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm DetailOrderFood.
	* @return DetailOrderFood[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
        $models = DetailOrderFood::find()->joinWith(['orderFood','product'])
                                            ->where(['detail_order_food.status' => 1])
                                            ->andFilterWhere([])->distinct();

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
				$field = 'order_food_id';
				break;
			case '2':
				$field = 'product_id';
				break;
			case '3':
				$field = 'quantity';
				break;
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>