<?php

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $detailOrderFood[] backend\models\DetailOrderFood */
$this->title = 'Tạo Order Food';
$this->params['breadcrumbs'][] = ['label' => 'Order Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> <?= yii\helpers\Html::encode($this->title) ?> </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body" >

<?= $this->render('_form', [
	'orderFood' => $orderFood,
'detailOrderFood' => $detailOrderFood
]) ?>
