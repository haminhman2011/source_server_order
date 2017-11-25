<?php
/* @var $this yii\web\View */
/* @var $user backend\models\User */
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?= Yii::t('yii', 'Update') . ': ' . $user->username; ?></h4>
</div>
<div class="modal-body">
    <?= $this->renderAjax('@app/modules/system/views/user/_form', [
        'user'       => $user,
        'controller' => 'site'
    ]) ?>
</div>
