<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Order Food';
$this->params['breadcrumbs'][] = $this->title;
/* @var $orderFood backend\models\OrderFood */
/* @var $this yii\web\View */
?>
<div class="order-food-index">
	<h1 class="page-title margin-bottom-10"><?= Html::encode($this->title) ?></h1>
	<?= $this->render( '_search', ['table' => 'table_order_food', 'orderFood' => $orderFood] ); ?>
	<?=  $this->render( '/template/_more_options', [ 'table' => 'table_order_food', 'url' => Url::to( [ 'change-rows-status' ] ), 'params' => [Yii::t( 'yii', 'Delete' ) => - 1] ] ); ?>
	<table id="table_order_food" class="table table-striped table-bordered table-hover table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
			<th><?= $orderFood->getAttributeLabel('full_name') ?></th>
			<th><?= $orderFood->getAttributeLabel('phone') ?></th>
			<th><?= $orderFood->getAttributeLabel('tables_id') ?></th>
			<th><?= $orderFood->getAttributeLabel('created_date_order') ?></th>
			<th><?= $orderFood->getAttributeLabel('info_order') ?></th>
            <th width="10%">Hành động</th>
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    'use strict';
	$(function () {
		Team.blockUI();
		let body = $('body');
        let tableOrderFood = $("#table_order_food").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= Url::to(['index-table']) ?>",
				data: function(q) {
					q.filterDatas = $("#form_order_food_search").serialize();
				}
			}),
			conditionalPaging: true,
            info: true,
            columnDefs: [
                {
                    'targets': [0, -1],
                    'searchable': false,
                    'orderable': false,
                }
            ],
		});
		body.on('click', '.btn-delete-order-food', function () {
            Team.action($(this), "<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>", tableOrderFood);
		});
	});
</script>