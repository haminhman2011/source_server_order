<?php

namespace backend\models\base;

use backend\models\query\RoleQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property string $permissions
 * @property integer $created_date
 * @property integer $modified_date
 * @property integer $status
 *
 */
class RoleBase extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'string'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id'], 'filter', 'filter' => 'intval']
        ];
    }

    /**
     * @inheritdoc
     * @return RoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoleQuery(static::class);
    }
}
