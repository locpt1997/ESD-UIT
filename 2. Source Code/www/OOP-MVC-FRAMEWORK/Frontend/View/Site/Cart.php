<?php include_once "Libs/Lecop.Class.php"; ?>
<!-- Portfolio Item Heading -->
<ol class="breadcrumb custom-breadcrumb">
    <li class="breadcrumb-item">
        <a href=".">Sản phẩm </a>
    </li>
    <li class="breadcrumb-item active">Giỏ hàng</li>
</ol>
<div class="tab-content">
    <div class="card">
        <div class="card-header">
            <h4>Chi tiết giỏ hàng</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$total = 0;
                    if (isset($_COOKIE['cart'])) 
                    {
                        foreach ($_COOKIE['cart'] as $key ) 
                        {
                            $result = json_decode($key);
                            echo '<tr>';
                            echo "<td>$result->Product_Name</td>";
                            echo '<td><div class="btn btn-custom quantity-add" onclick="minusquantity()"><strong>-</strong></div><input class="quantity btn btn-custom quantity-add" type="number" name="quantity" value="'.$result->quantity.'"><div class="btn btn-custom quantity-add" onclick="addquantity()"><strong>+</strong></div></td>';
                            echo "<td>".Lecop::formatMoney($result->Product_Cost)." ₫</td>";
                            $total +=  $result->quantity*$result->Product_Cost;
                            echo "<td><div class='close' style='float:none; color:red;'><i class='fa fa-remove'></i><div></td>";
                            echo "</tr>";
                        };   
                    }
					?>
                </tbody>
            </table>
            <div class="text-center">
                <div class="btn btn-primary btn-custom-great"  onclick="updateCart()">CẬP NHẬP GIỎ HÀNG</div>
                <a class="btn btn-primary btn-custom-ograne" href="?Action=Checkout">ĐẶT HÀNG</a>
            </div>
        </div>
    </div>
</div>