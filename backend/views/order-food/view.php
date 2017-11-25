<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $tablesOrders[] backend\models\TablesOrder */
/* @var $tablesOrder backend\models\TablesOrder */
$this->title = $orderFood->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Order Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-food-view ">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_full_name"><?= $orderFood->getAttributeLabel('full_name') ?></label>
                <input type="text" class="form-control" value="<?= $orderFood->full_name ?>" id="txt_full_name" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_phone"><?= $orderFood->getAttributeLabel('phone') ?></label>
                <input type="text" class="form-control" value="<?= $orderFood->phone ?>" id="txt_phone" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_email"><?= $orderFood->getAttributeLabel('email') ?></label>
                <input type="text" class="form-control" value="<?= $orderFood->email ?>" id="txt_email" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_info_order"><?= $orderFood->getAttributeLabel('info_order') ?></label>
                <input type="text" class="form-control" value="<?= $orderFood->info_order ?>" id="txt_info_order" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_note"><?= $orderFood->getAttributeLabel('note') ?></label>
                <input type="text" class="form-control" value="<?= $orderFood->note ?>" id="txt_note" readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_created_date_order"><?= $orderFood->getAttributeLabel('created_date_order') ?></label>
                <input type="text" class="form-control" value="<?= Yii::$app->formatter->asDate($orderFood->created_date_order) ?>" id="txt_created_date_order" readonly>
            </div>
        </div>
    </div>
    <div class="detail-title">
        <label for="">Danh sách chi tiết</label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table id="table_tables_order" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <th><?= $tablesOrder->getAttributeLabel('tables_id') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ( isset($tablesOrders) && is_array($tablesOrders) ): ?>
                        <?php foreach ( $tablesOrders as $key => $tablesOrder ): ?>
                            <tr>
                                <td>
                                    <?= $tablesOrder->tables_id != null ? $tablesOrder->tables->name : '' ?>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="form-footer">
        <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
        <?php if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) : ?>
            <a class="btn green-haze" href="<?= Url::to( [ 'update', 'id' => $orderFood->id ] ) ?>">Cập nhật</a>
        <?php endif; ?>
    </div>
</div>
<script>
    'use strict';
    $(function(){
        $("#table_tables_order").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
        });
    });
</script>
