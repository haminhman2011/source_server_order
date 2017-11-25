<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\ProductTypeQuery;
use backend\models\Product;
use backend\models\User;


/**
* This is the model class for table "product_type".
*
* @property integer $id
* @property string $name
* @property string $image
* @property integer $status
* @property string $created_by
* @property string $modified_by
* @property string $created_date
* @property string $modified_date
*
* @property Product[] $products
* @property User $createdBy
* @property User $modifiedBy
*/
class ProductTypeBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'product_type';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 250],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']]
        ];
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_type_id' => 'id']);
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
    * @inheritdoc
    * @return ProductTypeQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new ProductTypeQuery(get_called_class());
    }
}
