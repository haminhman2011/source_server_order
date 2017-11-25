<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $productType backend\models\ProductType */
$this->title = $productType->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Type', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="col-md-3"></div>
<div class="portlet box purple col-md-6">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> <?= yii\helpers\Html::encode($this->title) ?> </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form" >
        <form class="form-horizontal" id="form_product_type" role="form">
            <div id="error_summary"></div>
            <div class="form-body">
                <input type="hidden" name="ProductType[id]" value="<?= $productType->id ?>">
                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                        <?= $productType->getAttributeLabel('name') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $productType->name ?>" id="txt_name" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                        <?= $productType->getAttributeLabel('image') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                        <div class="fileinput fileinput-exists" data-provides="fileinput">
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                            <img src="<?= Yii::getAlias('@web') . '/uploads/product_type/'.$productType->image ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="form-actions right1 form-footer">
                <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
                 <?php if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) : ?>
                    <a class="btn green-haze" href="<?= Url::to( [ 'update', 'id' => $productType->id ] ) ?>">Cập nhật</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>

