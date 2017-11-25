<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\Product;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\ProductTable;
use yii\helpers\Url;

use common\utils\model\Model;

class ProductController extends Controller
{
    /**
    * Hiện danh sách Product.
    *
    * @return string
    */
    public function actionIndex()
    {
		$product = new Product();
        return $this->render('index', ['product' => $product]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new ProductTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết Product.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $productId = Yii::$app->request->get('id', '');
        $product = $this->findModel($productId);
		return $this->render('view', [
			'product' => $product
		]);
	}

    /**
    * Hiện trang create Product.
    *
    * @return string
    */
    public function actionCreate()
    {
		$product = new Product();
		return $this->render('create', [
			'product' => $product,
		]);
    }

    /**
    * Hiện trang update Product.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $productId = Yii::$app->request->get('id', '');
		$product = $this->findModel($productId);
		return $this->render('update', [
			'product' => $product
		]);
	}

    /**
    * Lưu Product model.
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
		$productId = Yii::$app->request->post('Product')['id'];
		$product   = $productId != '' ? $this->findModel($productId) : new Product();
        $productCode = Yii::$app->request->post('Product')['code'];

        if($productId == ''):
            $check = Product::find()->where(['status'=>1,'code'=>$productCode]);
        else:
            $check = Product::find()->where('status = 1 and code = "'.$productCode.'" and id != '.$productId );
        endif;
        $check = $check->one();
        if(isset($check)):
            return 'error';
            die;
        endif;
        if($product->isNewRecord){
            Model::saveFile('uploads/product/', $product, 'image');
        }else{
            if($product->image == ""){
                Model::saveFile('uploads/product/', $product, 'image');
            }else{
                if (! array_key_exists('image', $_FILES)) {
                    $product->image = '';
                }
                elseif ($product->image !== $_FILES['image']['name']) {
                    Model::saveFile('uploads/product/', $product, 'image');
                }
            }
        }
		if ( $product->load( Yii::$app->request->post() ) ) {
			if ( $product->save() ) {
				return Url::to( [ 'index' ], true );
			}

			return $this->asJson($product->errors);
		}

		throw new ServerErrorHttpException( Yii::t('yii', 'An internal server error occurred.') );
	}


    /**
    * Cập nhật status Product.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $productId = Yii::$app->request->post( 'id', '');
        $product = Product::findOne(['id' => $productId, 'status' => 1]);
        return $product != null && $product->updateAttributes( [ 'status' => -1 ] ) > 0 ? 'success' : 'fail';
    }

    /**
     * Select2 ajax Product.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectProduct() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            // $product_id = Yii::$app->request->post( 'product_id', [] );
             // var_dump($product_id);
            $offset = ($page - 1) * 10;
            $products = Product::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'name', $query ] )->select( [ 'id', 'name' ] );

            return $this->asJson( [
                'total_count' => $products->count(),
                'items'       => $products->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}


	/**
	* Tìm Product model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $productId
	* @return Product the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($productId) {
        if (($model = Product::findOne(['id' => $productId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }
}
