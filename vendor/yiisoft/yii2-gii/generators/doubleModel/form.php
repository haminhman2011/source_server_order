<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\form\Generator */

echo $form->field($generator, 'ns'); ?>
<div class="row">
    <div class="col-md-6"><?php echo $form->field($generator, 'tableName'); ?></div>
    <div class="col-md-6"><?php echo $form->field($generator, 'modelClass'); ?></div>
</div>
<?php
echo $form->field($generator, 'generateQuery')->checkbox();
?>
<div class="row">
    <div class="col-md-6"><?php echo $form->field($generator, 'queryNs'); ?></div>
    <div class="col-md-6"><?php echo $form->field($generator, 'queryClass'); ?></div>
</div>
<?= $form->field($generator, 'skippedColumns'); ?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($generator, 'generateDataTable')->checkbox(); ?>
    </div>
    <div class="col-md-6">
        <?php echo $form->field($generator, 'generateBaseOnly')->checkbox(); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6"><?= $form->field($generator, 'generateBeforeSave')->checkbox(); ?></div>
<!--    <div class="col-md-6">--><?php // $form->field($generator, 'isModal')->checkbox(); ?><!--</div>-->
</div>
<div class="row beforeSaveValue">
    <?= '<h4 style="margin-left: 15px;">Timestamp Behaviors</h4>'; ?>
    <div class="col-md-6">
        <?= $form->field($generator, 'createdAt'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($generator, 'updatedAt'); ?>
    </div>
</div>
<div class="row beforeSaveValue">
    <?php echo '<h4 style="margin-left: 15px;">Blameable Behaviors</h4>'; ?>
    <div class="col-md-6">
        <?= $form->field($generator, 'createdBy'); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($generator, 'updatedBy'); ?>
    </div>
</div>
<?php echo $form->field($generator, 'defaultLanguage')->dropDownList([
    'vi' => 'Tiếng Việt',
    'en' => 'Tiếng Anh',
]); ?>
<?php echo $form->field($generator, 'enableI18N')->checkbox(); ?>
<?php echo $form->field($generator, 'messageCategory'); ?>
<?php //echo $form->field($generator, 'UUIDColumn'); ?>
