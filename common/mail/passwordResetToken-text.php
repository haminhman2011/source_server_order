<?php

/* @var $this yii\web\View */
/* @var $user backend\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->token]);
?>
Hello <?= $user->fullname == '' ? $user->username : $user->fullname ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
