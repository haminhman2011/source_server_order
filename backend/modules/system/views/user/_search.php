<?php

/* @var $this yii\web\View */
/* @var $user \backend\models\User */
?>
<form id="form_user_search" class="search-form">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_username"><?= $user->getAttributeLabel('username') ?></label>
                <input class="form-control" name="username" id="txt_username">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_fullname"><?= $user->getAttributeLabel('fullname') ?></label>
                <input class="form-control" name="fullname" id="txt_fullname">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_email"><?= $user->getAttributeLabel('email') ?></label>
                <input class="form-control" name="email" id="txt_email">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_phone"><?= $user->getAttributeLabel('phone') ?></label>
                <input class="form-control" name="phone" id="txt_phone">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="select_status"><?= $user->getAttributeLabel('status') ?></label>
                <select name="status" id="select_status" class="select">
                    <option></option>
                    <option value="<?= \common\models\User::STATUS_ACTIVE ?>"><?= Yii::t('yii', 'Active'); ?></option>
                    <option value="<?= \common\models\User::STATUS_INACTIVE ?>"><?= Yii::t('yii', 'Disable'); ?></option>
                </select>
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <div class="form-group" style="margin-top: 22px">
                <a type="button" class="btn btn-default" id="btn_reset_filter"><?= Yii::t('yii', 'Reset') ?></a>
                <button class="btn blue-steel" id="btn_filter"><?= Yii::t('yii', 'Search') ?></button>
            </div>
        </div>
    </div>
</form>