<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $tables backend\models\Tables */
$this->title = $tables->name;
$this->params['breadcrumbs'][] = ['label' => 'Tables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="col-md-3"></div>
<div class="portlet box purple col-md-6">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> <?= yii\helpers\Html::encode($this->title) ?> </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form" >
    <form id="form_tables" class="form-horizontal" role="form">
    <div id="error_summary"></div>
    <div class="form-body">
        <div class="row">
            <input type="hidden" name="Tables[id]" value="<?= $tables->id ?>">
            <div class="form-group">
                <label for="txt_code" class="control-label col-md-3">
                    <?= $tables->getAttributeLabel('name') ?>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= $tables->name ?>" id="txt_name" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="txt_code" class="control-label col-md-3">
                    <?= $tables->getAttributeLabel('imei_device_id') ?>
                    <span class="font-red-mint">*</span>
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" value="<?= $tables->imei_device_id != null ? $tables->imeiDevice->name : '' ?>" id="txt_imei_device_id" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right1 form-footer">
        <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
        <?php if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) : ?>
            <a class="btn green-haze" href="<?= Url::to( [ 'update', 'id' => $tables->id ] ) ?>">Cập nhật</a>
        <?php endif; ?>
    </div>
</form>
<div class="col-md-3"></div>
<div class="row"></div>
