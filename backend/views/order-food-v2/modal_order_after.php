<?php 
use yii\helpers\Url;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Đặt bàn : ...</h4>
    <div class="row">
    	<div class="col-md-3">
	    	<input type="" class="form-control" name="" placeholder="Số điện thoại">
	    </div>
	    <div class="col-md-3">
	    	<button type="button" class="btn blue btn-sm">Tìm kiếm thông tin KH</button>
	    </div>
    </div>
    
</div>
<div class="modal-body"> 
	<div class="form-group">
		<div class="row">
			<div class="col-md-12">
				<label>Thông tin đăng ký:</label>
			</div>
			<div class="col-md-6">
				
				<div class="row">
					<div class="col-md-6">
			        	<label>Mã khách hàng</label>
			        	<input type="" class="form-control" name="" readonly>
			        </div>
			       
			        <div class="col-md-6">
			        	<label>Họ & tên</label>
			        	<input type="" class="form-control" name="">
			        </div>
			        <div class="col-md-6">
			        	<label>Phone</label>
			        	<input type="" class="form-control" name="">
			        </div>
			        <div class="col-md-6">
			        	<label>Địa chỉ</label>
			        	<input type="" class="form-control" name="">
			        </div>
			        <div class="col-md-6">
			        	<label>Email</label>
			        	<input type="" class="form-control" name="">
			        </div>
			        <div class="col-md-6">
			        	<label>Số lượng khách</label>
			        	<input type="" class="form-control" name="">
			        </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-6">
		        	<label>Ngày đặt</label>
		        	<input type="" class="form-control" name="" readonly>
		        </div>
		        <div class="col-md-12">
		        	<label>Giờ đặt:</label>
		        	<br>
		        	<div class="mt-radio-inline">
		        	<?php for($i=1;$i<=24; $i++): ?>
		        		<?php if($i <10): ?>
		        			<label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1">0<?= $i ?>
                                <span></span>
                            </label>
		        		<?php else: ?>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1"><?= $i ?>
                                <span></span>
                            </label>
                        <?php endif; ?>
                        
		        	
		        	<?php endfor; ?>
		        	</div>
		        </div>
			</div>
			<div class="col-md-12 form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Tên món ăn</label>
						<input type="" class="form-control" name="">
					</div>
					<div class="col-md-3">
						<label>Phần</label>
						<input type="" class="form-control" name="">
					</div>
					<div class="col-md-3" style="top:25px;">
						<button type="button" class="btn blue btn-sm">Chọn</button>
					</div>

				</div>
				<br>
				<div class="row  form-group">
					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover table-checkable nowrap" style="width: 100%!important;">
						<thead>
							<tr>
								<th>Tên món ăn</th>
								<th>Phần ăn</th>
								<th>Hành động</th>
							</tr>
						</thead>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
    <button type="button" class="btn green btn_change_order_table">Save changes</button>
</div>