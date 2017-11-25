<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $detailOrderFoods[] backend\models\DetailOrderFood */
/* @var $detailOrderFood backend\models\DetailOrderFood */
?>

<form id="form_order_food" role="form">
	<div id="error_summary"></div>
	<div class="row">
		<input type="hidden" name="OrderFood[id]" value="<?= $orderFood->id ?>">
		<div class=" col-md-9">
			<div class="row">
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
					
						<label for="txt_full_name" class="control-label">
		                	<?= $orderFood->getAttributeLabel('full_name') ?>
							<span class="font-red-mint">*</span>
						</label>
						 <input class="form-control alphanum require " name="OrderFood[full_name]" value="<?= $orderFood->full_name ?>" id="txt_full_name" autofocus> 
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
		                <label for="txt_phone" class="control-label">
		                	<?= $orderFood->getAttributeLabel('phone') ?>
	                		<span class="font-red-mint">*</span>
	                	</label>
		                <input class="form-control alphanum number require" name="OrderFood[phone]" value="<?= $orderFood->phone ?>" id="txt_phone">
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
						<div class="row">
							<div class="col-md-10">
								<label for="select_tables_id" class="control-label">
									<?= $orderFood->getAttributeLabel('tables_id') ?>
									<span class="font-red-mint">*</span>
								</label>
								<input class="form-control" name="txt_test_1" value="" id="txt_test_1">
								<input class="form-control" name="" value="" id="txt_test_2">

<!-- OrderFood[tables_id] -->
								<!-- <select name="" id="select_tables_id" class="form-control select require"> 
									<option></option>
				                    <?php if ( $orderFood->tables_id != null ): ?>
				                        <option value="<?= $orderFood->tables_id ?>" selected><?= $orderFood->tables->name ?></option>
				                    <?php endif ?>
								</select> -->
							</div>
							<div class="col-md-2" style="top:23px;">
								
								<a href="javascript:;" class="btn btn-icon-only blue" id="id_tables_modal">
		                            <i class="fa fa-plus"></i>
		                        </a>
							</div>
						</div>
						
						
						
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
		                <label for="txt_email" class="control-label"><?= $orderFood->getAttributeLabel('email') ?></label>
		                <input class="form-control email" name="OrderFood[email]" value="<?= $orderFood->email ?>" id="txt_email">
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
		                <label for="txt_info_order" class="control-label">
		                	<?= $orderFood->getAttributeLabel('info_order') ?>
	                		<span class="font-red-mint">*</span>
	                	</label>
		                <input class="form-control alphanum require" name="OrderFood[info_order]" value="<?= $orderFood->info_order ?>" id="txt_info_order">
					</div>
				</div>
				<div class="col-md-4 col-xs-6">
					<div class="form-group">
		                <label for="txt_created_date_order" class="control-label">
		                	<?= $orderFood->getAttributeLabel('created_date_order') ?>
	                		<span class="font-red-mint">*</span>
	                	</label>
		                <div class="input-group">
		                    <input class="form-control require" name="created_date_order" value="<?= Yii::$app->formatter->asDate($orderFood->created_date_order) ?> " readonly id="txt_created_date_order"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		                </div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class=" col-md-12  col-xs-12">
					<div class="form-group">
		                <label for="textarea_note" class="control-label"><?= $orderFood->getAttributeLabel('note') ?></label>
		                <textarea class="form-control" name="OrderFood[note]" id="textarea_note" cols="30" rows="4"><?= $orderFood->note ?></textarea>
					</div>
				</div>
			</div>
		</div>

		
		
		
	</div>
    <div class="detail-title">
        <label for="">Danh sách món ăn</label>
    </div>
    <div class="row" id="detail_order_food_section">
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="select_detail_order_food_product_id" class="control-label"><?= $detailOrderFood->getAttributeLabel('product_id') ?>:</label>
				<select id="select_detail_order_food_product_id" class="form-control select ">
					<option></option>
				</select>
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
			<div class="form-group">
				<label for="txt_detail_order_food_quantity" class="control-label"><?= $detailOrderFood->getAttributeLabel('quantity') ?>:</label>
				<input class="form-control alphanum number" id="txt_detail_order_food_quantity">
			</div>
		</div>
		<div class="col-md-3 col-xs-6">
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="btn_add_detail_order_food" style="margin-top: 24px">Thêm</button>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 form-group">
			<table id="table_detail_order_food" class="table table-striped table-bordered nowrap">
				<thead>
				<tr>
					<th><?= $detailOrderFood->getAttributeLabel('product_id') ?></th>
					<th><?= $detailOrderFood->getAttributeLabel('quantity') ?></th>
                    <th width="10%">Hành động</th>
				</tr>
				</thead>
				<tbody>
				<?php if ( isset($detailOrderFoods) && is_array($detailOrderFoods) ): ?>
					<?php foreach ( $detailOrderFoods as $key => $detailOrderFood ): ?>
						<tr>
							<td>
                                <?= $detailOrderFood->product_id != null ? $detailOrderFood->product->name : '' ?>
								<input type="hidden" class="txt-product-id" name="DetailOrderFood[<?= $key ?>][product_id]" value="<?= $detailOrderFood->product_id?>">
							</td>
							<td>
								<input title="" class="form-control txt-quantity number" name="DetailOrderFood[<?= $key ?>][quantity]" value="<?= $detailOrderFood->quantity ?>">
							</td>
							<td>
								<button type="button" class="btn btn-danger btn-remove-detail-order-food"> <i class="glyphicon glyphicon-trash"></i> </button>
							</td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
    <div class="form-footer">
        <a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
        <button class="btn <?= $orderFood->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save_order_food">Lưu</button>
    </div>
</form>


<script>
    'use strict';
    $(function () {
    	$('#id_tables_modal').on('click', function() {
    		var data = "test";
            Team.showModal(data, '<?php echo Url::to(['/order-food/modal-tables']) ?>', $('#modal_lg'));
        });

    	var arrP = [];
    	$(".txt-product-id").map(function() {
    		arrP.push($(this).val())
    	}).get();

		$("#form_order_food").on('submit', function () {
            if (Team.validate('form_order_food')) {
				let formData = new FormData(document.getElementById("form_order_food"));
                Team.submitForm('<?= Url::to( [ 'save' ] ) ?>', formData).then(function(result) {
					if (typeof result !== 'object' && result.includes('http')) {
						location.href = result;
					} else {
                        Team.showErrorSummary(result, '#form_order_food');
					}
				});
			} else {
                $('.error').first().focus();
            }
			return false;
		});
//		MODEL DETAIL
		let tableDetailOrderFood = $("#table_detail_order_food").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
		});
		let body = $("body");
		$("#btn_add_detail_order_food").on('click', function() {
			let productText = $("#select_detail_order_food_product_id").select2('data')[0]['name'];
            let productId = $("#select_detail_order_food_product_id").val();
            let quantity = $("#txt_detail_order_food_quantity").val();
            
            if(productId != "" && quantity != ""){
            	$("#txt_detail_order_food_quantity").btOff();
            	$("#select_detail_order_food_product_id").btOff();
            
            	let index = tableDetailOrderFood.rows().count();

	            let valid = false;
	            while (!valid) {
	                if ($(`input[name="DetailOrderFood[${index}][id]"]`).length > 0) {
	                    index++;
	                } else {
	                    valid = true;
	                }
	            }
	            
	            arrP.push(productId);
				tableDetailOrderFood.row
	                .add([`<input type="hidden" name="DetailOrderFood[${index}][id]">` + 
					productText + `<input type="hidden" name="DetailOrderFood[${index}][product_id]" value="${productId}" class="txt-product-id">`
					,`<input type="text" name="DetailOrderFood[${index}][quantity]" value="${quantity}" class="form-control txt-quantity number">`
					,'<button type="button" class="btn btn-danger btn-remove-detail-order-food"> <i class="glyphicon glyphicon-trash"></i> </button>'])
	                .draw(false);
	            $("#detail_order_food_section").find('input, select').val('').trigger('change').first().focus();
	            let offSet = (parseInt(index) + 1) * 51;
	            $(".dataTables_scrollBody").scrollTop(offSet);
	//            $('.DTFC_LeftBodyLiner').scrollTop(offSet);
	//            $('.DTFC_RightBodyLiner').scrollTop(offSet);
            }else{
            	$("#select_detail_order_food_product_id").bt('Vui lòng chọn', {
                    trigger: 'none',
                    clickAnywhereToClose: false,
                    positions: ['top'],
                    fill: 'rgba(33, 33, 33, .8)',
                    spikeLength: 10,
                    spikeGirth: 10,
                    cssStyles: {color: '#FFF', fontSize: '11px', textAlign: 'justify', width: 'auto'}
                });
                $("#select_detail_order_food_product_id").btOn();
                $("#select_detail_order_food_product_id").addClass('error');
                $("#select_detail_order_food_product_id").focus();

                $("#txt_detail_order_food_quantity").bt('Vui lòng nhập vào', {
                    trigger: 'none',
                    clickAnywhereToClose: false,
                    positions: ['top'],
                    fill: 'rgba(33, 33, 33, .8)',
                    spikeLength: 10,
                    spikeGirth: 10,
                    cssStyles: {color: '#FFF', fontSize: '11px', textAlign: 'justify', width: 'auto'}
                });
                $("#txt_detail_order_food_quantity").btOn();
                $("#txt_detail_order_food_quantity").addClass('error');
                $("#txt_detail_order_food_quantity").focus();
              
                return false;
            }
           
		});
		body.on('click', '.btn-remove-detail-order-food', function () {
			tableDetailOrderFood.row($(this).parents('tr')).remove().draw();
		});


		$("#select_detail_order_food_product_id").select2Ajax({

			url: "<?= Url::to( [ 'product/select-product' ] ) ?>",
			data: function(q){
				q.excludeIds = arrP
			},
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

		$("#select_tables_id").select2Ajax({
			url: "<?= Url::to( [ 'tables/select-tables' ] ) ?>",
			
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
		})


		
	});
</script>