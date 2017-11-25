<?php

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $detailOrderFoods[] backend\models\DetailOrderFood */
/* @var $detailOrderFood backend\models\DetailOrderFood */
$this->title = 'Cập nhật Order Food: ' . $orderFood->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Order Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
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
    'detailOrderFoods' => $detailOrderFoods,
    'detailOrderFood' => $detailOrderFood,
]) ?>
