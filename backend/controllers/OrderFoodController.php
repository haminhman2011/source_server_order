<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\MethodNotAllowedHttpException;
use backend\models\OrderFood;
use backend\models\TablesOrder;
use backend\models\Tables;
use common\utils\controller\Controller;
use common\utils\table\TableFacade;
use backend\models\table\OrderFoodTable;
use yii\helpers\Url;
use backend\models\DetailOrderFood;
use common\utils\model\ModelBuilder;
use common\utils\model\Model;
use yii\base\Exception;
use yii\helpers\Json;
use yii\db\Query;

class OrderFoodController extends Controller
{
    /**
    * Hiện danh sách OrderFood.
    *
    * @return string
    */
    public function actionIndex()
    {
		$orderFood = new OrderFood();
        return $this->render('index', ['orderFood' => $orderFood]);
    }

    /**
    * Load ajax table trang index
    *
    * @return string
    */
    public function actionIndexTable() {
        $tableFacade = new TableFacade( new OrderFoodTable );
        return $tableFacade->getDataTable();
    }

    /**
    * Hiện trang view chi tiết OrderFood.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionView()
	{
        $orderFoodId = Yii::$app->request->get('id', '');
        $orderFood = $this->findModel($orderFoodId);
		$tablesOrders = TablesOrder::find()->where( [ 'status' => 1, 'order_food_id' => $orderFoodId ] )->all();
		$tablesOrder = new TablesOrder();
		return $this->render('view', [
			'orderFood' => $orderFood,
			'tablesOrders' => $tablesOrders,
			'tablesOrder' => $tablesOrder
		]);
	}

    /**
    * Hiện trang create OrderFood.
    *
    * @return string
    */
    public function actionCreate()
    {
		$orderFood = new OrderFood();
		$tablesOrder = new TablesOrder();
        $detailOrderFood = new DetailOrderFood();
		return $this->render('create', [
			'orderFood' => $orderFood,
			'tablesOrder' => $tablesOrder,
            'detailOrderFood' => $detailOrderFood
		]);
    }

    /**
    * Hiện trang update OrderFood.
    *
    * @return string
    * @throws NotFoundHttpException
    */
	public function actionUpdate()
	{
        $orderFoodId = Yii::$app->request->get('id', '');
		$orderFood = $this->findModel($orderFoodId);
		$tablesOrders = TablesOrder::find()->where( [ 'status' => 1, 'order_food_id' => $orderFoodId ] )->all();
		$tablesOrder = new TablesOrder();
        $detailOrderFoods = DetailOrderFood::find()->where( [ 'status' => 1, 'order_food_id' => $orderFoodId ] )->all();
        $detailOrderFood = new DetailOrderFood();
		return $this->render('update', [
			'orderFood' => $orderFood,
			'tablesOrders' => $tablesOrders,
			'tablesOrder' => $tablesOrder,
            'detailOrderFoods' => $detailOrderFoods,
            'detailOrderFood' => $detailOrderFood
		]);
	}

    /**
    * Lưu OrderFood model.
    *
    * @return string:
    * - url: lưu model OrderFood thành công
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
		$orderFoodId = Yii::$app->request->post( 'OrderFood' )['id'];
        $createddOrderFood = Yii::$app->request->post('created_date_order');
        $orderFood   = $orderFoodId != '' ? $this->findModel($orderFoodId) : new OrderFood();
		if ( $orderFood->load( Yii::$app->request->post() ) ) {
			$transaction = Yii::$app->db->beginTransaction();
			try {
                $orderFood->created_date_order = strtotime($createddOrderFood);
                $result = $orderFood->save();
				if ( $result && (! $orderFood->isNewRecord || array_key_exists( 'TablesOrder', Yii::$app->request->post()))) {
                    $builder = new ModelBuilder($orderFood->id);
                    $builder->setSubModel(TablesOrder::className())->setRelation('tablesOrders')->setForeignKey('order_food_id');
					$result    = Model::saveMultiple( $orderFood, $builder );
                    $builder->setSubModel(DetailOrderFood::className())->setRelation('detailOrderFoods')->setForeignKey('order_food_id');
                    $result    = Model::saveMultiple( $orderFood, $builder );
				}
				if ( is_bool($result) && $result ) {
					$transaction->commit();
                    return Url::to( ['index'], true );
				}
                if (is_array($result) && ! empty($result)) {
                    return $this->asJson( $result );
                }
                return $this->asJson($orderFood->errors);
			} catch ( Exception $e ) {
				$transaction->rollBack();
                Yii::error($e->getMessage() . "\n" . __FUNCTION__ . ' ----- ' . __CLASS__, 'system');

				return $e->getMessage();
			}
		}

		throw new ServerErrorHttpException( Yii::t( 'yii', 'An internal server error occurred.' ) );
	}


    /**
    * Cập nhật status OrderFood.
    *
    * @return string
    * @throws NotFoundHttpException
    */
    public function actionDelete() {
        $orderFoodId = Yii::$app->request->post( 'id', '');
        $orderFood = OrderFood::findOne(['id' => $orderFoodId, 'status' => 1]);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($orderFood->updateAttributes( [ 'status' => -1 ] ) > 0) {
                TablesOrder::updateAll( [ 'status' => -1 ], [ 'order_food_id' => $orderFoodId ] );
                $transaction->commit();
                return 'success';
            }
            return 'fail';
        } catch ( Exception $e ) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . __FUNCTION__ . ' ----- ' . __CLASS__, 'system');

            return $e->getMessage();
        }
    }

    /**
     * Select2 ajax OrderFood.
     *
     * @return \yii\web\Response
     * @throws MethodNotAllowedHttpException
     */
	public function actionSelectOrderFood() {
        if (Yii::$app->request->isAjax) {
            $query  = Yii::$app->request->get( 'query', '' );
            $page   = Yii::$app->request->get( 'page', 1 );
            $excludeIds = Yii::$app->request->get( 'excludeIds', [] );
            $offset = ($page - 1) * 10;
            $orderFoods = OrderFood::find()->where( [ 'status' => 1 ] )
                                                                    ->andFilterWhere( [ 'not in', 'id', $excludeIds ] )
                                                                    ->andFilterWhere( [ 'like', 'full_name', $query ] )->select( [ 'id', 'full_name' ] );

            return $this->asJson( [
                'total_count' => $orderFoods->count(),
                'items'       => $orderFoods->offset($offset)->limit( 10 )->all()
            ] );
        }

        throw new MethodNotAllowedHttpException(Yii::t('yii', 'Method Not Allowed'));
	}


	/**
	* Tìm OrderFood model theo khóa chính.
	* Nếu không tìm thấy, trả về trang 404.
    *
	* @param $orderFoodId
	* @return OrderFood the loaded model
	* @throws NotFoundHttpException if the model cannot be found
	*/
    protected function findModel($orderFoodId) {
        if (($model = OrderFood::findOne(['id' => $orderFoodId, 'status' => 1])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t( 'yii', 'Page not found.'));
    }

    public function actionViewTablesOrder(){
        if (Yii::$app->request->isAjax) {
            $dateNow = date('d-m-Y H:i');
            // var_dump(strtotime('31-10-2017 02:00')); // 1509390000
            // var_dump(strtotime('31-10-2017 15:00'));die;
            $sList  = Yii::$app->request->post( 'sList', '' );
            $txt_datetime_check  = Yii::$app->request->post( 'txt_datetime_check', '' );
         
            $strDateNow = strtotime($dateNow);
            $connection = \Yii::$app->db;
            $model = $connection->createCommand("SELECT `tables`.id AS tables_id,
                    `tables`.`name` AS tables_name,
                    order_food.id AS order_food_id,
                    order_food.created_date_order AS created_date_order,
                    tables_order.id AS tables_order_id 
                    FROM order_food 
                    LEFT JOIN tables_order ON order_food.id = tables_order.order_food_id
                    LEFT JOIN `tables` ON tables_order.tables_id = `tables`.id
                    WHERE order_food.`status` = 1 AND tables_order.`status` = 1 AND `tables`.`status` = 1 AND `tables`.id IN  ($sList)");
            $data = $model->queryAll();

            $m = array();
            foreach ($data as $key => $value) {
                 // var_dump($value);
                if(date('d-m-Y', $value["created_date_order"]) == $txt_datetime_check){
                    $m[] = date('H', $value["created_date_order"]);

                   
                }
                
            }

            return Json::encode($m);
        }
        

    }
}
