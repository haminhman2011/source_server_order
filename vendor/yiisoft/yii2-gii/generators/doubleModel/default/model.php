<?php

echo "<?php\n";
/* @var $generator yii\gii\generators\model\Generator */
?>

namespace <?= $generator->ns ?>;
use <?= '\\'.$generator->ns.'\\base\\'.$className.'Base'?>;
<?php
if ($generator->enableI18N) {
echo 'use Yii;';
}
?>
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
<?php if($generator->UUIDColumn !== '') : ?>
use common\utils\behaviors\UUIDBehavior;
<?php endif; ?>
/**
* @inheritdoc
*/
class <?= $className ?> extends <?= $className.'Base'?>{
<?php if ($generator->generateBeforeSave): ?>
	public function behaviors() {
		return [
<?php if ($generator->createdBy !== '' && $generator->updatedBy !== ''): ?>
			[
				'class'              => BlameableBehavior::className(),
				'createdByAttribute' => '<?= $generator->createdBy ?>',
				'updatedByAttribute' => '<?= $generator->updatedBy ?>',
			],
<?php endif ?>
<?php if ($generator->createdAt !== '' && $generator->updatedAt !== ''): ?>
			[
				'class'              => TimestampBehavior::className(),
				'createdAtAttribute' => '<?= $generator->createdAt ?>',
				'updatedAtAttribute' => '<?= $generator->updatedAt ?>',
				'value'              => time(),
			],
<?php endif ?>
<?php if ($generator->UUIDColumn !== ''): ?>
			'uuid' => [
				'class' => UUIDBehavior::className(),
				'column' => '<?= $generator->UUIDColumn?>',
			]
<?php endif ?>
		];
	}
<?php else: ?>
<?php if ($generator->UUIDColumn !== ''): ?>
	public function behaviors() {
		return [
			'uuid' => [
				'class' => UUIDBehavior::className(),
				'column' => '<?= $generator->UUIDColumn?>',
			]
		];
	}
<?php endif ?>
<?php endif ?>

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

    /**
     * Text hiển thị của model
     * @return string
     */
    public function displayText()
    {
<?php $text = '';
$labels = array_keys($labels);
if (in_array('name', $labels)) {
    $text = '$this->name';
} elseif (in_array('code', $labels)) {
    $text = '$this->code';
} else {
    $text = '';
}
?>
        return <?= $text ?>;
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
