<?php

namespace backend\models\base;
use yii\db\ActiveRecord;
use backend\models\query\BillQuery;


/**
* This is the model class for table "bill".
*
* @property string $id
* @property string $name
* @property string $created_by
* @property string $modified_by
* @property string $created_date
* @property string $modified_date
* @property integer $status
*/
class BillBase extends ActiveRecord {
    /**
    * @inheritdoc
    */
    public static function tableName()
    {
        return 'bill';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }


    /**
    * @inheritdoc
    * @return BillQuery the active query used by this AR class.
    */
    public static function find()
    {
        return new BillQuery(get_called_class());
    }
}
