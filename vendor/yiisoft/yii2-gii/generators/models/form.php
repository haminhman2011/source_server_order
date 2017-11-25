<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\form\Generator */

//echo $form->field($generator, 'tableName');
//echo $form->field($generator, 'modelClass');
echo $form->field($generator, 'ns');
echo $form->field($generator, 'generateDataTable')->checkbox();
echo $form->field($generator, 'generateBeforeSave')->checkbox();
echo $form->field($generator, 'generateQuery')->checkbox();
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
echo $form->field($generator, 'defaultLanguage')->dropDownList([
	'vi' => 'Tiếng Việt',
	'en' => 'Tiếng Anh',
]);
//echo $form->field($generator, 'useSchemaName')->checkbox();
