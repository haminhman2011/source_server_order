<?php

namespace backend\models\base;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "syslog".
 *
 * @property string $id
 * @property string $category
 * @property string $message
 * @property string $prefix
 * @property integer $level
 * @property integer $log_time
 */
class SyslogBase extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'syslog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'message', 'prefix', 'level', 'log_time'], 'required'],
            [['message'], 'string'],
            [['level', 'log_time'], 'integer'],
            [['category', 'prefix'], 'string', 'max' => 255],
            [['id'], 'filter', 'filter' => 'intval']
        ];
    }

}
