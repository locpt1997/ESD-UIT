     <!-- Jumbotron Header -->
      <div class="tab-content">
         <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
        </header>
      </div>
      <!-- / Jumbotron Header -->

      <div class="tab-content">
        <div class="row text-center">

          <?php 
          foreach ($this->model as $product) 
          {
            $image = $this->data->getDataByProductImagesId($product->Product_Id);
            echo ' <div class="col-lg-3 col-md-6 mb-4">
            <a href="?Action=ProductDetail&Id='.$product->Product_Id.'">
            <div class="card">
            <img class="card-img-top image-show" src="'.$image[0]->product_image_link.'" alt="">
            <div class="card-body">
            <h4 class="card-title">'.$product->Product_Name.'</h4>
            <p class="card-text">'.$product->Product_Cost.'</p>
            </div>
            <div class="card-footer">
            <a href="#" class="btn btn-primary">Find Out More!</a>
            </div>
            </div>
            </a>
            </div>';
          }
          ?>
        </div>
      </div> 
      <!-- /.row -->