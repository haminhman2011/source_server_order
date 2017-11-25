<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $product backend\models\Product */
$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="col-md-3"></div>
<div class="portlet box purple col-md-6">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-gift"></i> <?= Html::encode($this->title) ?> </div>
        <div class="tools">
            <a href="" class="collapse"> </a>
        </div>
    </div>
    <div class="portlet-body form" >
     <form class="form-horizontal" id="form_product" role="form">
            <div class="form-body">
                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                        <?= $product->getAttributeLabel('code') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $product->code ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_name" class="control-label col-md-3">
                            <?= $product->getAttributeLabel('name') ?>
                        <span class="font-red-mint">*</span>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $product->name ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select_product_type_id" class="control-label col-md-3">
                            <?= $product->getAttributeLabel('product_type_id') ?>
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $product->product_type_id != null ? $product->productType->name : '' ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                     <label for="txt_price" class="control-label col-md-3">
                     <?= $product->getAttributeLabel('price') ?>
                        
                     </label>
                    <div class="col-md-9">
                        <input class="form-control alphanum"  value="<?= $product->price ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                     <label for="txt_image" class="control-label col-md-3">
                        <?= $product->getAttributeLabel('image') ?>
                     </label>
                    <div class="col-md-9">
                        
                            <div class="fileinput fileinput-exists" data-provides="fileinput">
                               
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                                <img src="<?= Yii::getAlias('@web') . '/uploads/product/'.$product->image ?>" alt="">
                                </div>
                            </div>
                       
                    </div>
                </div>
                <div class="form-group">
                     <label for="textarea_note" class="control-label col-md-3">
                     <?= $product->getAttributeLabel('textarea_note') ?>
                        
                     </label>
                    <div class="col-md-9">
                        <textarea class="form-control" cols="30" rows="5" readonly><?= $product->note ?></textarea>
                    </div>
                </div>
                
            </div>
            <div class="form-actions right1 form-footer">
                <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
                <?php if ( Yii::$app->permission->can( Yii::$app->controller->id , 'update' )) : ?>
                    <a class="btn green-haze" href="<?= Url::to( [ 'update', 'id' => $product->id ] ) ?>">Cập nhật</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>


