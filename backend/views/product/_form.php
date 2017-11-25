<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $product backend\models\Product */
?>

        <form class="form-horizontal" id="form_product" role="form">
        	<div id="error_summary"></div>
            <div class="form-body">
            	<input type="hidden" name="Product[id]" value="<?= $product->id ?>">
                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                    	<?= $product->getAttributeLabel('code') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                        <input class="form-control alphanum require" name="Product[code]" value="<?= $product->code ?>" id="txt_code" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_name" class="control-label col-md-3">
                    		<?= $product->getAttributeLabel('name') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                        <input class="form-control alphanum require" name="Product[name]" value="<?= $product->name ?>" id="txt_name" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="select_product_type_id" class="control-label col-md-3">
                    		<?= $product->getAttributeLabel('product_type_id') ?>
                            <span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                        <select name="Product[product_type_id]" id="select_product_type_id" class="form-control select require">
							<option></option>
		                    <?php if ( $product->product_type_id != null ): ?>
		                        <option value="<?= $product->product_type_id ?>" selected><?= $product->productType->name ?></option>
		                    <?php endif ?>
						</select>
                    </div>
                </div>
                <div class="form-group">
                     <label for="txt_price" class="control-label col-md-3">
                         <?= $product->getAttributeLabel('price') ?>
                         <span class="font-red-mint">*</span>
                     	
                     </label>
                    <div class="col-md-9">
                        <input class="form-control alphanum require" name="Product[price]" value="<?= $product->price ?>" id="txt_price">
                    </div>
                </div>

                <div class="form-group">
                     <label for="txt_image" class="control-label col-md-3">
                     	<?= $product->getAttributeLabel('image') ?>
                     </label>
                    <div class="col-md-9">
                        <?php if($product->isNewRecord): ?>
							<div class="fileinput fileinput-new" data-provides="fileinput">
				                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
				                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> </div>
				                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
				                <div>
				                    <span class="btn default btn-file">
				                        <span class="fileinput-new"> Select image </span>
				                        <span class="fileinput-exists"> Change </span>
				                        <input type="file" name="image"> </span>
				                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
				                </div>
				            </div>
						<?php else: ?>
							<div class="fileinput fileinput-exists" data-provides="fileinput">
				               
				                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
				                <img src="<?= Yii::getAlias('@web') . '/uploads/product/'.$product->image ?>" alt="">
				                </div>
				                <div>
				                    <span class="btn default btn-file">
				                        <span class="fileinput-exists"> Change </span>
				                        <input type="file" name="image"> </span>
				                </div>
				            </div>
						<?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                     <label for="textarea_note" class="control-label col-md-3">
                     <?= $product->getAttributeLabel('textarea_note') ?>
                     <span class="font-red-mint">*</span>
                     	
                     </label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="Product[note]" id="textarea_note" cols="30" rows="5"><?= $product->note ?></textarea>
                    </div>
                </div>
                
            </div>
            <div class="form-actions right1 form-footer">
	            <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
	        	<button class="btn <?= $product->isNewRecord ? 'blue' : 'green' ?>" id="btn_save_product">Lưu</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>

<script>
    'use strict';
    $(function () {
		$("#form_product").on('submit', function () {
            if (Team.validate('form_product')) {
				let formData = new FormData(document.getElementById("form_product"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
                	if(result != 'error'){
                		if (typeof result !== 'object' && result.includes('http')) {
							location.href = result;
						} else {
	                        Team.showErrorSummary(result, '#form_product');
						}
                	}else{
                		$("#txt_code").bt('Mã đã bị trùng', {
                            trigger: 'none',
                            clickAnywhereToClose: false,
                            positions: ['top'],
                            fill: 'rgba(33, 33, 33, .8)',
                            spikeLength: 10,
                            spikeGirth: 10,
                            cssStyles: {color: '#FFF', fontSize: '11px', textAlign: 'justify', width: 'auto'}
                        });
                        $("#txt_code").btOn();
                        $("#txt_code").addClass('error');
                        $("#txt_code").focus();
                      
                        return false;
                	}
					
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});


		$("#select_product_type_id").select2Ajax({
			url: "<?= Url::to( [ 'product-type/select-product-type' ] ) ?>",
			templateResult: function (repo) {
				if (typeof repo.name !== 'undefined') {
					return "<div class='select2-result-repository clearfix'>" +
						"<div class='select2-result-repository__title'>" + repo.name + "</div>";
				}
			},
			templateSelection: function (repo) {
				if (typeof repo.name === 'undefined') {
					repo.name = repo.text;
				}
				return repo.name;
			}
		});
	});
</script>