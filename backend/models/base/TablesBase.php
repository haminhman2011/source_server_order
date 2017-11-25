<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\TablesQuery;
use backend\models\OrderFood;
use backend\models\ImmeDevice;


/**
* This is the model class for table "tables".
*
* @property integer $id
* @property string $name
* @property integer $imei_device_id
* @property integer $created_by
* @property integer $modified_by
* @property integer $created_date
* @property integer $modified_date
* @property integer $status
*
* @property OrderFood[] $orderFoods
* @property ImmeDevice $imeiDevice
*/
class TablesBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'tables';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['name', 'imei_device_id'], 'required'],
            [['imei_device_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['imei_device_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImmeDevice::className(), 'targetAttribute' => ['imei_device_id' => 'id']]
        ];
    }


    /**
    * @return \yii\db\ActiveQuery
    */
    public function getOrderFoods()
    {
        return $this->hasMany(OrderFood::className(), ['tables_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getImeiDevice()
    {
        return $this->hasOne(ImmeDevice::className(), ['id' => 'imei_device_id']);
    }

    /**
    * @inheritdoc
    * @return TablesQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new TablesQuery(get_called_class());
    }
}
