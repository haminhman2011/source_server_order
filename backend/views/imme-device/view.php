<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $immeDevice backend\models\ImmeDevice */
$this->title = $immeDevice->name;
$this->params['breadcrumbs'][] = ['label' => 'Imme Device', 'url' => ['index']];
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
        <form class="form-horizontal" id="form_imme_device" role="form">
            <div id="error_summary"></div>
            <div class="form-body">
                <input type="hidden" name="ImmeDevice[id]" value="<?= $immeDevice->id ?>">
                <div class="form-group">
                    <label for="txt_imei" class="control-label col-md-3">
                        <?= $immeDevice->getAttributeLabel('imei') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                       <input type="text" class="form-control" value="<?= $immeDevice->name ?>" id="txt_name" readonly>
                    </div>
                </div>
                <div class="form-group">
                     <label for="txt_system" class="control-label col-md-3"><?= $immeDevice->getAttributeLabel('system') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                       <input type="text" class="form-control" value="<?= $immeDevice->system ?>" id="txt_system" readonly>
                    </div>
                </div>
                <div class="form-group">
                     <label for="txt_imei" class="control-label col-md-3"><?= $immeDevice->getAttributeLabel('imei') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                       <input type="text" class="form-control" value="<?= $immeDevice->imei ?>" id="txt_imei" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_ip" class="control-label col-md-3">
                        <?= $immeDevice->getAttributeLabel('ip') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                       <input type="text" class="form-control" value="<?= $immeDevice->ip ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-actions right1 form-footer">
            <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
            <?php if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) : ?>
            <a class="btn green-haze" href="<?= Url::to( [ 'update', 'id' => $immeDevice->id ] ) ?>">Cập nhật</a>
        <?php endif; ?>
        </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>

