<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $immeDevice backend\models\ImmeDevice */
?>
		<form class="form-horizontal" id="form_imme_device" role="form">
        	<div id="error_summary"></div>
            <div class="form-body">
            	<input type="hidden" name="ImmeDevice[id]" value="<?= $immeDevice->id ?>">
            	<div class="form-group">
                    <label for="txt_imei" class="control-label col-md-3">
                    	<?= $immeDevice->getAttributeLabel('imei') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                       <input class="form-control alphanum require" name="ImmeDevice[imei]" value="<?= $immeDevice->imei ?>" id="txt_imei">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_code" class="control-label col-md-3">
                    	<?= $immeDevice->getAttributeLabel('name') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                       <input class="form-control alphanum require" name="ImmeDevice[name]" value="<?= $immeDevice->name ?>" id="txt_name" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt_system" class="control-label col-md-3">
                    	<?= $immeDevice->getAttributeLabel('system') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                       <input class="form-control alphanum require" name="ImmeDevice[system]" value="<?= $immeDevice->system ?>" id="txt_system">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="txt_ip" class="control-label col-md-3">
                    	<?= $immeDevice->getAttributeLabel('ip') ?>
						<span class="font-red-mint">*</span>
					</label>
                    <div class="col-md-9">
                       <input class="form-control alphanum require" name="ImmeDevice[ip]" value="<?= $immeDevice->ip ?>" id="txt_ip">
                    </div>
                </div>
            </div>
            <div class="form-actions right1 form-footer">
	            <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
	        	<button class="btn <?= $immeDevice->isNewRecord ? 'blue' : 'green' ?>" id="btn_save_imme_device">Lưu</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-3"></div>
<div class="row"></div>

<script>
    'use strict';
    $(function () {
		$("#form_imme_device").on('submit', function () {
            if (Team.validate('form_imme_device')) {
				let formData = new FormData(document.getElementById("form_imme_device"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_imme_device');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});
	});
</script>