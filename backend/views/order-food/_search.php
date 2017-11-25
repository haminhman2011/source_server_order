<?php
/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
?>
<form id="form_order_food_search" class="search-form">
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_full_name"><?= $orderFood->getAttributeLabel('full_name') ?></label>
                <input class="form-control" name="full_name" id="txt_full_name">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_phone"><?= $orderFood->getAttributeLabel('phone') ?></label>
                <input class="form-control" name="phone" id="txt_phone">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_email"><?= $orderFood->getAttributeLabel('email') ?></label>
                <input class="form-control" name="email" id="txt_email">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_info_order"><?= $orderFood->getAttributeLabel('info_order') ?></label>
                <input class="form-control" name="info_order" id="txt_info_order">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_note"><?= $orderFood->getAttributeLabel('note') ?></label>
                <input class="form-control" name="note" id="txt_note">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_created_date_order"><?= $orderFood->getAttributeLabel('created_date_order') ?></label>
                <div class="input-group date">
                    <input class="form-control datepicker" name="created_date_order" id="txt_created_date_order"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
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
        $("#form_order_food_search").on('submit', function () {
            $('#<?= $table ?>').DataTable().clearPipeline().draw();
            return false;
        });
        $(document).keyup(function(e) {
            if (e.keyCode === 27) { // escape key maps to keycode `27`
                $("#btn_reset_filter").trigger('click');
            }
        });
        body.on('click', '#btn_reset_filter', function () {
            $("#form_order_food_search").find('input, select').val('').trigger('change');
            $('#<?= $table ?>').DataTable().clearPipeline().order([]).draw();
        });
        //END PHẦN TÌM KIẾM
    });
</script>
