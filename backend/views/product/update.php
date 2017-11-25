<?php

/* @var $this yii\web\View */
/* @var $product backend\models\Product */
$this->title = 'Cập nhật Product: ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
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
    	'product' => $product,
        ]) ?>
