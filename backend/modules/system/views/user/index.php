<?php

use backend\models\User;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title                   = Yii::t('yii', 'User');
$this->params['breadcrumbs'][] = $this->title;
/* @var $user backend\models\User */
?>
<div class="user-index">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['user' => $user]); ?>
    <?= $this->render('@backend/views/template/_more_options', [
        'table'  => 'table_user',
        'url'    => Url::to(['change-rows-status']),
        'params' => [
            Yii::t('yii', 'Enable')  => User::STATUS_ACTIVE,
            Yii::t('yii', 'Disable') => User::STATUS_INACTIVE,
            Yii::t('yii', 'Delete')  => User::STATUS_DELETED,
        ]
    ]); ?>
    <table id="table_user" class="table table-striped table-bordered table-hover table-checkable nowrap">
        <thead>
        <tr>
            <th class="table-checkbox" width="5%">
                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input class="cb-all group-checkable" type="checkbox" title=""/>
                    <span></span>
                </label>
            </th>
            <th><?= $user->getAttributeLabel('username') ?></th>
            <th><?= $user->getAttributeLabel('fullname') ?></th>
            <th><?= $user->getAttributeLabel('email') ?></th>
            <th><?= $user->getAttributeLabel('phone') ?></th>
            <th><?= $user->getAttributeLabel('status') ?></th>
            <th><?= $user->getAttributeLabel('last_login') ?></th>
            <th width="10%"><?= Yii::t('yii', 'Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    'use strict';
    $(function() {
        Team.blockUI();
        let body = $('body');
        let tableUser = $('#table_user').DataTable({
            serverSide: true,
            ajax: $.fn.dataTable.pipeline({
                url: '<?= Url::to(['index-table']) ?>',
                data: function(q) {
                    q.filterDatas = $('#form_user_search').serialize();
                },
            }),
            conditionalPaging: true,
            info: true,
            columnDefs: [
                {
                    'targets': [0, -1],
                    'searchable': false,
                    'orderable': false,
                },
            ],
        });
        body.on('click', '.btn-toggle-status-user', function() {
            Team.action($(this), '<?= Yii::t('yii', 'Are you sure you want to change this item?') ?>', tableUser, undefined, 'warning');
        });
        body.on('click', '.btn-delete-user', function() {
            Team.action($(this), '<?= Yii::t('yii', 'Are you sure you want to delete this item?') ?>', tableUser);
        });
        $('#form_user_search').on('submit', function() {
            tableUser.clearPipeline().draw();
            return false;
        });
        body.on('click', '#btn_reset_filter', function() {
            $('#form_user_search').find('input, select').val('').trigger('change');
            tableUser.clearPipeline().order([]).draw();
        });
    });
</script>