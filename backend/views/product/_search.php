<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $product backend\models\Product */
?>
<form id="form_product_search" class="search-form">
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_code"><?= $product->getAttributeLabel('code') ?></label>
                <input class="form-control" name="code" id="txt_code">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_name"><?= $product->getAttributeLabel('name') ?></label>
                <input class="form-control" name="name" id="txt_name">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_product_type_id"><?= $product->getAttributeLabel('product_type_id') ?></label>
				<select name="product_type_id" id="select_product_type_id" class="form-control select" title="">
					<option></option>
				</select>
			</div>
		</div>
		
        <div class="col-md-3 col-xs-12">
            <div class="form-group" style="margin-top: 22px">
                <a type="button" class="btn btn-default" id="btn_reset_filter">Thiết lập lại</a>
                <button class="btn blue-steel" id="btn_filter">Tìm kiếm</button>
            </div>
        </div>
	</div>
</form>
<script>
    $(function() {
        let body = $("body");
        // PHẦN TÌM KIẾM
        $("#form_product_search").on('submit', function () {
            $('#<?= $table ?>').DataTable().clearPipeline().draw();
            return false;
        });
        $(document).keyup(function(e) {
            if (e.keyCode === 27) { // escape key maps to keycode `27`
                $("#btn_reset_filter").trigger('click');
            }
        });
        body.on('click', '#btn_reset_filter', function () {
            $("#form_product_search").find('input, select').val('').trigger('change');
            $('#<?= $table ?>').DataTable().clearPipeline().order([]).draw();
        });
        //END PHẦN TÌM KIẾM

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
