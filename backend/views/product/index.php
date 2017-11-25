<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Product';
$this->params['breadcrumbs'][] = $this->title;
/* @var $product backend\models\Product */
/* @var $this yii\web\View */
?>
<div class="product-index">
	<h1 class="page-title margin-bottom-10"><?= Html::encode($this->title) ?></h1>
	<?= $this->render( '_search', ['table' => 'table_product', 'product' => $product] ); ?>
	<?=  $this->render( '/template/_more_options', [ 'table' => 'table_product', 'url' => Url::to( [ 'change-rows-status' ] ), 'params' => [Yii::t( 'yii', 'Delete' ) => - 1] ] ); ?>
	<table id="table_product" class="table table-striped table-bordered table-hover table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
            <th><?= $product->getAttributeLabel('code') ?></th>
			<th><?= $product->getAttributeLabel('name') ?></th>
			<th><?= $product->getAttributeLabel('price') ?></th>
			<th><?= $product->getAttributeLabel('product_type_id') ?></th>
			
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
        let tableProduct = $("#table_product").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= Url::to(['index-table']) ?>",
				data: function(q) {
					q.filterDatas = $("#form_product_search").serialize();
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
		body.on('click', '.btn-delete-product', function () {
            Team.action($(this), "<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>", tableProduct);
		});
	});
</script>