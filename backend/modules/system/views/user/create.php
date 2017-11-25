<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user backend\models\User */
$this->title                   = Yii::t('yii', 'Create {model}', ['model' => mb_convert_case(Yii::t('yii', 'User'), MB_CASE_LOWER, 'UTF-8')]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii', 'User'), 'url' => ['user/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', [
    'user'       => $user,
    'controller' => 'user'
]) ?>
