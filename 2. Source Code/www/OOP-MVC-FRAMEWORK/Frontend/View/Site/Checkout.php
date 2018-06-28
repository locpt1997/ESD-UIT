<?php include_once "Libs/Lecop.Class.php"; ?>
<!-- Portfolio Item Heading -->
<ol class="breadcrumb custom-breadcrumb">
    <li class="breadcrumb-item">
        <a href=".">Sản phẩm </a>
    </li>
    <li class="breadcrumb-item active"> Thanh toán</li>
</ol>
<div class="tab-content">
    <div class="row">
        <div class="col-xl-6">
            <form method="POST" action="?Action=VerifyInvoice" id="bill_detail">
                <h4 class="text-center">THÔNG TIN THANH TOÁN</h4>
                <div class="form-group row">
                    <div class="col-xl-3">
                        <label class="form-text">Tên:</label>
                    </div>
                    <div class="col-xl-8">
                        <input class="form-control" type="text" name="Customer_Name" placeholder="Tên..." required="required">
                    </div>
                    <div class="col-xl-1"></div>
                </div>
                <!-- /form-group -->
                <div class="form-group row">
                    <div class="col-xl-3">
                        <label class="form-text">Số điện thoại:</label>
                    </div>
                    <div class="col-xl-8">
                        <input class="form-control" type="text" name="Customer_Phone" placeholder="Số điện thoại..." required="required">
                    </div>
                    <div class="col-xl-1"></div>
                </div>
                <!-- /form-group -->
                <div class="form-group row">
                    <div class="col-xl-3">
                        <label class="form-text">Email:</label>
                    </div>
                    <div class="col-xl-8">
                        <input class="form-control" type="" name="Customer_Mail" placeholder="Email..." required="required">
                    </div>
                    <div class="col-xl-1"></div>
                </div>
                <!-- /form-group -->
                <div class="form-group row">
                    <div class="col-xl-3">
                        <label class="form-text">Địa chỉ:</label>
                    </div>
                    <div class="col-xl-8">
                        <input class="form-control" type="text" name="Customer_Address" placeholder="Địa chỉ..." required="required">
                    </div>
                    <div class="col-xl-1"></div>
                </div>
                <!-- /form-group -->
                <div class="form-group row">
                    <div class="col-xl-3">
                        <label class="form-text">Ghi chú:</label>
                    </div>
                    <div class="col-xl-8">
                        <textarea class="form-control checkout-note" type="text" name="Bill_Note" placeholder="Ghi chú..."></textarea>
                    </div>
                    <div class="col-xl-1"></div>
                </div>
                <!-- /form-group -->
            </form>
        </div>
        <div class="col-xl-6">
            <h4 class="text-center">ĐƠN HÀNG</h4>
            <div class="card card-custom">
                <div class="card-header">THÔNG TIN ĐƠN HÀNG</div>
                <div class="card-body">
                    <?php 
						$total = 0;
						foreach ($_COOKIE['cart'] as $key ) 
						{
							$result = json_decode($key);
							echo '<div class="row">';
							echo '<div class="col-xl-8">';
							echo $result->quantity;
							echo " x ";
							echo $result->Product_Name;
							echo "</div>";
							echo '<div class="col-xl-1">=</div>';
							echo '<div class="col-xl-3 text-right">';
							echo Lecop::formatMoney($result->Product_Cost);
							echo "₫";
							echo "</div>";
							echo "</div>";
							echo "<hr>";
							$total +=  $result->quantity*$result->Product_Cost;
						}
						?>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-xl-8">
                            TỔNG CỘNG:
                        </div>
                        <div class="col-xl-4 text-right">
                            <?php 
							echo Lecop::formatMoney($total); 
							?>₫
                        </div>
                    </div>
                    <!-- /.form-group row -->
                </div>
            </div>
            <br>
            <div class="text-center">
            	<button class="btn btn-primary btn-custom-ograne" form="bill_detail">ĐẶT HÀNG</button>
                <a href="." class="btn btn-primary btn-custom-great">MUA TIẾP</a>
                
            </div>
            <!-- text-center -->
        </div>
        <!-- .col-xl-6 -->
    </div>
    <!-- .row -->
</div>
<!-- .tab-content -->
<div class="tab-content">
</div>