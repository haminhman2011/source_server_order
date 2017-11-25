<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title                   = Yii::t('yii', 'System log');
$this->params['breadcrumbs'][] = $this->title;
/* @var $syslog backend\models\Syslog */
?>
<div class="syslog-index">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['syslog' => $syslog]); ?>
    <table id="table_syslog" class="table table-striped table-bordered nowrap" width="100%">
        <thead>
        <tr>
            <th><?= $syslog->getAttributeLabel('category') ?></th>
            <th><?= $syslog->getAttributeLabel('prefix') ?></th>
            <th><?= $syslog->getAttributeLabel('level') ?></th>
            <th><?= $syslog->getAttributeLabel('log_time') ?></th>
            <th width="5%"><?= Yii::t('yii', 'Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    $(function() {
        Team.blockUI();
        let body = $('body');
        let tableSyslog = $('#table_syslog').DataTable({
            processing: true,
            serverSide: true,
            ajax: $.fn.dataTable.pipeline({
                url: '<?= Url::to(['index-table']) ?>',
                data: function(q) {
                    q.filterDatas = $('#form_syslog_search').serialize();
                },
            }),
            conditionalPaging: true,
            info: true,
        });
        body.on('click', '.link-view-syslog', function() {
            Team.showModal({id: $(this).data('id')}, '<?= Url::to(['view-log']) ?>', $('#modal_lg'));
        });
        $('#form_syslog_search').on('submit', function() {
            tableSyslog.clearPipeline().draw();
            return false;
        });
        body.on('click', '#btn_reset_filter', function() {
            $('#form_syslog_search').find('input, select').val('').trigger('change');
            tableSyslog.clearPipeline().order([]).draw();
        });
    });
</script>