<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\OrderFoodQuery;
use backend\models\DetailOrderFood;
use backend\models\TablesOrder;


/**
* This is the model class for table "order_food".
*
* @property integer $id
* @property string $full_name
* @property string $phone
* @property integer $created_by
* @property integer $modified_by
* @property integer $created_date
* @property integer $modified_date
* @property string $email
* @property string $info_order
* @property string $note
* @property integer $created_date_order
* @property integer $status
*
* @property DetailOrderFood[] $detailOrderFoods
* @property TablesOrder[] $tablesOrders
*/
class OrderFoodBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'order_food';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['note'], 'string'],
            [['created_date_order', 'status'], 'integer'],
            [['full_name', 'phone', 'email', 'info_order'], 'string', 'max' => 250]
        ];
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getDetailOrderFoods()
    {
        return $this->hasMany(DetailOrderFood::className(), ['order_food_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTablesOrders()
    {
        return $this->hasMany(TablesOrder::className(), ['order_food_id' => 'id']);
    }

    /**
    * @inheritdoc
    * @return OrderFoodQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new OrderFoodQuery(get_called_class());
    }
}
