<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\ImmeDeviceQuery;
use backend\models\User;


/**
* This is the model class for table "imme_device".
*
* @property integer $id
* @property string $name
* @property string $system
* @property string $imei
* @property string $ip
* @property integer $status
* @property string $created_by
* @property string $modified_by
* @property string $created_date
* @property string $modified_date
*
* @property User $createdBy
* @property User $modifiedBy
*/
class ImmeDeviceBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'imme_device';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['name', 'system', 'imei', 'ip'], 'required'],
            [['status'], 'integer'],
            [['name', 'system', 'imei', 'ip'], 'string', 'max' => 250],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['modified_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['modified_by' => 'id']]
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
    * @inheritdoc
    * @return ImmeDeviceQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new ImmeDeviceQuery(get_called_class());
    }
}
