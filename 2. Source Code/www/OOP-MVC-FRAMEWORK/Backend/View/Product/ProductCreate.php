<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="?Controller=Product">Sản phẩm</a>
	</li>
	<li class="breadcrumb-item active">Tạo sản phẩm</li>
</ol>
 <!-- Breadcrumbs-->

 <div class="container-fluid">
 	<form action="?Controller=Product&Action=ProductCreate" method="POST" enctype="multipart/form-data" autocomplete="" id="Form-Product" class="tab-content">
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label>Mã sản phẩm:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><input class="form-control" type="text" name="Product_Id" placeholder="SKU..." autofocus id="Product_Id" onblur="validateProductId(this.value)" onfocus="hideWarningProductId()"></div>
 			<div class="col-xl-6 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Id" color="red" size="2.5">*Không được để trống!</font></div>
 		</div>
 		<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label>Tên sản phẩm:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><input class="form-control" type="text" name="Product_Name" placeholder="Tên sản phẩm..." id="Product_Name" onblur="validateProductName(this.value)" onfocus="hideWarningProductName()"></div>
 			<div class="col-xl-6 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Name" color="red" size="2.5">*Không được để trống!</font></div>
 		</div>
 		<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label>Giá:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><input class="form-control" type="number" min="0" step="500" name="Product_Cost" placeholder="Giá..." id="Product_Cost" onblur="validateProductCost(this.value)" onfocus="hideWarningProductCost()"></div>
 			<div class="col-xl-6 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Cost" color="red" size="2.5">*Không được để trống!</font></div>
 		</div>
 		<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label>Số lượng:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><input class="form-control" type="number" min="0" step="1" name="Product_Instock" placeholder="Số lượng..." id="Product_Instock" onblur="validateProductInstock(this.value)" onfocus="hideWarningProductInstock()"></div>
 			<div class="col-lg-6 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Instock" color="red" size="2.5">*Không được để trống!</font></div>
 		</div>
 		<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label>Mô tả:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><textarea class="form-control" type="text" name="Product_Description" placeholder="Mô tả..." id="Product_Description" onblur="validateProductDescription(this.value)" onfocus="hideWarningProductDescription()"></textarea></div>
 			<div class="col-xl-6 col-lg-4 col-md-2"><font style="display: none;" id="Validate_Product_Description" color="red" size="2.5">*Không được để trống!</font></div>
 		</div>
 		<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"><label for="link">Hình ảnh:</label></div>
 			<div class="col-xl-4 col-lg-6 col-md-8"><div class="image-input">
					<input type="file" multiple class="" id="link" name="product_image_link[]" laceholder='Choose a file...'>

					<div class="image-show" id="show-image">
						<div class="image-input-context">  
							<b id="image-input-context">Drag and drop file here!</b>                        
						</div>
					</div>
				</div></div>
 			<div class="col-xl-6 col-lg-4 col-md-2"></div>
 		</div>		
 	</form>
 	<!-- / Form -->
 	<br>
 	<!-- / form-group row -->
 		<div class="form-group row">
 			<div class="col-xl-2 col-lg-2 col-md-2"></div>
 			<div class="col-xl-4 col-lg-6 col-md-8">
 				<div class="btn btn-primary btn-custom" id="Submit" onclick="submitForm()">Submit</div>
 			</div>
 			<div class="col-xl-6 col-lg-4 col-md-2"></div>
 		</div>
 		<!-- / form-group row -->
 </div>
<!-- / container-fluid -->

<!-- Customer js -->
<script src="Asset/js/handleFileSelect.js"></script>
<script src="Asset/js/resizeTextArea.js"></script>
<script> 

</script>
<?php 
if ($this->status === "existProduct") 
{
	echo "<script>alert('Sản phẩm đã tồn tại!')</script>";
}
?>
