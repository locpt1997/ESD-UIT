<?php include_once "Libs/Lecop.Class.php"; ?>
<!-- Portfolio Item Heading -->
<ol class="breadcrumb custom-breadcrumb">
    <li class="breadcrumb-item">
        <a href=".">Sản phẩm </a>
    </li>
    <li class="breadcrumb-item active"> Verify</li>
</ol>
<div class="tab-content text-center">
    <div class="card card-verify card-custom mx-auto">
        <div class="card-body">
            <form action="?Action=VerifyInvoice" method="POST">
                <div class="form-group">
                    <label>
                        <h4>Để xác nhận đơn hàng, vui lòng nhập mã xác nhận:</h4></label>
                    <input type="text" name="Verify_code" class="form-control" placeholder="Enter code here...">
                </div>
                <div class="form-group">
                    <button class="btn btn-success form-control">Xác nhận</button>
                </div>
                <p><i>Kiểm tra điện thoại của bạn, và nhập code, mã code sẽ bị hủy sau 30s. </i></p>
                <p class="notification-validate-code">Nếu không nhận được mã click gửi lại:</p>
                <div class="text-center "><a href="?Action=VerifyInvoice&status=resentCode" class="btn btn-link text-center btn-notification-validate-code">Gửi lại mã.</a></div>
            </form>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php 

switch ($this->status) 
{
	case 'invalid_code':
	echo " <script>
	alert('Invalid Verify Code! Plz insert again');
	</script>";
	break;
	case 'time_out':
	echo " <script>
	alert('Verify Code had been reset, Plz click resend code');
	</script>";
	break;
    case 'reset_fail':
    echo " <script>
    alert('System error, plz return after 30min!');
    </script>";
    break;

	default:
		# code...
		break;
}

 ?>