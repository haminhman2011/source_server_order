<?php

/* @var $this yii\web\View */
/* @var $tables backend\models\Tables */
$this->title = 'Cập nhật Tables: ' . $tables->name;
$this->params['breadcrumbs'][] = ['label' => 'Tables', 'url' => ['index']];
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
    	'tables' => $tables,
        ]) ?>
