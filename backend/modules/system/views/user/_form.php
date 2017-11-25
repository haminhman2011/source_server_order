<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user backend\models\User */
/* @var $controller string */
?>
<form id="form_user">
    <div id="error_summary"></div>
    <div class="row">
        <input type="hidden" name="User[id]" value="<?= $user->id ?>">
        <input type="hidden" name="controller" value="<?= $controller ?>">
        <?php if ($user->isNewRecord): ?>
            <div class="col-md-3 col-xs-6">
                <div class="form-group">
                    <label for="txt_username"><?= $user->getAttributeLabel('username') ?></label>
                    <input class="form-control username require" name="User[username]" value="<?= $user->username ?>" id="txt_username" autofocus>
                </div>
            </div>
        <?php endif ?>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_fullname"><?= $user->getAttributeLabel('fullname') ?></label>
                <input class="form-control fullname string" name="User[fullname]" value="<?= $user->fullname ?>" id="txt_fullname">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_password_hash"><?= $user->getAttributeLabel('password_hash') ?></label>
                <input class="form-control password <?= $user->isNewRecord ? 'require' : '' ?>" name="User[password_hash]" value="" id="txt_password_hash">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_email"><?= $user->getAttributeLabel('email') ?></label>
                <input class="form-control email" name="User[email]" value="<?= $user->email ?>" id="txt_email">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_phone"><?= $user->getAttributeLabel('phone') ?></label>
                <input class="form-control number" name="User[phone]" value="<?= $user->phone ?>" id="txt_phone">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="txt_phone_extension"><?= $user->getAttributeLabel('phone_extension') ?></label>
                <input class="form-control number" name="User[phone_extension]" value="<?= $user->phone_extension ?>" id="txt_phone">
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="form-group">
                <label for="select_role_id"><?= $user->getAttributeLabel('role_id') ?></label>
                <select name="User[role_id]" id="select_role_id" class="form-control">
                    <option></option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <a class="btn btn-default" href="<?= Url::to(['index']) ?>"><?= Yii::t('yii', 'Cancel') ?></a>
        <button class="btn <?= $user->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save_user"><?= Yii::t('yii', 'Save') ?></button>
    </div>
</form>
<script>
    'use strict';
    $(function() {
        $('#form_user').on('submit', function() {
            if (Team.validate('form_user')) {
                let formData = new FormData(document.getElementById('form_user'));
                Team.submitForm('<?= Url::to(['/system/user/save']) ?>', formData).then(function(result) {
                    if (typeof result !== 'object' && result.includes('http')) {
                        location.href = result;
                    } else {
                        Team.showErrorSummary(result, '#form_user');
                    }
                });
            } else {
                $('.error').first().focus();
            }
            return false;
        });
        $('#select_role_id').select2Ajax({
            url: '<?= Url::to(['role/select-role']) ?>',
        });
    });
</script>