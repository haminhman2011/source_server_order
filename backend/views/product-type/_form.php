<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $productType backend\models\ProductType */
?>
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
                        <input class="form-control alphanum require" name="ProductType[name]" value="<?= $productType->name ?>" id="txt_name" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                    	<?= $productType->getAttributeLabel('image') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                        <?php if($productType->isNewRecord): ?>
							<div class="fileinput fileinput-new?> "  data-provides="fileinput">
				                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
				                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
				                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				                <div>
				                    <span class="btn default btn-file">
				                        <span class="fileinput-new"> Select image </span>
				                        <span class="fileinput-exists"> Change </span>
				                        <input type="file" class="alphanum require" name="image"> 
				                    </span>
				                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				                </div>
				            </div>
						<?php else: ?>
							<div class="fileinput fileinput-exists" data-provides="fileinput">
				               
				                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
				                <img src="<?= Yii::getAlias('@web') . '/uploads/product_type/'.$productType->image ?>" alt="">
				                </div>
				                <div>
				                    <span class="btn default btn-file">
				                     
				                        <span class="fileinput-exists"> Change </span>
				                        <input type="file" name="image"> </span>
				                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				                </div>
				            </div>
						<?php endif; ?>
                    </div>
                </div>


            </div>
            <div class="form-actions right1 form-footer">
	            <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
	        	 <button class="btn <?= $productType->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save_product_type">Lưu</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>



<script>
    'use strict';
    $(function () {
		$("#form_product_type").on('submit', function () {
            if (Team.validate('form_product_type')) {
				let formData = new FormData(document.getElementById("form_product_type"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_product_type');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});
	});
</script>