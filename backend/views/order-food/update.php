<?php

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $tablesOrders[] backend\models\TablesOrder */
/* @var $tablesOrder backend\models\TablesOrder */
$this->title = 'Cập nhật Order Food: ' . $orderFood->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Order Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<h1 class="page-title margin-bottom-10"><?= yii\helpers\Html::encode($this->title) ?></h1>
<?= $this->render('_form', [
    	'orderFood' => $orderFood,
    'tablesOrders' => $tablesOrders,
    'tablesOrder' => $tablesOrder,
    'detailOrderFoods' => $detailOrderFoods,
    'detailOrderFood' => $detailOrderFood
]) ?>
