<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="?Controller=Invoice">Đơn hàng</a>
    </li>
    <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
</ol>
<!-- Breadcrumbs-->
<div class="container">
    <div class="tab-content">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">THÔNG TIN KHÁCH HÀNG</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Tên:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[1][0]->Customer_Name; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Số điện thoại:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[1][0]->Customer_Phone; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Email:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[1][0]->Customer_Mail; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Địa chỉ:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[1][0]->Customer_Address; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Ngày tạo:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[1][0]->create_time; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                    </div>
                    <div class="card-footer text-right">
                        <?php echo date('D, d-m-Y'); ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-custom" id="customer_detail">
                    <div class="card-header">
                        THÔNG TIN ĐƠN HÀNG
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Mã đơn hàng:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[0][0]->Invoice_Id; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Ghi chú:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[0][0]->Note; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                        <div class="form-group row">
                            <div class="col-xl-4">
                                <label class="form-text">Ngày tạo:</label>
                            </div>
                            <div class="col-xl-8">
                                <p class="form-text">
                                    <?php echo $this->model[0][0]->create_time; ?>
                                </p>
                            </div>
                        </div>
                        <!-- /form-group -->
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
                <br>
                <div class="card card-custom">
                    <div class="card-header">THÔNG TIN GIỎ HÀNG</div>
                    <div class="card-body">
                        <?php $total = 0; ?>
                        <?php foreach ($this->model[2] as $item): ?>
                        <?php 
				$product = new Product(); 

				$result = $product->getDataById($item->Product_Id); 
				$total += $result[0]->Product_Cost * $item->Quantity;	
			?>
                        <div class="row">
                            <div class="col-xl-8">
                                <?php echo $item->Quantity; ?>x
                                <?php echo $result[0]->Product_Name; ?>
                            </div>
                            <div class="col-xl-1">=</div>
                            <div class="col-xl-3 text-right">
                                <?php echo Lecop::formatMoney($result[0]->Product_Cost); ?>₫
                            </div>
                        </div>
                        <hr>
                        <?php endforeach ?>
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
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>