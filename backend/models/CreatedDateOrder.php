<?php

namespace backend\models;
use \backend\models\base\CreatedDateOrderBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
* @inheritdoc
*/
class CreatedDateOrder extends CreatedDateOrderBase{

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'created_date' => 'Created Date',
		];
	}

    /**
     * Text hiển thị của model
     * @return string
     */
    public function displayText()
    {
        return ;
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
}
