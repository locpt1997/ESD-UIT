 <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="?Controller=Login&Action=Register" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Name:</label>
                <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter name" name="Admin_Name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Phone:</label>
                <input class="form-control" id="exampleInputLastName" type="number" aria-describedby="nameHelp" placeholder="Enter phone" name="Admin_Phone">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12" id="Email_verify1">
                <label for="exampleInputEmail1">Email address: </label>
                <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" name="Admin_Mail">
              </div>
              <div class="" id="Email_verify2">
                <label></label>
                <font id="existUser" color="red"> *Người dùng đã tồn tại!</font></div>
            </div> 
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password:</label>
                <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" name="Admin_Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password:</label>
                <input class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password" name="confirm_admin_password">
              </div>
            </div>
          </div>
           <div class="form-group" id="incorrect" style="display: none;">
            <div class="form-check">
              <label class="form-check-label"><font color="red" style="text-align: center;">The Confirm Password is incorrect!</font></label>
            </div>
          </div>
          <div class="form-group" id="exist" style="display: none;">
            <div class="form-check">
              <label class="form-check-label"><font color="red" style="text-align: center;">Email already exist! Please login!</font></label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="?Controller=Login">Login Page</a>
          <a class="d-block small" href="?Controller=Login&Action=Forgotpassword">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <?php 
  switch ($this->status) {
    case 'false':
      echo '<script> document.getElementById("incorrect").setAttribute("style","display:block");</script>';
      break;
    case 'exist':
      echo '<script> document.getElementById("exist").setAttribute("style","display:block");</script>';
      break;
    case 'emtyMail':
      echo '<script> document.onload(alert("Vui lòng nhập Email!"));</script>';
      break;
    case 'emtyPassword':
      echo '<script> document.onload(alert("Vui lòng nhập Password!"));</script>';
      break;
    case 'existUser':
      echo '<script> document.getElementById("existUser").setAttribute("style","display:block");
                    document.getElementById("Email_verify1").className = "col-md-6";
                    document.getElementById("Email_verify2").className = "col-md-6";</script>';
      break;
  }
  ?>
  <script type="text/javascript"> </script>