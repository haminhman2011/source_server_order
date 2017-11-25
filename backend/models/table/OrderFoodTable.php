<?php

namespace backend\models\table;

use \backend\models\OrderFood;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class OrderFoodTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách OrderFood
.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-order-food' title='Xem' data-id='$model->id' href='".Url::to(['view', 'id' => $model->id])."'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) {
                $htmlAction .= " <a class='btn green-steel btn-update-order-food' title='Sửa' data-id='$model->id' href='".Url::to(['update', 'id' => $model->id])."'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            }
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'delete' )) {
                $htmlAction .= " <button class='btn red-mint btn-delete-order-food' title='Xóa' data-id='$model->id' data-url='".Url::to(['delete'])."'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            }
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
				$model->full_name,
				$model->phone,
				$model->email,
				$model->info_order,
				$model->note,
				\Yii::$app->formatter->asDate($model->created_date_order),
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm OrderFood.
	* @return OrderFood[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
        $models = OrderFood::find()->where(['order_food.status' => 1])
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
				$field = 'full_name';
				break;
			case '2':
				$field = 'phone';
				break;
			case '3':
				$field = 'email';
				break;
			case '4':
				$field = 'info_order';
				break;
			case '5':
				$field = 'note';
				break;
			case '6':
				$field = 'created_date_order';
				break;
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>