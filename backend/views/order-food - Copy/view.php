<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $detailOrderFoods[] backend\models\DetailOrderFood */
/* @var $detailOrderFood backend\models\DetailOrderFood */
$this->title = $orderFood->full_name;
$this->params['breadcrumbs'][] = ['label' => 'Order Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>

<div class="portlet box purple">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> <?= yii\helpers\Html::encode($this->title) ?> </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body" >
    <div class="row">
        <div class=" col-md-9">
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
                        <label for="txt_tables_id"><?= $orderFood->getAttributeLabel('tables_id') ?></label>
                        <input type="text" class="form-control" value="<?= $orderFood->tables_id != null ? $orderFood->tables->name : '' ?>" id="txt_tables_id" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_email"><?= $orderFood->getAttributeLabel('email') ?></label>
                        <input type="text" class="form-control" value="<?= $orderFood->email ?>" id="txt_email" readonly>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6">
                    <div class="form-group">
                        <label for="txt_info_order" class="control-label">
                            <?= $orderFood->getAttributeLabel('info_order') ?>
                        </label>
                        <input class="form-control" value="<?= $orderFood->info_order ?>" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="txt_created_date_order"><?= $orderFood->getAttributeLabel('created_date_order') ?></label>
                        <input type="text" class="form-control" value="<?= Yii::$app->formatter->asDate($orderFood->created_date_order) ?>" id="txt_created_date_order" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="txt_note"><?= $orderFood->getAttributeLabel('note') ?></label>
                        <textarea class="form-control"  cols="30" rows="4" readonly><?= $orderFood->note ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-title">
        <label for="">Danh sách chi tiết</label>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table id="table_detail_order_food" class="table table-striped table-bordered nowrap" style="width: 100%">
                    <thead>
                        <tr>
                            <th><?= $detailOrderFood->getAttributeLabel('product_id') ?></th>
                            <th><?= $detailOrderFood->getAttributeLabel('quantity') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if ( isset($detailOrderFoods) && is_array($detailOrderFoods) ): ?>
                        <?php foreach ( $detailOrderFoods as $key => $detailOrderFood ): ?>
                            <tr>
                                <td>
                                    <?= $detailOrderFood->product_id != null ? $detailOrderFood->product->name : '' ?>

                                </td>
                                <td>
                                    <?= $detailOrderFood->quantity ?>

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
        $("#table_detail_order_food").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
        });
    });
</script>
