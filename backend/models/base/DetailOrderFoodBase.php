<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\DetailOrderFoodQuery;
use backend\models\OrderFood;
use backend\models\Product;


/**
* This is the model class for table "detail_order_food".
*
* @property integer $id
* @property integer $order_food_id
* @property integer $product_id
* @property integer $quantity
* @property integer $created_by
* @property integer $modified_by
* @property integer $created_date
* @property integer $modified_date
* @property integer $status
*
* @property OrderFood $orderFood
* @property Product $product
*/
class DetailOrderFoodBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'detail_order_food';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['order_food_id', 'product_id', 'quantity'], 'required'],
            [['order_food_id', 'product_id', 'quantity', 'status'], 'integer'],
            [['order_food_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderFood::className(), 'targetAttribute' => ['order_food_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']]
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
    * @inheritdoc
    * @return DetailOrderFoodQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new DetailOrderFoodQuery(get_called_class());
    }
}
