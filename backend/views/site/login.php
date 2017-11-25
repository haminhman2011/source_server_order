<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
/* @var $forgetForm \common\models\PasswordResetRequestForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;

$this->context->layout         = 'login';
$this->title                   = Yii::t('yii', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <!-- BEGIN LOGIN FORM -->
    <?php $form = ActiveForm::begin([
        'id'          => 'form_login',
        'options'     => ['class' => 'login-form'],
    ]); ?>
    <h3 class="form-title font-green-haze"><?= Yii::t('yii', 'Login'); ?></h3>
    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-actions" style="border-bottom: none;padding: 10px 30px;">
        <?= Html::submitButton(Yii::t('yii', 'Login'), ['class' => 'btn green-haze uppercase', 'name' => 'login-button']) ?>
        <a href="javascript:void(0)" id="forget-password" class="forget-password"><?= Yii::t('yii', 'Forgot password') ?></a>.
    </div>
    <?php ActiveForm::end(); ?>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['class' => 'forget-form'], 'action' => ['site/request-password-reset']]); ?>
    <h3 class="form-title font-green-haze"><?= Yii::t('yii', 'Request password reset') ?></h3>
    <p style="text-align: center"> <?= Yii::t('yii', 'Enter your e-mail address below to reset your password') ?> </p>
    <?= $form->field($forgetForm, 'email')->textInput(['autofocus' => true, 'autocomplete' => 'off']) ?>
    <div class="form-actions" style="border-bottom: none">
        <button type="button" id="back-btn" class="btn green-haze btn-outline"><?= Yii::t('yii', 'Back') ?></button>
        <?= Html::submitButton(Yii::t('yii', 'Send'), ['class' => 'btn green-haze uppercase pull-right']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- END FORGOT PASSWORD FORM -->
</div>