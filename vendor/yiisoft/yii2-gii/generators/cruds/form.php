<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\crud\Generator */
echo $form->field($generator, 'models');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
//echo $form->field($generator, 'isFilter')->checkbox();
echo $form->field($generator, 'defaultLanguage')->dropDownList([
	'vi' => 'Tiếng Việt',
	'en' => 'Tiếng Anh',
]);