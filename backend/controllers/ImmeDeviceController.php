<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\ImmeDevice;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\ImmeDeviceTable;
use yii\helpers\Url;

class ImmeDeviceController extends Controller
{
    /**
    * Hiện danh sách ImmeDevice.
    *
    * @return string
    */
    public function actionIndex()
    {
		$immeDevice = new ImmeDevice();
        return $this->render('index', ['immeDevice' => $immeDevice]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new ImmeDeviceTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết ImmeDevice.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $immeDeviceId = Yii::$app->request->get('id', '');
        $immeDevice = $this->findModel($immeDeviceId);
		return $this->render('view', [
			'immeDevice' => $immeDevice
		]);
	}

    /**
    * Hiện trang create ImmeDevice.
    *
    * @return string
    */
    public function actionCreate()
    {
		$immeDevice = new ImmeDevice();
		return $this->render('create', [
			'immeDevice' => $immeDevice,
		]);
    }

    /**
    * Hiện trang update ImmeDevice.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $immeDeviceId = Yii::$app->request->get('id', '');
		$immeDevice = $this->findModel($immeDeviceId);
		return $this->render('update', [
			'immeDevice' => $immeDevice
		]);
	}

    /**
    * Lưu ImmeDevice model.
    *
    * @return string:
    * - url: lưu thành công
    * - json: lưu thất bại, trả vể object lỗi
    * - An internal server error occurred: không load được model
    * @throws \yii\base\InvalidParamException
    * @throws NotFoundHttpException
    * @throws ServerErrorHttpException
    * @throws \yii\base\Exception
    * @throws \yii\db\Exception
    * @throws \yii\base\InvalidCallException
    */
	public function actionSave() {
		$immeDeviceId = Yii::$app->request->post('ImmeDevice')['id'];
		$immeDevice   = $immeDeviceId != '' ? $this->findModel($immeDeviceId) : new ImmeDevice();

		if ( $immeDevice->load( Yii::$app->request->post() ) ) {
			if ( $immeDevice->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($immeDevice->errors);
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}


    /**
    * Cập nhật status ImmeDevice.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $immeDeviceId = Yii::$app->request->post( 'id', '');
        $immeDevice = ImmeDevice::findOne(['id' => $immeDeviceId, 'status' => 1]);
        return $immeDevice != null && $immeDevice->updateAttributes( [ 'status' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax ImmeDevice.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectImmeDevice() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $immeDevices = ImmeDevice::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'name', $query ] )->select( [ 'id', 'name' ] );

            return $this->asJson( [
                'total_count' => $immeDevices->count(),
                'items'       => $immeDevices->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}


	/**
	* Tìm ImmeDevice model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $immeDeviceId
	* @return ImmeDevice the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($immeDeviceId) {
        if (($model = ImmeDevice::findOne(['id' => $immeDeviceId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
