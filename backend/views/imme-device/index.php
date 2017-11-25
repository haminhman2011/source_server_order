<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Imme Device';
$this->params['breadcrumbs'][] = $this->title;
/* @var $immeDevice backend\models\ImmeDevice */
/* @var $this yii\web\View */
?>
<div class="imme-device-index">
	<h1 class="page-title margin-bottom-10"><?= Html::encode($this->title) ?></h1>
	<?= $this->render( '_search', ['table' => 'table_imme_device', 'immeDevice' => $immeDevice] ); ?>
	<?=  $this->render( '/template/_more_options', [ 'table' => 'table_imme_device', 'url' => Url::to( [ 'change-rows-status' ] ), 'params' => [Yii::t( 'yii', 'Delete' ) => - 1] ] ); ?>
	<table id="table_imme_device" class="table table-striped table-bordered table-hover table-checkable nowrap">
		<thead>
		<tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
			<th><?= $immeDevice->getAttributeLabel('name') ?></th>
			<th><?= $immeDevice->getAttributeLabel('system') ?></th>
			<th><?= $immeDevice->getAttributeLabel('imei') ?></th>
			<th><?= $immeDevice->getAttributeLabel('ip') ?></th>
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
        let tableImmeDevice = $("#table_imme_device").DataTable({
			serverSide: true,
			ajax: $.fn.dataTable.pipeline({
				url: "<?= Url::to(['index-table']) ?>",
				data: function(q) {
					q.filterDatas = $("#form_imme_device_search").serialize();
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
		body.on('click', '.btn-delete-imme-device', function () {
            Team.action($(this), "<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>", tableImmeDevice);
		});
	});
</script>