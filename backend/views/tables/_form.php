<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $tables backend\models\Tables */
?>
<form id="form_tables" class="form-horizontal" role="form">
	<div id="error_summary"></div>
	<div class="form-body">
		<div class="row">
			<input type="hidden" name="Tables[id]" value="<?= $tables->id ?>">
			<div class="form-group">
	            <label for="txt_code" class="control-label col-md-3">
	            	<?= $tables->getAttributeLabel('name') ?>
					<span class="font-red-mint">*</span>
				</label>
	            <div class="col-md-9">
	                <input class="form-control alphanum require" name="Tables[name]" value="<?= $tables->name ?>" id="txt_name" autofocus>
	            </div>
	        </div>

	        <div class="form-group">
	            <label for="txt_code" class="control-label col-md-3">
	            	<?= $tables->getAttributeLabel('imei_device_id') ?>
					<span class="font-red-mint">*</span>
				</label>
	            <div class="col-md-9">
	                <select name="Tables[imei_device_id]" id="select_imei_device_id" class="form-control select require">
						<option></option>
	                    <?php if ( $tables->imei_device_id != null ): ?>
	                        <option value="<?= $tables->imei_device_id ?>" selected><?= $tables->imeiDevice->name ?></option>
	                    <?php endif ?>
					</select>
	            </div>
	        </div>
		</div>
	</div>
	<div class="form-actions right1 form-footer">
        <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
    	<button class="btn <?= $tables->isNewRecord ? 'blue' : 'green' ?>" id="btn_save_tables">Lưu</button>
    </div>
</form>
<div class="col-md-3"></div>
<div class="row"></div>
	
    
<script>
    'use strict';
    $(function () {
		$("#form_tables").on('submit', function () {
            if (Team.validate('form_tables')) {
				let formData = new FormData(document.getElementById("form_tables"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_tables');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});

		$("#select_imei_device_id").select2Ajax({
			url: "<?= Url::to( [ 'imme-device/select-imme-device' ] ) ?>",
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