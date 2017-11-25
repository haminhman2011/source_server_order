<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $bill backend\models\Bill */
?>
<form id="form_bill">
	<div id="error_summary"></div>
	<div class="row">
		<input type="hidden" name="Bill[id]" value="<?= $bill->id ?>">
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
                <label for="txt_name" class="control-label"><?= $bill->getAttributeLabel('name') ?>
<span class="font-red-mint">*</span></label>
                <input class="form-control alphanum require" name="Bill[name]" value="<?= $bill->name ?>" id="txt_name" autofocus>
			</div>
		</div>
	</div>
    <div class="form-footer">
        <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
        <button class="btn <?= $bill->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save_bill">Lưu</button>
    </div>
</form>
<script>
    'use strict';
    $(function () {
		$("#form_bill").on('submit', function () {
            if (Team.validate('form_bill')) {
				let formData = new FormData(document.getElementById("form_bill"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_bill');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});
	});
</script>