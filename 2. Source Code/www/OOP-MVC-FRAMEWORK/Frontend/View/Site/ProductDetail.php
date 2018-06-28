<?php include_once "Libs/Lecop.Class.php"; ?>
<script src="Asset/js/custom.js"></script>
<script type="text/javascript"> var Id = '<?php echo $_GET['Id']; ?>';</script>
<!-- Portfolio Item Heading -->

  <ol class="breadcrumb custom-breadcrumb">
  <li class="breadcrumb-item">
    <a href=".">Sản phẩm </a>
  </li>
  <li class="breadcrumb-item active"> <?php echo $this->model[0]->Product_Name; ?></li>
</ol>


<!-- Portfolio Item Row -->
<div class="tab-content">
  <div class="row">

  <div class="col-md-5">
    <img class="img-thumbnail img-detail" src="<?php echo $this->model[1][0]->product_image_link?>" alt="">
  </div>
  <div class="col-md-5">
    <h2 class="my-3"><?php echo $this->model[0]->Product_Name; ?></h2>
    <hr>
    <h2><font size="5">Giá:</font> <font color="#e10c00"><?php echo Lecop::formatMoney($this->model[0]->Product_Cost); ?>₫</font></h2>

    <h2><font size="5">Còn:   </font> <font size="6"><i id="instock"><?php echo $this->model[0]->Product_Instock; ?></i></font><font size="5"> sản phẩm</font></h2>

      <form class="form-inline" action="?Action=Checkout" method="POST" id="mua_ngay">
        <label><h2><font size="5">Số lượng: </font></h2> </label>
        <div class="btn btn-custom quantity-add" onclick="minusquantity()"><strong>-</strong></div>
        <input type="number" min="1" step="1" name="quantity" value="1" class="quantity" id="quantity" onchange="validateQuantity()">
        <div class="btn btn-custom quantity-add" onclick="addquantity()"><strong>+</strong></div>
        <input type="hidden" name="Product_Id" value="<?php echo $this->model[0]->Product_Id;?>">
        <input type="hidden" name="Product_Name" value="<?php echo $this->model[0]->Product_Name;?>">
        <input type="hidden" name="Product_Cost" value="<?php echo $this->model[0]->Product_Cost;?>">
      </form>
      <!-- /form -->
      <br>
    <div class="btn btn-primary btn-custom-ograne" onclick="muangay()">MUA NGAY</div>
    <div class="btn btn-primary btn-custom-great" onclick="addtocart(Id)">THÊM VÀO GIỎ HÀNG</div>
    <br>
    <br>
    <h3 class="my-3">CAM KẾT CỦA CHÚNG TÔI:</h3>
    <ul style="list-style-type: none;">
      <li><font color="#089C6D"><i class="fa fa-check"></i></font> BẢO ĐẢM HÀNG CHẤT LƯỢNG CHÍNH HÃNG 100%</li>
      <li><font color="089C6D"><i class="fa fa-check"></i></font> DATE MỚI NHẤT</li>
      <li><font color="089C6D"><i class="fa fa-check"></i></font> GIAO HÀNG NHANH NHẤT</li>
      <li><font color="089C6D"><i class="fa fa-check"></i></font> PHỤC VỤ ĐẾN KHI KHÁCH HÀNG HÀI LÒNG</li>    
      <li><font color="089C6D"><i class="fa fa-check"></i></font> 30 NGÀY BAO NGÀY ĐỔI TRẢ, HOÀN TIỀN 100% NẾU KHÔNG ĐÚNG CHẤT LƯỢNG.</li>
    </ul>
    <div class="col-md-2"></div>

  </div>
</div>
<!-- /.row -->
</div>
<!-- /.tab-content  -->
<div class="tab-content">
  <div class="card card-outline-secondary my-4 ">
    <div class="card-header">
      <h4>Mô tả chi tiết:</h4>
    </div>
    <div class="card-body">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
      <small class="text-muted">Posted by Anonymous on 3/1/17</small>
      <hr>
      <a href="#" class="btn btn-success">Leave a Review</a>
    </div>
  </div>
  <!-- /.card -->
</div>

<!-- Related Projects Row -->
<div class="tab-content">
 <h3 class="my-4">Sản phẩm liên quan:</h3>

 <div class="row">

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
      <img class="img-fluid" src="#" alt="">
    </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
      <img class="img-fluid" src="#" alt="">
    </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
      <img class="img-fluid" src="#" alt="">
    </a>
  </div>

  <div class="col-md-3 col-sm-6 mb-4">
    <a href="#">
      <img class="img-fluid" src="#" alt="">
    </a>
  </div>
</div>  
<!-- /.row -->
</div>

</div>
<!-- /.row -->
<script type="text/javascript">
    function addtocart(str)
{
    alert(str);
}
</script>