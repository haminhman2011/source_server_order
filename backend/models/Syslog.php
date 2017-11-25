<?php

namespace backend\models;

use backend\models\base\SyslogBase;
use Yii;

class Syslog extends SyslogBase
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category' => Yii::t('yii', 'Category'),
            'message'  => Yii::t('yii', 'Message'),
            'prefix'   => Yii::t('yii', 'Prefix'),
            'level'    => Yii::t('yii', 'Level'),
            'log_time' => Yii::t('yii', 'Log Time'),
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

    public function getLevel()
    {
        if ($this->level == 1) {
            return 'Error';
        }
        if ($this->level == 2) {
            return 'Warning';
        }
        if ($this->level == 3) {
            return 'Info';
        }
        if ($this->level == 4) {
            return 'Trace';
        }
    }
}
