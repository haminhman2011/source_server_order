<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\CreatedDateOrderQuery;


/**
* This is the model class for table "created_date_order".
*
* @property integer $id
* @property integer $created_date
*/
class CreatedDateOrderBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'created_date_order';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            
        ];
    }


    /**
    * @inheritdoc
    * @return CreatedDateOrderQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new CreatedDateOrderQuery(get_called_class());
    }
}
