<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Bill';
$this->params['breadcrumbs'][] = $this->title;
/* @var $bill backend\models\Bill */
/* @var $this yii\web\View */
?>
<div class="bill-index">
	<h1 class="page-title margin-bottom-10"><?= Html::encode($this->title) ?></h1>
	<?= $this->render( '_search', ['table' => 'table_bill', 'bill' => $bill] ); ?>
	<?=  $this->render( '/template/_more_options', [ 'table' => 'table_bill', 'url' => Url::to( [ 'change-rows-status' ] ), 'params' => [Yii::t( 'yii', 'Delete' ) => - 1] ] ); ?>
    <div class="form-group">
        <a href="<?= Url::to( [ 'export-bill' ] ) ?>" class="btn blue-steel"><i class="fa fa-download"></i> Export</a>
    </div>
	<table id="table_bill" class="table table-striped table-bordered table-hover table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
			<th><?= $bill->getAttributeLabel('name') ?></th>
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
        let tableBill = $("#table_bill").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= Url::to(['index-table']) ?>",
				data: function(q) {
					q.filterDatas = $("#form_bill_search").serialize();
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
		body.on('click', '.btn-delete-bill', function () {
            Team.action($(this), "<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>", tableBill);
		});
	});
</script>