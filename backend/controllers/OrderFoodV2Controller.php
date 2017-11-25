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

class OrderFoodV2Controller extends Controller
{
    /**
    * Hiện danh sách OrderFood.
    *
    * @return string
    */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionModalOrderAfter(){
        return $this->renderPartial('modal_order_after');
    }

    public function actionModalCheckIn(){
        return $this->renderPartial('modal_check_in');
    }

    public function actionModalCustomer(){
        $id = Yii::$app->request->post('id', '');
        return $this->renderPartial('modal_customer', ['id' => $id] );
    }
}