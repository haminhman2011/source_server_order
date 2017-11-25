<?php

echo "<?php\n";
?>

namespace <?= $generator->ns ?>;
use <?= '\\'.$generator->ns.'\\base\\'.$className.'Base'?>;
<?php if ($generator->generateBeforeSave && $hasAttribute): ?>
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
class <?= $className ?> extends <?= $className.'Base'?>{
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
				'value'              => strtotime( date( 'd.m.Y H:i:s' ) ),
			],
		];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
<?php foreach ($labels as $name => $label): ?>
			<?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
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
}
<?php else: ?>
class <?= $className ?> extends <?= $className.'Base'?>{
	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
<?php foreach ($labels as $name => $label): ?>
			<?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endforeach; ?>
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
}
<?php endif ?>
