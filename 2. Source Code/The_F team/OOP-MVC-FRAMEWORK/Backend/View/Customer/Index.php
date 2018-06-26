<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="?Controller=Customer">Khách hàng</a>
	</li>
	<li class="breadcrumb-item active">Tất cả khách hàng</li>
</ol>
      <!-- Breadcrumbs-->
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-table"></i> Danh sách sản phẩm</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Khách hàng</th>
							<th>Số điện thoại</th>
							<th>Mail</th>
							<th>Địa chỉ</th>
							<th>Thời gian nhập</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Mã đơn hàng</th>
							<th>Khách hàng</th>
							<th>Thành tiền</th>
							<th>Ghi chú</th>
							<th>Thời gian nhập</th>
							<th>Action</th>
						</tr>
					</tfoot>

					<tbody>
						<?php 
						$i = 0;
						foreach ($this->model as $customer_) 
						{
							$i++;
							echo '<script> var id' . $i . ' = "' . $customer_->Customer_Id . '";</script>';
							echo "<tr>
							<td>$i</td>
							<td>$customer_->Customer_Name</td>
							<td>$customer_->Customer_Phone</td>
							<td>$customer_->Customer_Mail</td>
							<td><div class='description-show'>$customer_->Customer_Address</div></td>
							<td>$customer_->create_time</td>
							<td>
							<a href='?Controller=Product&Action=ProductDetail&Id=$customer_->Customer_Id' class='btn btn-info'>Chi tiết</a>
							<button href='' class='btn btn-danger' onclick='deleteProduct(id$i)'>Xóa</button></td>                
							</tr>";
						}

						?>               
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer small text-muted">Create by Lê Cốp.</div>
	</div>
</div>

<!-- /.container-fluid-->
    <script src="Asset/js/deleteProduct.js"></script>
<script src="Asset/Admin-bootstrap-v1/vendor/jquery/jquery.min.js"></script>
<?php 
if (isset($_GET['status']) && $_GET['status'] === "insertCompleted") 
{
	echo ' <script> $(document).ready(function(){alert("Insert thành công!");});</script>';
}
 ?>

