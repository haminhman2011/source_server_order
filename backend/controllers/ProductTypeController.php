<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\ProductType;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\ProductTypeTable;
use yii\helpers\Url;

use common\utils\model\Model;

class ProductTypeController extends Controller
{
    /**
    * Hiện danh sách ProductType.
    *
    * @return string
    */
    public function actionIndex()
    {
		$productType = new ProductType();
        return $this->render('index', ['productType' => $productType]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new ProductTypeTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết ProductType.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $productTypeId = Yii::$app->request->get('id', '');
        $productType = $this->findModel($productTypeId);
		return $this->render('view', [
			'productType' => $productType
		]);
	}

    /**
    * Hiện trang create ProductType.
    *
    * @return string
    */
    public function actionCreate()
    {
		$productType = new ProductType();
		return $this->render('create', [
			'productType' => $productType,
		]);
    }

    /**
    * Hiện trang update ProductType.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $productTypeId = Yii::$app->request->get('id', '');
		$productType = $this->findModel($productTypeId);
		return $this->render('update', [
			'productType' => $productType
		]);
	}

    /**
    * Lưu ProductType model.
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
		$productTypeId = Yii::$app->request->post('ProductType')['id'];
		$productType   = $productTypeId != '' ? $this->findModel($productTypeId) : new ProductType();
        if($productType->isNewRecord){
            Model::saveFile('uploads/product_type/', $productType, 'image');
        }else{
            if($productType->image == ""){
                Model::saveFile('uploads/product_type/', $productType, 'image');
            }else{
                if (! array_key_exists('image', $_FILES)) {
                    $productType->image = '';
                }
                elseif ($productType->image !== $_FILES['image']['name']) {
                    Model::saveFile('uploads/product_type/', $productType, 'image');
                }
            }
        }
        
		if ( $productType->load( Yii::$app->request->post() ) ) {
			if ( $productType->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($productType->errors);
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}


    /**
    * Cập nhật status ProductType.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $productTypeId = Yii::$app->request->post( 'id', '');
        $productType = ProductType::findOne(['id' => $productTypeId, 'status' => 1]);
        return $productType != null && $productType->updateAttributes( [ 'status' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax ProductType.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectProductType() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $productTypes = ProductType::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'name', $query ] )->select( [ 'id', 'name' ] );

            return $this->asJson( [
                'total_count' => $productTypes->count(),
                'items'       => $productTypes->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}


	/**
	* Tìm ProductType model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $productTypeId
	* @return ProductType the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($productTypeId) {
        if (($model = ProductType::findOne(['id' => $productTypeId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
