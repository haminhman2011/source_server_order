<?php 
use yii\helpers\Url;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?= $id == '1' ? 'D/S KH đặt trước': 'D/S KH nhận bàn/phòng'; ?></h4>
</div>
<div class="modal-body"> 
	<div class="form-group">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered table-hover table-checkable nowrap" style="width: 100%!important;">
					<thead>
						<tr>
							<th>Mã KH</th>
							<th>Họ tên</th>
							<th>Ngày đặt</th>
							<th>Tầng</th>
							<th>Bàn/Phòng đặt</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>MKH001</td>
							<td>Hà minh mẫn</td>
							<td>20-11-1993</td>
							<td>tầng 2</td>
							<td>Phòng 3</td>
							<td>
							<?php if($id == 1): ?>
								<a href="javascript:;" class="btn btn-sm blue"><i class="fa fa-file-o"></i> Nhận bàn/phòng </a>
							<?php else: ?>
								<a href="javascript:;" class="btn btn-sm blue"><i class="fa fa-file-o"></i> Thanh toán </a>
								<a href="javascript:;" class="btn btn-sm blue"><i class="fa fa-file-o"></i> Cập nhật </a>
							<?php endif; ?>
							</td>

						</tr>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
</div>