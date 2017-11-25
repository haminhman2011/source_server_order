<?php

namespace backend\models\base;

use backend\models\query\UserQuery;
use common\models\User;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $fullname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $token
 * @property string $email
 * @property string $phone
 * @property string $phone_extension
 * @property integer $status
 * @property integer $created_date
 * @property integer $modified_date
 * @property string $created_by
 * @property string $modified_by
 * @property integer $last_login
 * @property integer $role_id
 * @property integer $type
 */
class UserBase extends User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash'], 'required'],
            [['status', 'last_login', 'role_id', 'type'], 'integer'],
            [['username', 'password_hash', 'token', 'email'], 'string', 'max' => 255],
            [['fullname'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 15],
            [['phone_extension'], 'string', 'max' => 12],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
