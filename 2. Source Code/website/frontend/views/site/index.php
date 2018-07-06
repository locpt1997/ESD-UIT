<?php

/* @var $this yii\web\View */

$this->title = $_SERVER['PHP_SELF'];
?>
    <div class="container" style="background: white; margin-top: 20px;">
        <div class="row">
            <div class="col-lg-3">
                <h1 class="my-4 text-center">Category</h1>
                <div class="list-group">
                    <a href="#1" class="list-group-item category-list text-center dropdown">
                        <b>Chó</b>
                        <div class="dropdown-content">
                            <div class="list-group">
                              <?php foreach ($category_dog as $item): ?>
                                
                              
                              <div class="list-group-item category-list none-border"><?php echo $item->name; ?></div>

                              <?php endforeach ?>
                            </div>
                        </div>
                    </a>
                    <a href="#2" class="list-group-item category-list text-center dropdown">
                        <b>Mèo</b>
                        <div class="dropdown-content">
                            <div class="list-group">
                              <?php foreach ($category_cat as $item): ?>
                                
                              <div class="list-group-item category-list none-border"><?php echo $item->name; ?></div>

                              <?php endforeach ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.col-lg-3 -->
            <?php 
    
     // echo "<pre>",print_r($data),"</pre>"; 
     // foreach ($data as $item) {
     // echo "<pre>",print_r($item),"</pre>"; 
     //   echo $item->id;
     //   echo "<br>";
     // }
    ?>
            <div class="col-lg-9">
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="http://wagstowhiskersmaryland.com/wp-content/uploads/2018/02/bigstock-152143985-900x350.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="https://www.reddogbetty.com/wp-content/uploads/2018/05/Featured-Image-Article-5-900x350.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="http://gigigriffis.com/wp-content/uploads/2012/03/9105414864_f3184eb61d_b-900x350.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
                </div>
                <div class="row">
                    <?php foreach ($data as $item): ?> 
                      <!--  -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href=<?php echo "site/product-detail?id=".$item->id; ?>>
                            <div class="card">
                                <img class="card-img-top image-show" src="<?php echo $item->image; ?>">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $item->name; ?></h4>
                                    <p class="card-text"><?php echo $item->basePrice; ?></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text">
                                    <?php echo $item->description; ?>
                                  </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php endforeach ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    </div>