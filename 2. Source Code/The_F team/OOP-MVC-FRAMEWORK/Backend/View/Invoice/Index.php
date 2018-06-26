<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="?Controller=Invoice">Đơn hàng</a>
	</li>
	<li class="breadcrumb-item active">Tất cả đơn hàng</li>
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
							<th>Mã đơn hàng</th>
							<th>Khách hàng</th>
							<th>Thành tiền</th>
							<th>Ghi chú</th>
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
						foreach ($this->model as $invoice_) 
						{
							$i++;
							echo '<script> var id' . $i . ' = "' . $invoice_->Invoice_Id . '";</script>';
							echo "<tr>
							<td>$i</td>
							<td>$invoice_->Invoice_Id</td>
							<td>$invoice_->Customer_Id</td>
							<td>$invoice_->Customer_Id</td>
							<td><div class='description-show'>$invoice_->Note</div></td>
							<td>$invoice_->create_time</td>
							<td>
							<a href='?Controller=Invoice&Action=InvoiceDetail&Id=$invoice_->Invoice_Id' class='btn btn-info'>Chi tiết</a>
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

