<?php

namespace backend\models;
use \backend\models\base\TablesOrderBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
* @inheritdoc
*/
class TablesOrder extends TablesOrderBase{

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'order_food_id' => 'Order Food',
			'tables_id' => 'Tables',
			'status' => 'Status',
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
