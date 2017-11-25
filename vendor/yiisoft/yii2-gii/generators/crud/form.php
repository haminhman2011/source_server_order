<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\crud\Generator */

?>
<div class="row">
    <div class="col-md-5"><?php echo $form->field($generator, 'modelClass'); ?></div>
    <div class="col-md-7"><?php echo $form->field($generator, 'controllerClass'); ?></div>
</div>
<?php
//echo $form->field($generator, 'baseControllerClass');
echo $form->field($generator, 'isModule')->checkbox();
echo $form->field($generator, 'viewPath');
echo '<div class="form-group"> <h3> Trang index </h3> </div>'; ?>
	<div class="row">
		<div class="col-md-3">
			<?php echo $form->field($generator, 'isFilter')->checkbox(); ?>
		</div>
        <div class="col-md-3">
			<?php echo $form->field($generator, 'moreOption')->checkbox(); ?>
        </div>
        <div class="col-md-3">
			<?php echo $form->field($generator, 'actionCol')->checkbox(); ?>
        </div>
<!--		<div class="col-md-3">-->
<!--			--><?php //echo $form->field($generator, 'isIndexFixed')->checkbox(); ?>
<!--		</div>-->
        <div class="col-md-3">
			<?php echo $form->field($generator, 'exportAll')->checkbox(); ?>
		</div>
	</div>
<?= $form->field($generator, 'skippedIndexColumns'); ?>
<?php echo '<div class="form-group"> <h3> Trang form </h3> </div>';
echo $form->field($generator, 'skippedColumns');
echo $form->field($generator, 'requireColumns');
echo $form->field($generator, 'hasDetail')->checkbox(); ?>
    <div class="row">
        <div class="col-md-6"><?= $form->field($generator, 'subTableName'); ?></div>
        <div class="col-md-6"><?= $form->field($generator, 'exportDetail')->checkbox(); ?></div>
    </div>
<?php echo $form->field($generator, 'hasSubDetail')->checkbox();
echo $form->field($generator, 'subDetailTableName');
echo $form->field($generator, 'enableI18N')->checkbox();
echo $form->field($generator, 'messageCategory');
echo $form->field($generator, 'defaultLanguage')->dropDownList([
	'vi' => 'Tiếng Việt',
	'en' => 'Tiếng Anh',
]);