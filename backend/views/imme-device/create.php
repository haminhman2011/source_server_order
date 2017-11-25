<?php

/* @var $this yii\web\View */
/* @var $immeDevice backend\models\ImmeDevice */
$this->title = 'Thêm cấu hình thiết bị di động';
$this->params['breadcrumbs'][] = ['label' => 'Cấu hình thiết bị di động', 'url' => ['index']];
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
<?= $this->render('_form', [
	'immeDevice' => $immeDevice,
]) ?>
