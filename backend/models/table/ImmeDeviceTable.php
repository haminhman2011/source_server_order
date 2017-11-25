<?php

namespace backend\models\table;

use \backend\models\ImmeDevice;
use common\utils\table\DataTable;
use yii\helpers\Url;
use Yii;

class ImmeDeviceTable extends DataTable
{
    /*public function __construct() {
		parent::__construct();
        $arguments = Yii::$app->request->post();
	}*/

	/**
	* Tạo danh sách ImmeDevice
.
	* @return array
    * @throws \yii\base\InvalidParamException
	*/
	public function getData()
	{
		$models = $this->getModels();
		$dataArray = [];
		foreach ($models as $model) {
            $htmlAction  = "<a class='btn yellow-gold link-view-imme-device' title='Xem' data-id='$model->id' href='".Url::to(['view', 'id' => $model->id])."'><i class='fa fa-eye' aria-hidden='true'></i> </a>";
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) {
                $htmlAction .= " <a class='btn green-steel btn-update-imme-device' title='Sửa' data-id='$model->id' href='".Url::to(['update', 'id' => $model->id])."'><i class='fa fa-pencil' aria-hidden='true'></i> </a>";
            }
            if ( Yii::$app->permission->can( Yii::$app->controller->id , 'delete' )) {
                $htmlAction .= " <button class='btn red-mint btn-delete-imme-device' title='Xóa' data-id='$model->id' data-url='".Url::to(['delete'])."'><i class='fa fa-trash' aria-hidden='true'></i> </button>";
            }
			$dataArray[] = [
                "<label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'><input class='cb-single' type='checkbox' data-id='$model->id'><span></span></label>",
				$model->name,
				$model->system,
				$model->imei,
				$model->ip,
				$htmlAction
			];
		}
		return $dataArray;
	}

	/**
	* Tìm ImmeDevice.
	* @return ImmeDevice[].
	*/
	public function getModels()
	{
		$column = $this->getColumn();
        $models = ImmeDevice::find()->where(['imme_device.status' => 1])
                                            ->andFilterWhere([
                                            	'and',
                                            	['imei' => $this->filterDatas['imei']],
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
				$field = 'system';
				break;
			case '3':
				$field = 'imei';
				break;
			case '4':
				$field = 'ip';
				break;
			default:
				$field = 'id';
				break;
		}
		return $field;
	}
}

?>