<?php

namespace backend\models;
use \backend\models\base\ProductTypeBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
/**
* @inheritdoc
*/
class ProductType extends ProductTypeBase{
	public function behaviors() {
		return [
			[
				'class'              => BlameableBehavior::className(),
				'createdByAttribute' => 'created_by',
				'updatedByAttribute' => 'modified_by',
			],
			[
				'class'              => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_date',
				'updatedAtAttribute' => 'modified_date',
				'value'              => time(),
			],
		];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'name' => 'Name',
			'image' => 'Image',
			'status' => 'Status',
			'created_by' => 'Created By',
			'modified_by' => 'Modified By',
			'created_date' => 'Created Date',
			'modified_date' => 'Modified Date',
		];
	}

    /**
     * Text hiển thị của model
     * @return string
     */
    public function displayText()
    {
        return $this->name;
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
