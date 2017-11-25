<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\Tables;
use backend\models\ImmeDevice;
use backend\models\Product;
use backend\models\DetailOrderFood;
use backend\models\OrderFood;
use backend\models\ProductType;
use common\utils\controller\Controller;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ApiDataController extends Controller{


	public $enableCsrfValidation = false;

 	public function behaviors() {
	  	return [
		    'access' => [
		    'class' => AccessControl::className(),
		    'rules' => [
			    [
			      'allow' => true,
			      'roles' => [ '?' ],
			    ],
		    ],
		   ]
	  	];
	}

	public function actionDataAll(){
		$imei = $_POST['imei'];
		$immeDevice = ImmeDevice::findOne(['status' => 1, 'imei' => $imei]);
		$data = array();

		if(isset($immeDevice)){
			$product = Product::findAll(['status' => 1]);
			foreach ($product as $key => $value) {
				$data[] = array(
					'id'		=> $value->id,
					'name'		=> $value->name,
					'price'		=> $value->price,
					'note'		=> $value->note,
					'code'		=> $value->code, 
					'image' 	=> Yii::getAlias('@web').'/uploads/product/'.$value->image,
				);
				
			}
			if (empty($product)) {
				return 'empty products';
			}
			return $this->asJson($data);
		}

		return 'empty';
	}

	public function actionProductType(){
		$imei = $_POST['imei'];
		$immeDevice = ImmeDevice::findOne(['status' => 1, 'imei' => $imei]);
		$data = array();

		if(isset($immeDevice)){
			$productType = ProductType::findAll(['status' => 1]);
			foreach ($productType as $key => $value) {
				$data[] =  array(
					'id' 		=> $value->id,
					'name'		=> $value->name,
					'image' 	=> Yii::getAlias('@web').'/uploads/product_type/'.$value->image,

				);
				
			}
			if (empty($productType)) {
				return 'empty products';
			}
			return $this->asJson([
						'datas'  => $data]);
		}

		return 'empty';
	}

	public function actionClassifyProduct(){
		$imei 				= $_POST["imei"];
		$product_type_id 		= $_POST["product_type_id"];
		$immeDevice = ImmeDevice::findOne(['status' => 1, 'imei' => $imei]);
		$product = Product::findAll(['status' => 1, 'product_type_id' => $product_type_id]);
		$data = array();
		if(isset($immeDevice) && isset($product)){
			foreach ($product as $key => $value) {
				$data[] = array(
					'id'		=> $value->id,
					'name'		=> $value->name,
					'price'		=> $value->price,
					'note'		=> $value->note,
					'code'		=> $value->code, 
					'image' 	=> Yii::getAlias('@web').'/uploads/product/'.$value->image,
				);
			}
			if (empty($product)) {
				return 'empty products';
			}
			return $this->asJson($data);
		}
		return 'empty';

	}

	public function actionSaveOrder(){
		$full_name 		= $_POST["full_name"];
		$phone 			= $_POST["phone"];
		$email 			= $_POST["email"];
		$table_id 		= $_POST["table_id"];

		$details 		= get_object_vars(json_decode( $_POST["details"] ));

		// var_dump($full_name);
		
		$orderFood = new OrderFood();
		$orderFood->full_name 	= $full_name;
		$orderFood->phone 		= $phone;
		$orderFood->email 		= $email;
		$orderFood->tables_id 	= $table_id;
		$orderFood->created_date_order = strtotime(date("d-m-Y H:i:s"));
		$orderFood->info_order 	= "Đặt hàng quan ứng dụng tại nhà hàng";
		$orderFood->status 		= 1;
		if(!$orderFood->save()){
			return $orderFood->getErrors();
			
		}
		

		$orderFoodId = $orderFood->id;
		
		foreach ($details["datas"] as $key => $value) {
			// var_dump($value->quantity);die;
			$detailOrderFood = new DetailOrderFood();
			$detailOrderFood->order_food_id = $orderFoodId;
			$detailOrderFood->status 		= 1;
			$detailOrderFood->product_id 	= $value->product_id;
			$detailOrderFood->quantity		= $value->quantity;
			if(!$detailOrderFood->save()){
				return $detailOrderFood->getErrors();
			}
			
		}

		return "success";
	}


	
}