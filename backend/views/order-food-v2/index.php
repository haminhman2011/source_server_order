<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Order Food';
$this->params['breadcrumbs'][] = $this->title;
/* @var $orderFood backend\models\OrderFood */
/* @var $this yii\web\View */
?>
<div class="order-food-index">
<br>
	<div class="row" style="background-color: #EEEEEE;">
		<div class="col-md-12">
			<h3 class="page-title margin-bottom-10">Tìm kiếm nâng cao</h3>
		</div>
		<div class="col-md-12 form-group">
			<div class="row">
				<div class="col-md-2">
					<label>Chọn ngày</label>
					<div class="input-group">
	                	<input class="form-control" name="created_date_order" value="" readonly>
	                	<span class="input-group-addon">
	                		<i class="glyphicon glyphicon-calendar"></i>
	                	</span>
	                </div>
				</div>
				<div class="col-md-10">
					<div class="col-md-12 form-group" style="top:25px;">
						<div class="btn-group btn-group-solid">
		                    <button type="button" class="btn red customer_order_after">
		                        <i class="fa fa-book "></i> D/S KH đặt trước (80)</button>
		                    <button type="button" class="btn green customer_check_in">
		                        <i class="fa fa-book  "></i> D/S KH đã nhận bàn/phòng (20)</button>
		                    
		                </div>
					</div>
	               
				</div>
			</div>
		</div>	
	</div>
	

	
	<div class="col-md-12">
		<div class="row">
            <div class="row col-md-4">
                <div class="form-group">
                    <h3 class="page-title margin-bottom-10">Danh sách Bàn/Phòng</h3>
            <!-- <button type="button" class="btn green-meadow">Đặt toàn bộ nhà hàng</button> -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div class="col-md-3">
                        <div class="foo green"></div> 
                        <span>Khách đặt trước</span>
                    </div>
                    <div class="col-md-3">
                        <div class="foo red"></div> 
                        <span>Khách đang ngồi</span>
                    </div>
                    <div class="col-md-3">
                        <div class="foo black"></div> 
                        <span>Bàn còn trống</span>
                    </div>
                    <div class="col-md-3">
                        <div class="foo yellow"></div> 
                        <span>Bàn đang dọn</span>
                    </div>
                </div>
            </div>
			
		</div>
	</div>
	<div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#tab_1_1_1" data-toggle="tab">Tầng trệt</a>
            </li>
            <li>
                <a href="#tab_1_1_2" data-toggle="tab">Tầng 1</a>
            </li>
            <li>
                <a href="#tab_1_1_3" data-toggle="tab">Tầng 2</a>
            </li>
        </ul>
        <div class="tab-content" style="height: 100%; background-color: #EEEEEE;">
            <div class="tab-pane active" id="tab_1_1_1">
            	<div class="row col-md-12 form-group">
            		<div class="row">
            			<div class="col-md-3">
	        				<label>Chọn ngày đặt</label>
	        				<div class="input-group">
		                    <input class="form-control" name="created_date_order" value="" readonly>
		                    	<span class="input-group-addon">
		                    		<i class="glyphicon glyphicon-calendar"></i>
		                    	</span>
		                    </div>
	            		</div>
	            		<div class="col-md-3" style="top:25px;">
	            			<button type="button" class="btn blue btn-sm">Chọn</button>
	            			<button type="button" class="btn red btn-sm order_after" style="width: 50%">Đặt toàn bộ</button>
	            		</div>

            		</div>
            	
            	</div>
            		
            	
                <div class="row">
                    <div class="page-wrapper">
              
                    <!-- BEGIN HEADER & CONTENT DIVIDER -->
                        <div class="clearfix"> </div>
                    <!-- END HEADER & CONTENT DIVIDER -->
                    <!-- BEGIN CONTAINER -->
                        <div class="">
                            <!-- BEGIN CONTENT -->
                            <div class="page-content-wrapper">
                                <!-- BEGIN CONTENT BODY -->
                                <div class="page-content restaurant">
                                    <div class="">
                                        <div class="_leftroom" >
                                            <div class="_restaurant-sign ">
                                                <div class="_restaurant-sign-title">
                                                    <div class="caption">
                                                        <i class="icon-bubble font-dark hide"></i>
                                                        <span class="caption-subject font-hide bold uppercase">Nhà vệ sinh</span>
                                                    </div>
                                                   
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="images/toilet.png">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="_door"><img src="images/door.png"></div>
                                            </div>
                                            <div class="_restaurant-sign">
                                                <div class="_restaurant-sign-title">
                                                    <div class="caption">
                                                        <i class="icon-bubble font-dark hide"></i>
                                                        <span class="caption-subject font-hide bold uppercase">Tiếp tân, quản lý</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <img src="images/businessman.png">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="_restaurant-sign _arrow">
                                                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                    <i class="fa fa-arrow-left arrow-right" aria-hidden="true"></i>
                                            </div>
                                            <div class="_restaurant-sign _kitchen-room">
                                                <div class="_restaurant-sign-title">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-bubble font-dark hide"></i>
                                                            <span class="caption-subject font-hide bold uppercase">Nhà bếp</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <img src="images/kitchen.png">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="_door"><img src="images/door.png"></div>
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="_rightroom">
                                            <div class="_dining-room">
                                                <div class="portlet-body">
                                                    <div class="row">
                                                    <?php for($i = 1; $i <=12 ; $i++): ?>
                                                        <div class="_tables_room">
                                                            <div class="_table">
                                                                <span>(Hiện có 4 người đang ngồi)</span>
                                                               <img src="images/table.png"> 
                                                                <div class="mt-body">
                                                                <br>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn blue"><?= $i ?></button>
                                                                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown">
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="javascript:;" class="check_in"><i class="fa fa-user"></i> Nhận bàn </a>
                                                                            </li>
                                                                            <li class="divider"> </li>
                                                                            <li>
                                                                                <a href="javascript:;" class="order_after"><i class="fa fa-check"></i>  Đặt bàn trước </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <span>(Bàn có 4 chỗ ngồi)</span>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>
                                        <div class="_main-door">

                                            <div class="_door"><label>Cửa ra vào</label> <img src="images/main-door.png" alt="Cửa ra vào" title="Cửa ra vào"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END CONTENT BODY -->
                            </div>
                            <!-- END CONTENT -->
                        </div>
                    <!-- END CONTAINER -->
                    </div>
                    
                </div>
            </div>
            <div class="tab-pane" id="tab_1_1_2">
                <div class="row">
                    <div class=" col-md-12 form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Chọn ngày đặt</label>
                                <div class="input-group">
                                <input class="form-control" name="created_date_order" value="" readonly>
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-calendar"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3" style="top:25px;">
                                <button type="button" class="btn blue btn-sm">Chọn</button>
                                <button type="button" class="btn red btn-sm order_after" style="width: 50%">Đặt toàn bộ</button>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="page-wrapper">
              
                    <!-- BEGIN HEADER & CONTENT DIVIDER -->
                        <div class="clearfix"> </div>
                    <!-- END HEADER & CONTENT DIVIDER -->
                    <!-- BEGIN CONTAINER -->
                        <div class="">
                            <!-- BEGIN CONTENT -->
                            <div class="page-content-wrapper">
                                <!-- BEGIN CONTENT BODY -->
                                <div class="page-content restaurant">
                                    <div class="">
                                        
                                        <div class="">
                                            <div class="_dining-room">
                                                <div class="portlet-body">
                                                    <div class="row">
                                                    <?php for($i = 1; $i <=12 ; $i++): ?>
                                                        <div class="_tables_room">
                                                            <div class="_table">
                                                                <span>(Hiện có 4 người đang ngồi)</span>
                                                               <img src="images/table.png"> 
                                                                <div class="mt-body">
                                                                <br>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn blue"><?= $i ?></button>
                                                                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown">
                                                                            <i class="fa fa-angle-down"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            <li>
                                                                                <a href="javascript:;" class="check_in"><i class="fa fa-user"></i> Nhận bàn </a>
                                                                            </li>
                                                                            <li class="divider"> </li>
                                                                            <li>
                                                                                <a href="javascript:;" class="order_after"><i class="fa fa-check"></i>  Đặt bàn trước </a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>

                                                                </div>
                                                                <span>(Bàn có 4 chỗ ngồi)</span>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>
                                        <div class="_main-door">

                                            <div class="_door"><label>Cửa ra vào</label> <img src="images/main-door.png" alt="Cửa ra vào" title="Cửa ra vào"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END CONTENT BODY -->
                            </div>
                            <!-- END CONTENT -->
                        </div>
                    <!-- END CONTAINER -->
                    </div>
                    
                </div>
                
                   
            </div>
            <div class="tab-pane" id="tab_1_1_3">
            	<div class="row">
            		p
                </div>
            	</div>
                
            </div>
        </div>
    </div>

	
	
</div>
<script type="text/javascript">
	$(document).ready(function(){ 
		
		$("body").on("click", ".customer_order_after", function(){
			$.ajax({
				url: "<?= Url::to(['modal-customer']) ?>",
				tyle: 'post',
				data:{id:'1'},
				success : function(result) {
					$('#modal_lg .modal-content').html(result);
					$("#modal_lg").modal();
				}
			});
		});
		$("body").on("click", ".customer_check_in", function(){
			$.ajax({
				url: "<?= Url::to(['modal-customer']) ?>",
				tyle: 'post',
				data:{id:'2'},
				success : function(result) {
					$('#modal_lg .modal-content').html(result);
					$("#modal_lg").modal();
				}
			});
		});
		$("body").on("click", ".order_after", function(){
			$.ajax({
				url: "<?= Url::to(['modal-order-after']) ?>",
				success : function(result) {
					$('#modal_lg .modal-content').html(result);
					$("#modal_lg").modal();
				}
			});
		});

		$("body").on("click", ".check_in", function(){
			$.ajax({
				url: "<?= Url::to(['modal-check-in']) ?>",
				success : function(result) {
					$('#modal_lg .modal-content').html(result);
					$("#modal_lg").modal();
				}
			});
		});
	})
</script>
<style type="text/css">
    .foo {
  float: left;
  width: 20px;
  height: 20px;
  margin: 5px;
  border: 1px solid rgba(0, 0, 0, .2);
}
.red {
    background: red;
}
.green {
    background: green;
}
.blue {
  background: #13b4ff;
}
.yellow{
    background: yellow;
}

.purple {
  background: #ab3fdd;
}
.black{
    background: black;
}

.wine {
  background: #ae163e;
}
	.table {
		width: 0px!important;
	}
	.tab-content{
		/*height: 1024px!important;*/
	}


	img{max-width: 100%;}
.page-wrapper{
	background: #fff;
	float: left;
    margin-left: 15px;
    margin-right: 15px;
}
.page-content.restaurant
{
	/*margin-left: 0;
	max-width: 1280px;
	float: left;
	padding: 20px;
	color: #000;
	border: 1px solid #e7ecf1;
	position: relative;
	overflow-y: scroll;
	height: 580px*/
}
.page-content.restaurant ._main-door {width: 128px;float: left;margin: auto;text-align: center;
padding: 10px 15px}
.page-content.restaurant ._main-door ._door{position: absolute;top: 68%;}
.page-content.restaurant ._main-door ._door img{max-width: 50px}
.restaurant ._leftroom{
width:389px;float: left;
}
.restaurant ._rightroom{
width:640px;float: left;
}
.restaurant ._dining-room{
	padding: 12px 20px 15px 20px;
    background-color: #fff;
    border: 1px solid #e7ecf1;
    text-align: center;
    width: 100%;
    float: left;
    margin: 12px 0 0
}
.restaurant ._tables_room{padding:20px;width: 33.33%;float: left;}
.restaurant ._tables_room ._table{
	padding: 15px;
	text-align: center;
	border:1px solid #e7ecf1;
}
.restaurant ._tables_room h3{font-weight: bold;}
.restaurant ._tables_room ._table img{max-width: 50%;}
.restaurant ._restaurant-sign{
	padding: 12px 20px 15px;
    background-color: #fff;
    border: 1px solid #e7ecf1;
    text-align: center;
    margin: 10px;
    width: 171px;
    float: left;
    min-height: 320px;
    position: relative;
}
.restaurant ._restaurant-sign ._door{position: absolute;left: 0;bottom: 0;width: 40px;height: auto;}
.restaurant ._restaurant-sign ._restaurant-sign-title{margin-bottom: 15px;text-transform: uppercase;font-size: 15px;font-weight: bold;}
.restaurant ._restaurant-sign._kitchen-room{width: 343px}
.restaurant ._restaurant-sign._kitchen-room ._door{position: absolute;
	right: 0;left: auto;bottom: 0;width: 40px;height: auto;}
	.restaurant ._restaurant-sign._kitchen-room i{position: absolute;
	right: 0;left: 100%;bottom: 20px;width: 40px;height: auto;font-size: 30px;  color: #000;  }
.restaurant ._restaurant-sign._arrow{width: 96%;min-height: auto;border:none;text-align: left;font-size: 30px}
.restaurant ._restaurant-sign._arrow .arrow-right{float: right;}
</style>