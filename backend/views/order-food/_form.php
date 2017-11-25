<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $orderFood backend\models\OrderFood */
/* @var $tablesOrders[] backend\models\TablesOrder */
/* @var $tablesOrder backend\models\TablesOrder */
?>
		<form class="form-horizontal" id="form_order_food" role="form">
			<div class="form-body">
				<div id="error_summary"></div>
				<input type="hidden" name="OrderFood[id]" value="<?= $orderFood->id ?>">
				<div class="form-group">
					<div class="col-md-4 col-xs-6">
						 <label for="txt_full_name" class="control-label"><?= $orderFood->getAttributeLabel('full_name') ?>
							<span class="font-red-mint">*</span></label>
		                <input class="form-control alphanum require" name="OrderFood[full_name]" value="<?= $orderFood->full_name ?>" id="txt_full_name" autofocus>
					</div>
					<div class="col-md-4 col-xs-6">
		                <label for="txt_phone" class="control-label"><?= $orderFood->getAttributeLabel('phone') ?></label>
		                <input class="form-control alphanum" name="OrderFood[phone]" value="<?= $orderFood->phone ?>" id="txt_phone">
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="form-group">
			                <label for="txt_email" class="control-label"><?= $orderFood->getAttributeLabel('email') ?></label>
			                <input class="form-control email" name="OrderFood[email]" value="<?= $orderFood->email ?>" id="txt_email">
						</div>
					</div>
	               
				</div>
				<div class="form-group">
					<div class="col-md-4 col-xs-6">
		                <label for="txt_info_order" class="control-label"><?= $orderFood->getAttributeLabel('info_order') ?></label>
		                <input class="form-control alphanum" name="OrderFood[info_order]" value="<?= $orderFood->info_order ?>" id="txt_info_order">
					</div>
					<div class="col-md-4 col-xs-6">
		                <label for="txt_created_date_order" class="control-label"><?= $orderFood->getAttributeLabel('created_date_order') ?></label>
		                <div class="input-group">
		                    <input class="form-control" name="created_date_order" value="<?= Yii::$app->formatter->asDate($orderFood->created_date_order) ?>" id="txt_created_date_order" readonly><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		                </div>
					</div>

				</div>
				<div class=" form-group">
					<div class="col-md-12  col-xs-12">
		                <label for="textarea_note" class="control-label"><?= $orderFood->getAttributeLabel('note') ?></label>
		                <textarea class="form-control" name="OrderFood[note]" id="textarea_note" cols="30" rows="5"><?= $orderFood->note ?></textarea>
					</div>
				</div>
				<div class="form-group ">
					<div class="col-md-12">
						<div class="detail-title">
			   				 <label for="">Danh sách</label>
				    	</div>
					    
					    	<div class="form-group">
					    		<div class="col-md-3 col-xs-3">
					    			<label class="control-label">Chọn ngày:</label>
						        	<div class="input-group">
						                <input class="form-control datetimepicker_check_tables"  readonly id="txt_datetime_check">
						                <span class="input-group-addon datetimepicker_check_tables">
						                	<i class="glyphicon glyphicon-calendar"></i>
						                </span>
						            </div>
					            </div>
								<div class="col-md-3 col-xs-3">
									<label for="select_tables_order_tables_id" class="control-label"><?= $tablesOrder->getAttributeLabel('tables_id') ?>:</label>
									<select id="select_tables_order_tables_id" class="form-control select">
										<option></option>
									</select>
								</div>
						<div id="tables_order_section">	
								<div class="col-md-3 col-xs-3">
					                <button type="button" class="btn btn-primary" id="btn_add_tables_order" style="margin-top: 24px">Chọn bàn</button>
					                <button type="button" class="btn btn-primary" id="btn_add_time_order" style="margin-top: 24px">Chọn giờ</button>
								</div>
							</div>
						</div>
						<?php if(!$orderFood->isNewRecord): ?>
							<div class="col-md-12">
								<div class="form-group">
									<table class="table table-striped table-bordered table-advance table-hover">
							            <tbody >
							            	<tr class="tbody_content">
							            		<?php if ( isset($orderFood)): $date = date('H',$orderFood->created_date_order);?>
							            			<?php for($i = 1; $i <=24; $i++): ?>
							            				<?php if($date == $i): ?>
							            					<?php if($i <= 9): ?>
								            					<td>0<?= $i ?><br><input type="radio" name="type" checked="checked" value="0<?= $i ?>"/></td>
								            				<?php else: ?>
								            					<td><?= $i ?><br><input type="radio" name="type" checked="checked" value="<?= $i ?>"/></td>
								            				<?php endif; ?>
							            				<?php else: ?>
							            					<?php if($i <= 9): ?>
								            					<td>0<?= $i ?><br><input type="radio" name="type" value="0<?= $i ?>"/></td>
								            				<?php else: ?>
								            					<td><?= $i ?><br><input type="radio" name="type" value="<?= $i ?>"/></td>
								            				<?php endif; ?>
							            				<?php endif; ?>
							            				
							            			<?php endfor; ?>
							            		<?php endif; ?>
							            	</tr>
							            </tbody>
							        </table>
						        </div>
							</div>
						<?php else: ?>
							<div class="col-md-12">
								<div class="form-group">
									<table class="table table-striped table-bordered table-advance table-hover">
							            <tbody >
							            	<tr class="tbody_content">
							            	</tr>
							            </tbody>
							        </table>
							    </div>
							</div>
						<?php endif; ?>
						<div class="col-md-12">
							<div class="form-group">
								<table id="table_tables_order" class="table table-striped table-bordered nowrap">
									<thead>
									<tr>
										<th><?= $tablesOrder->getAttributeLabel('tables_id') ?></th>
					                    <th width="10%">Hành động</th>
									</tr>
									</thead>
									<tbody>
									<?php if ( isset($tablesOrders) && is_array($tablesOrders) ): ?>
										<?php foreach ( $tablesOrders as $key => $tablesOrder ): ?>
											<tr>
												<td>
					                                <?= $tablesOrder->tables_id != null ? $tablesOrder->tables->name : '' ?>
													<input type="hidden" class="txt-tables-id" name="TablesOrder[<?= $key ?>][tables_id]" value="<?= $tablesOrder->tables_id?>">
												</td>
												<td>
													<button type="button" class="btn btn-danger btn-remove-tables-order"> <i class="glyphicon glyphicon-trash"></i> </button>
												</td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<div class="detail-title">
					        <label for="">Danh sách món ăn</label>
					    </div>
					    <div id="detail_order_food_section">
					    	<div class="form-group">
					    		<div class="col-md-3 col-xs-6">
									<label for="select_detail_order_food_product_id" class="control-label"><?= $detailOrderFood->getAttributeLabel('product_id') ?>:</label>
									<select id="select_detail_order_food_product_id" class="form-control select ">
										<option></option>
									</select>
								</div>
								<div class="col-md-3 col-xs-6">
									<label for="txt_detail_order_food_quantity" class="control-label"><?= $detailOrderFood->getAttributeLabel('quantity') ?>:</label>
									<input class="form-control alphanum number" id="txt_detail_order_food_quantity">
								</div>
								<div class="col-md-3 col-xs-6">
						            <button type="button" class="btn btn-primary" id="btn_add_detail_order_food" style="margin-top: 24px">Thêm</button>
								</div>
					    	</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
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
					</div>
				</div>

			</div>
			<div class="form-actions form-footer">
				<div class="form-group">
					<a class="btn btn-default" href="<?= Url::to( [ 'index' ] ) ?>">Hủy</a>
		        	<button class="btn <?= $orderFood->isNewRecord ? 'blue-steel' : 'green-haze' ?>" id="btn_save_order_food">Lưu</button>
				</div>
		    </div>
		</form>	
	</div>
</div>


<script>
    'use strict';
    $(function () {
    	var arrP = [];
    	$(".txt-tables-id").map(function() {
    		arrP.push($(this).val())
    	}).get();
    	var arrProduct = [];
    	$(".txt-product-id").map(function() {
    		arrProduct.push($(this).val())
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
		let tableTablesOrder = $("#table_tables_order").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
		});
		let body = $("body");
		$("#btn_add_tables_order").on('click', function() {
            let index = tableTablesOrder.rows().count();
            let valid = false;
            while (!valid) {
                if ($(`input[name="TablesOrder[${index}][id]"]`).length > 0) {
                    index++;
                } else {
                    valid = true;
                }
            }
            let tablesText = $("#select_tables_order_tables_id").select2('data')[0]['name'];
            let tablesId = $("#select_tables_order_tables_id").val();
            arrP.push(tablesId);
			tableTablesOrder.row
                .add([`<input type="hidden" name="TablesOrder[${index}][id]">` + 
				tablesText + `<input type="hidden" name="TablesOrder[${index}][tables_id]" value="${tablesId}" class="txt-tables-id">`
				,'<button type="button" class="btn btn-danger btn-remove-tables-order"> <i class="glyphicon glyphicon-trash"></i> </button>'])
                .draw(false);
            $("#tables_order_section").find('input, select').val('').trigger('change').first().focus();
            let offSet = (parseInt(index) + 1) * 51;
            $(".dataTables_scrollBody").scrollTop(offSet);
//            $('.DTFC_LeftBodyLiner').scrollTop(offSet);
//            $('.DTFC_RightBodyLiner').scrollTop(offSet);
		});
		body.on('click', '.btn-remove-tables-order', function () {
			tableTablesOrder.row($(this).parents('tr')).remove().draw();
		});

		let tableDetailOrderFood = $("#table_detail_order_food").DataTable({
            paging: false,
            scrollY: '276px',
            scrollCollapse: true,
            scrollX: true,
            sort: false
		});
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
	            
	            arrProduct.push(productId);
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
				q.excludeIds = arrProduct
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



		$("#select_tables_order_tables_id").select2Ajax({
			url: "<?= Url::to( [ 'tables/select-tables' ] ) ?>",
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
		})

		$(".datetimepicker_check_tables").datepicker({
			format: 'dd-mm-yyyy',
	          
			// startDate: new Date(),
		});



		

		$("#btn_add_time_order").on("click", function(){
			$('.tbody_content').html("");
	    	var dt = new Date();
			var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			var dateNow = dt.getDate()+ "-" + (dt.getMonth()+1)  + "-" + dt.getFullYear();
			

			var txt_datetime_check = $("#txt_datetime_check").val();
			var sList = "";
	    	$(".txt-tables-id").map(function() {
				var sThisVal = $(this).val();
				sList +=  (sList=="" ? sThisVal : "," + sThisVal);
				
			})
			$.ajax({
                url: "<?= Url::to(['view-tables-order']) ?>",
                type: 'post',
                data: {
                        'txt_datetime_check': txt_datetime_check,
                        'sList': sList,
                    },
                success: function (data) {
                	 // console.log(data);
                	var json = $.parseJSON(data);
                	var result = json.map(function (x) { 
					    return parseInt(x); 
					});
                	$(".class_note").text("Thời gian đặt món");
                	for (var i = 1; i <=24; i++) {
                		var tt = '<td class="highlight">';
                		 // kiem tra trong array > 0 hay ko va so sanh
                		 var test = 0;
                		if($.inArray(i,result) >= 0){
                			// console.log(i);
                			if(i < 10){
                				tt += '0'+i;
                			}else{
                				tt += i;
                			}
                			
                		}else{
                			if(i < 10){
                				tt += '0'+i + '<br><input type="radio" name="type" value="0'+i+'"/>';
                			}else{
                				tt += i + '<br><input type="radio" name="type" value="'+i+'"/>';
                			}
                			
                		}
	                	tt += '</td>';
	                	$('.tbody_content').append(tt);
                	}
                }
            })
		})

		body.on('change', "input[name='type']", function () {
			if(this.checked == true){
				var chooseTime = $("#txt_datetime_check").val();
		        
		        $("#txt_created_date_order").val(chooseTime+' '+ $(this).val()+":00");
		        //$('#select-table > .roomNumber').attr('enabled',false);
		    }
		})

		

		// $("#chk_2 input[name='chk_2']").click(function(){
		//     alert('You clicked radio!');
		//     if(this.checked == true){
		//         alert($(this).val());
		//         //$('#select-table > .roomNumber').attr('enabled',false);
		//     }
		// });
	});

</script>