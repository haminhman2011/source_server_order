<?php

namespace backend\models;

use backend\models\base\UserBase;
use Yii;

/**
 * @inheritdoc
 */
class User extends UserBase
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username'        => Yii::t('yii', 'Username'),
            'fullname'        => Yii::t('yii', 'Fullname'),
            'auth_key'        => Yii::t('yii', 'Auth Key'),
            'password_hash'   => Yii::t('yii', 'Password'),
            'token'           => Yii::t('yii', 'Token'),
            'email'           => Yii::t('yii', 'Email'),
            'phone'           => Yii::t('yii', 'Phone'),
            'phone_extension' => Yii::t('yii', 'Phone Extension'),
            'status'          => Yii::t('yii', 'Status'),
            'type'            => Yii::t('yii', 'Type'),
            'role_id'         => Yii::t('yii', 'Role'),
            'created_date'    => Yii::t('yii', 'Created date'),
            'modified_date'   => Yii::t('yii', 'Modified date'),
            'last_login'      => Yii::t('yii', 'Last login'),
        ];
    }

    public function scenarios()
    {
        $scenarios           = parent::scenarios();
        $scenarios['update'] = ['username', 'email'];//validate cho trường hợp update user, password không bat buộc phãi nhập

        return $scenarios;

    }

    public function rules()
    {
        return array_merge(parent::rules(),
            [
                [['username', 'email', 'phone'], 'filter', 'filter' => 'trim'],
                ['phone', 'string', 'length' => [9, 11]],
                [['id'], 'filter', 'filter' => 'intval']
            ]);
    }

    /**
     * Text hiển thị của model
     * @return string
     */
    public function displayText()
    {
        return $this->fullname;
    }

    /**
     * @inheritdoc
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ( ! $insert) {
                $this->username = $this->oldAttributes['username'];
            }
            if ($this->password_hash !== '') {
                $this->setPassword($this->password_hash);
            } else {
                $this->password_hash = $this->oldAttributes['password_hash'];
            }

            return true;
        }

        return false;
    }

    /**
     * Cập nhật thời gian lần gần nhất login
     *
     * @param $userId
     *
     * @return int
     */
    public static function updateLoginTime($userId)
    {
        return User::findOne($userId)->updateAttributes(['last_login' => time()]);
    }

    /**
     * Lấy text của trạng thái user
     *
     * @param bool $hasHtml
     *
     * @return string
     */
    public function getStatus($hasHtml = true)
    {
        $message = Yii::t('yii', 'Active');
        if ($this->status == User::STATUS_ACTIVE) {
            return $hasHtml ? "<span class=\"label label-md label-success\"> $message </span>" : $message;
        }

        $message = Yii::t('yii', 'Disabled');

        return $hasHtml ? "<span class=\"label label-md label-danger\"> $message </span>" : $message;
    }

    /**
     * Thay đổi trang thái của nhiều user
     *
     * @param int $action : 0 disable, 1 activate, -1 delete
     * @param array $userIds
     *
     * @return string: success => co it nhat 1 dòng lưu thành công, fail => không có dòng nào lưu thành công
     */
    public static function changeRowsStatus($action, array $userIds = [])
    {
        if ($action == 0) {
            return User::updateAll(['status' => 0], ['id' => $userIds]) > 0 ? 'success' : 'fail';
        }
        if ($action == 1) {
            return User::updateAll(['status' => 1], ['id' => $userIds]) > 0 ? 'success' : 'fail';
        }
        if ($action == -1) {
            return User::updateAll(['status' => -1], ['id' => $userIds]) > 0 ? 'success' : 'fail';
        }

        return 'update_fail';
    }

    /**
     * @return int|string
     */
    public static function getUserId()
    {
        return Yii::$app->user != null ? Yii::$app->user->getId() : '';
    }

    /**
     * @return string
     */
    public static function getUsername()
    {
        return Yii::$app->user->identity != null ? Yii::$app->user->identity->username : '';
    }
}
