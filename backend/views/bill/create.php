<?php

/* @var $this yii\web\View */
/* @var $bill backend\models\Bill */
$this->title = 'Tạo Bill';
$this->params['breadcrumbs'][] = ['label' => 'Bill', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="page-title margin-bottom-10"><?= yii\helpers\Html::encode($this->title) ?></h1>
<?= $this->render('_form', [
	'bill' => $bill,
]) ?>
