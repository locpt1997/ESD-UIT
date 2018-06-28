<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pipu Store</title>

    <!-- Bootstrap core CSS -->
    <link href="Asset/Startbootstrap-heroic/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="Asset/Startbootstrap-heroic/css/heroic-features.css" rel="stylesheet">
    <link href="Asset/css/custom.css" rel="stylesheet">
    <link href="../Backend/Asset/Admin-bootstrap-v1/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  </head>

  <body style="background: #f3f3f3;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-pipu fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">PIPU STORE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?Action=Cart"><i class="fa fa-shopping-cart"></i> Giỏ hàng <?php if (isset($_COOKIE['cart'])) 
              {
                echo '<span class="badge badge-warning">';
               echo count($_COOKIE['cart']);
               echo '</span>';
              } ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">    
      <!-- Page Features -->

    <?php include_once $this->content; ?>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-pipu">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Lê Cốp 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="Asset/Startbootstrap-heroic/vendor/jquery/jquery.min.js"></script>
    <script src="Asset/Startbootstrap-heroic/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
