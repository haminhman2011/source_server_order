<?php

namespace backend\models;

use backend\models\base\RoleBase;
use Yii;

class Role extends RoleBase
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'   => Yii::t('yii', 'Role Name'),
            'role'   => 'Role',
            'status' => Yii::t('yii', 'Status'),
            'note'   => Yii::t('yii', 'Note'),
        ];
    }
    //	public function beforeSave( $insert ) {
    //		if ( parent::beforeSave( $insert ) ) {
    //			if ( $insert ) {
    //				//nếu là thêm mới
    //			}
    //
    //			return true;
    //		} else {
    //			return false;
    //		}
    //	}

    public function getStatus($hasHtml = true)
    {
        $message = Yii::t('yii', 'Activate');
        if ($this->status == User::STATUS_ACTIVE) {
            return $hasHtml ? "<span class=\"label label-md label-success\"> $message </span>" : $message;
        }

        $message = Yii::t('yii', 'Disable');

        return $hasHtml ? "<span class=\"label label-md label-danger\"> $message </span>" : $message;
    }
}
