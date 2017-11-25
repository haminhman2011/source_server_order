<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title                   = Yii::t('yii', 'Reset password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h3 class="form-title font-green"><?= Html::encode($this->title) ?></h3>
    <p style="text-align: center"><?= Yii::t('yii', 'Please choose your new password'); ?></p>
    <div class="row">
        <div class="col-md-12">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('yii', 'Save'), ['class' => 'btn green-haze']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
