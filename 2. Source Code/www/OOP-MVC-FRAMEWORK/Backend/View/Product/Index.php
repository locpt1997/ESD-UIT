<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="?Controller=Product">Sản phẩm</a>
	</li>
	<li class="breadcrumb-item active">Tất cả sản phẩm</li>
</ol>
<!-- Breadcrumbs-->
<!-- Example DataTables Card-->
<div class="card mb-3">
	<div class="card-header">
		<i class="fa fa-table"></i> Danh sách sản phẩm</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Mã sản phẩm</th>
							<th>Sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Mô tả</th>
							<th>Thời gian nhâp</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Mã sản phẩm</th>
							<th>Sản phẩm</th>
							<th>Giá</th>
							<th>Số lượng</th>
							<th>Mô tả</th>
							<th>Thời gian nhâp</th>
							<th>Action</th>
						</tr>
					</tfoot>

					<tbody>
						<?php 
						$i = 0;
						foreach ($this->model as $product_) {
							$i++;
							echo '<script> var id' . $i . ' = "' . $product_->Product_Id . '";</script>';
							echo "<tr>
							<td>$i</td>
							<td>$product_->Product_Id</td>
							<td>$product_->Product_Name</td>
							<td>$product_->Product_Cost</td>
							<td>$product_->Product_Instock</td>
							<td><div class='description-show'>$product_->Product_Description</div></td>
							<td>$product_->create_time</td>
							<td>
							<a href='?Controller=Product&Action=ProductDetail&Id=$product_->Product_Id' class='btn btn-info'>Chi tiết</a>
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
