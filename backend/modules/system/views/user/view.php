<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user backend\models\User */

$this->title                   = $user->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view ">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_username"><?= $user->getAttributeLabel('username') ?></label>
                <input type="text" class="form-control" value="<?= $user->username ?>" id="txt_username" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_fullname"><?= $user->getAttributeLabel('fullname') ?></label>
                <input type="text" class="form-control" value="<?= $user->fullname ?>" id="txt_fullname" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_email"><?= $user->getAttributeLabel('email') ?></label>
                <input type="text" class="form-control" value="<?= $user->email ?>" id="txt_email" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_phone"><?= $user->getAttributeLabel('phone') ?></label>
                <input type="text" class="form-control" value="<?= $user->phone ?>" id="txt_phone" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_phone_extension"><?= $user->getAttributeLabel('phone_extension') ?></label>
                <input type="text" class="form-control number" value="<?= $user->phone_extension ?>" id="txt_phone_extension" readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_status"><?= $user->getAttributeLabel('status') ?></label>
                <input type="text" class="form-control" value="<?= $user->getStatus(false) ?>" id="txt_status" readonly>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <a type="button" class="btn btn-default" href="<?= Url::to(['user/']) ?>"><?= Yii::t('yii', 'Cancel'); ?></a>
        <a type="button" class="btn green-haze" href="<?= Url::to(['update', 'id' => $user->id]) ?>"><?= Yii::t('yii', 'Update'); ?></a>
    </div>
</div>
