  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="?Controller=Login" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter Username.." name="Admin_User_Name">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password.." name="Admin_Password">
          </div>
          <div class="form-group" id="incorrect" style="display: none;">
            <div class="form-check">
              <label class="form-check-label"><font color="red" style="text-align: center;">The Username or Password is incorrect!</font></label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="Remember_password" value="1"> Remember Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="?Controller=Login&Action=Register">Register an Account</a>
          <a class="d-block small" href="?Controller=Login&Action=Forgotpassword">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <?php 
  switch ($this->status) 
  {
      case 'loginFalse':
          echo '<script> document.onload(alert("Tên người dùng hoặc mật khẩu không đúng. Vui lòng nhập lại!"));</script>';
          break;
  }
  if (isset($_GET["status"])) 
  {
      if ($_GET["status"] === 'Register completed') 
      {
         echo '<script> document.onload(alert("Đăng kí thành công. Vui lòng đăng nhập!"));</script>';
      }
  }

   ?>