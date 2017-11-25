<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\TablesOrderQuery;
use backend\models\OrderFood;
use backend\models\Tables;


/**
* This is the model class for table "tables_order".
*
* @property integer $id
* @property integer $order_food_id
* @property integer $tables_id
* @property integer $status
*
* @property OrderFood $orderFood
* @property Tables $tables
*/
class TablesOrderBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'tables_order';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['order_food_id', 'tables_id', 'status'], 'integer'],
            [['order_food_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderFood::className(), 'targetAttribute' => ['order_food_id' => 'id']],
            [['tables_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tables::className(), 'targetAttribute' => ['tables_id' => 'id']]
        ];
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderFood()
    {
        return $this->hasOne(OrderFood::className(), ['id' => 'order_food_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTables()
    {
        return $this->hasOne(Tables::className(), ['id' => 'tables_id']);
    }

    /**
    * @inheritdoc
    * @return TablesOrderQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new TablesOrderQuery(get_called_class());
    }
}
