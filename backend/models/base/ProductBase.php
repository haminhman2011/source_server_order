<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\ProductQuery;
use backend\models\User;
use backend\models\ProductType;


/**
* This is the model class for table "product".
*
* @property integer $id
* @property string $name
* @property string $price
* @property string $image
* @property string $note
* @property integer $product_type_id
* @property integer $status
* @property string $created_by
* @property string $modified_by
* @property string $created_date
* @property string $modified_date
* @property string $code
*
* @property User $createdBy
* @property User $modifiedBy
* @property ProductType $productType
*/
class ProductBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'product';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['name', 'price', 'product_type_id', 'code'], 'required'],
            [['note'], 'string'],
            [['product_type_id', 'status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 250],
            [['price', 'code'], 'string', 'max' => 50],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']],
            [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'id']]
        ];
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getModifiedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'modified_by']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'product_type_id']);
    }

    /**
    * @inheritdoc
    * @return ProductQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
