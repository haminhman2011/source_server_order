<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title                   = Yii::t('yii', 'Role');
$this->params['breadcrumbs'][] = $this->title;
/* @var $role backend\models\Role */
?>
<div class="role-index">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <div class="form-group">
        <a class="btn btn-primary" href="<?= Url::to(['create']) ?>" title="<?= Yii::t('yii', 'Create'); ?>"><?= Yii::t('yii', 'Create'); ?></a>
    </div>
    <table id="table_role" class="table table-striped table-hover table-bordered nowrap" style="width: 100%">
        <thead>
        <tr>
            <th><?= $role->getAttributeLabel('name') ?></th>
            <th><?= $role->getAttributeLabel('status') ?></th>
            <th><?= Yii::t('yii', 'Actions'); ?></th>
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
        let tableRole = $('#table_role').DataTable({
            serverSide: true,
            ajax: $.fn.dataTable.pipeline({
                url: '<?= Url::to(['index-table']) ?>'',
            }),
            conditionalPaging: true,
            scrollX: true,
            info: true,
            'columnDefs': [
                {
                    'targets': [-1],
                    'searchable': false,
                    'orderable': false,
                    'visible': true,
                },
            ],
        });
        body.on('click', '.btn-delete-role', function() {
            Team.action($(this), '<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>', tableRole);
        });
    });
</script>