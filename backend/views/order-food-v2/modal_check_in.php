<?php 
use yii\helpers\Url;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Nhận bàn : ...</h4>
</div>
<div class="modal-body"> 
	<div class="form-group">
		<div class="row">
			<div class="col-md-3">
				<label>Tên khách hàng:</label>
				<input type="" class="form-control" name="">
			</div>
			<div class="col-md-3">
				<label>Số điện thoại:</label>
				<input type="" class="form-control" name="">
			</div>
			<div class="col-md-3" style="top:25px;">
				<button type="button" class="btn green">Tìm kiếm</button>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-hover table-checkable nowrap" style="width: 100%!important;">
					<thead>
						<tr>
							<th>Mã khách hàng</th>
							<th>Tên khách hàng</th>
							<th>Số điện thoại</th>
							<th>Nhận bàn</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>MKH001</td>
							<td>HMM</td>
							<td>01685524224</td>
							<td>
								<a href="javascript:;" class="btn btn-icon-only red">
                                                                            <i class="fa fa-edit"></i>
                                                                        </a>
							</td>
						</tr>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>