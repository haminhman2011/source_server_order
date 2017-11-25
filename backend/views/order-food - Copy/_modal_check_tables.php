<?php 
use yii\helpers\Url;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Modal Title</h4>
</div>
<div class="modal-body"> 
	<div class="form-group">
		<div class="row">
			<div class="col-md-4">
	        	<div class="input-group">
                    <input class="form-control datetimepicker_check_tables" name="created_date_order" value="" readonly id="txt_datetime_check"><span class="input-group-addon datetimepicker_check_tables"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
	        </div>
	        <button type="button" class="btn btn-success btn_view_table_order">Xem</button>
		</div>
		
        <div class="row">
        	<div class="col-md-12">
	        	<label>Inline Checkboxes</label>
	        	<div class="mt-checkbox-inline">
		        <?php foreach ($tables as $key => $value): ?>
		            <label class="mt-checkbox">
		                <input type="checkbox" name="chk" id="chk" value="<?= $value->id ?>">
		                <label for="pre-payment"><?= $value->name ?></label>
		                <span></span>
		            </label>
		        <?php endforeach; ?>
		        </div>
	        </div>
	        
        </div>
       <div class="row">
       		<div class="col-md-12">
       			<label class="class_note"></label>
       		</div>
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-advance table-hover">
                    <tbody >
                    	<tr class="tbody_content">
                    		
                    	</tr>
                    </tbody>
                </table>
			</div>
		</div>
        
        
        

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <button type="button" class="btn green btn_change_order_table">Save changes</button>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var dateToday = new Date();
		var todayDate = new Date().getDate();

	$(".datetimepicker_check_tables").datepicker({
		 format: 'dd-mm-yyyy',
          
		// startDate: new Date(),
	});

    // $('#mantest').datetimepicker({
    //   maxDate: new Date(),
    //   minDate: new Date()
    // });
		// $('.datetimepicker__').datetimepicker({
		// 	// format: 'dd-mm-yyyy hh:i',
  //  //          autoclose: true,
  //  //          orientation: 'bottom left',
  //  //          todayHighlight: true,
  //  //          todayBtn: true,
  //  //          clearBtn: true,
  //  timepicker:false,
  // formatDate:'Y/m/d',
  //           minDate: new Date(),
		// });

		$(".btn-check").on("click", function(){
			var sList = "";
			var sLabel = "";
			$('input[name=chk]').each(function () {
				if(this.checked == true){
					var sThisVal = $(this).val();
					sList +=  (sList=="" ? sThisVal : "," + sThisVal);
					var txtLabel = $('#chk').next('label').text();
					sLabel +=  (sLabel=="" ? txtLabel : "," + txtLabel);
				}
			    // var sThisVal = (this.checked ? "1" : "0");
			    // sList += (sList=="" ? sThisVal : "," + sThisVal);
			});
			console.log (sLabel);
		})

		$(".btn_view_table_order").on("click", function(){
			var dt = new Date();
			var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			var dateNow = dt.getDate()+ "-" + (dt.getMonth()+1)  + "-" + dt.getFullYear();
			

			var txt_datetime_check = $("#txt_datetime_check").val();
			var sList = "";
			
			$('input[name=chk]').each(function () {
				if(this.checked == true){
					var sThisVal = $(this).val();
					sList +=  (sList=="" ? sThisVal : "," + sThisVal);
					
				}
			    // var sThisVal = (this.checked ? "1" : "0");
			    // sList += (sList=="" ? sThisVal : "," + sThisVal);
			});
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
                				tt += '0'+i + '<input type="radio" name="chk_2" id="chk_2" value="0'+i+'">';
                			}else{
                				tt += i + '<input type="radio" name="chk_2" id="chk_2" value="'+i+'">';
                			}
                			
                		}
	                	tt += '</td>';
	                	$('.tbody_content').append(tt);
                	}
                }
            })
			
		})

		$(".btn_change_order_table").on("click", function(){
			var sList = "";
			var sLabel = "";
			$('input[name=chk]').each(function () {
				if(this.checked == true){
					var sThisVal = $(this).val();
					sList +=  (sList=="" ? sThisVal : "," + sThisVal);
					var txtLabel = $(this).next('label').text();
					sLabel +=  (sLabel=="" ? txtLabel : "," + txtLabel);
				}

			});


			console.log(sLabel);
			var hours = "";
			$('input[name=chk_2]').each(function () {
				if(this.checked == true){
					hours = $(this).val();
					// console.log($(this).val())
				}

			});

			var chooseTime = $("#txt_datetime_check").val();

			$("#txt_created_date_order").val(chooseTime+' '+ hours+":00");
			$("#txt_test_1").val(sList);
			$("#txt_test_2").val(sLabel);
			

			$("#modal_lg").modal("hide");


		})
	})
</script>