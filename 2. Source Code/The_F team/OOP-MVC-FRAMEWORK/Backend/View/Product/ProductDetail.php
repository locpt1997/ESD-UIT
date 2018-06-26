<?php include_once 'Libs/LeCop.Class.php' ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="?Controller=Product">Sản phẩm</a>
	</li>
	<li class="breadcrumb-item active">Chi tiết sản phẩm</li>
</ol>
<!-- Breadcrumbs-->

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-8 tab-content">
			<form action="?Controller=Product&Action=ProductDetail&Id=<?php echo $this->model[0]->Product_Id;  ?>" method="POST" enctype="multipart/form-data" autocomplete="" id="Form-Product">
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Mã sản phẩm:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><input class="form-control" type="text" name="Product_Id" placeholder="SKU..." autofocus id="Product_Id" onblur="validateProductId(this.value)" onfocus="hideWarningProductId()" value="<?php echo $this->model[0]->Product_Id; ?>"></div>
					<div class="col-xl-3 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Id" color="red" size="2.5">*Không được để trống!</font></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Tên sản phẩm:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><input class="form-control" type="text" name="Product_Name" placeholder="Tên sản phẩm..." id="Product_Name" onblur="validateProductName(this.value)" onfocus="hideWarningProductName()" value="<?php echo $this->model[0]->Product_Name; ?>"></div>
					<div class="col-xl-3 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Name" color="red" size="2.5">*Không được để trống!</font></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Giá:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><input class="form-control" type="number" min="0" step="500" name="Product_Cost" placeholder="Giá..." id="Product_Cost" onblur="validateProductCost(this.value)" onfocus="hideWarningProductCost()" value="<?php echo $this->model[0]->Product_Cost; ?>"></div>
					<div class="col-xl-3 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Cost" color="red" size="2.5">*Không được để trống!</font></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Số lượng:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><input class="form-control" type="number" min="0" step="1" name="Product_Instock" placeholder="Số lượng..." id="Product_Instock" onblur="validateProductInstock(this.value)" onfocus="hideWarningProductInstock()" value="<?php echo trim($this->model[0]->Product_Instock,' ');?>"></div>
					<div class="col-xl-3 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Instock" color="red" size="2.5">*Không được để trống!</font></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Mô tả:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><textarea class="form-control" type="text" name="Product_Description" placeholder="Mô tả..." id="Product_Description" onblur="validateProductDescription(this.value)" onfocus="hideWarningProductDescription()"><?php echo $this->model[0]->Product_Description; ?></textarea></div>
					<div class="col-xl-3 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Description" color="red" size="2.5">*Không được để trống!</font></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label for="link">Hình ảnh:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><div class="image-input">
						<input type="file" multiple class="" id="link" name="product_image_link[]" laceholder='Choose a file...'>

						<div class="image-show" id="show-image">
							<div class="image-input-context">  
								<b id="image-input-context">Drag and drop file here!</b>                        
							</div>
						</div>
					</div></div>
					<div class="col-xl-3 col-lg-4 col-md-2"></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Modify Time:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><div><?php echo $this->model[0]->update_time; ?></div></div>
					<div class="col-xl-3 col-lg-4 col-md-2"></div>
				</div>
				<!-- / form-group row -->
				<div class="form-group row">
					<div class="col-xl-3 col-lg-2 col-md-2"><label>Create Time:</label></div>
					<div class="col-xl-6 col-lg-6 col-md-8"><div><?php echo $this->model[0]->create_time; ?></div></div>
					<div class="col-xl-3 col-lg-4 col-md-2"></div>
				</div>
				<!-- / form-group row -->
				
			</form>
			<!-- / Form -->
		</div>
		<div class="col-xl-3 tab-content mid-space">
			<div id="Show-image-detail">
				<?php 
				$i = 0;
				foreach ($this->model[1] as $product) {
					$i++;
					echo '<script>
					var id1="' . $product->Product_Id . '";
					var link' . $i . '="' . $product->product_image_link . '";
					</script>';
					echo '<div class="div-thumb">
					<img class="thumb-image-detail" src="'.$product->product_image_link.'" alt="" title="' . $product->Product_Id . '">
					<div class="close btn-thumb-image-detail" title="Xóa" onclick="deleteImage(id1,link'.$i.')">&times;</div>
					</div>';
				}
				?>

			</div>
			<!-- / End show images -->
		</div>
	</div>
</div>
<br>

<div class="form-group row">
	<div class="col-xl-2 col-lg-2 col-md-2"></div>
	<div class="col-xl-10 col-lg-10 col-md-10"><div class="btn btn-primary btn-custom" id="Submit" onclick="submitForm()">Lưu</div></div>
</div>
<!-- / form-group row -->



<!-- / container-fluid -->

<!-- Customer js -->
<script src="Asset/js/handleFileSelect.js"></script>
<script src="Asset/js/resizeTextArea.js"></script>
<script src="Asset/Admin-bootstrap-v1/vendor/jquery/jquery.min.js"></script>
<?php 
if ($this->status === "updateComplete") 
{
	echo ' <script> $(document).ready(function(){alert("Update thành công!");});</script>';
}
?>
