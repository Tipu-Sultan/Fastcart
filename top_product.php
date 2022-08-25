<!-- owl product section start -->
<section style="background-color: #eee;">
<div class="owl-carousel owl-theme bg-grey">
  <?php 
  $carousel  = mysqli_query($con,"select * from  trending_item");
  while($top = mysqli_fetch_array($carousel)){
  ?>
    <div class="item mt-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
              <div class="card">
                <div
                  class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                  data-mdb-ripple-color="light"
                >
                  <img
                    src="product/<?php echo $top['image']?>"
                    class="w-100"
                    width="200"
                    height="200"
                  />
                  <a href="product_details.php?pid=<?php echo $top['id'] ?>&type=<?php echo $top['type'] ?>">
                    <div class="mask">
                      <div class="d-flex justify-content-start align-items-end h-100">
                        <h5><span class="badge bg-primary ms-2"><?php echo $top['type']?></span></h5>
                      </div>
                    </div>
                    <div class="hover-overlay">
                      <div
                        class="mask"
                        style="background-color: rgba(251, 251, 251, 0.15);"
                      ></div>
                    </div>
                  </a>
                </div>
                <div class="card-body">
                  <marquee behavior="alternate" scrollamount="3">  
                  <a href="" class="text-reset " style="max-width: 150px">
                    <h5 class="card-title mb-3"><?php echo $top['name']?></h5>
                  </a>
                  </marquee> 
                  <p class="text-center"><?php echo $top['price'] ." ₹"?></p>
                  <p>
                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="far fa-star fa-sm"></i></li>
      </ul>
                  </p>
              
                </div>
              </div>
            </div>
    </div>
    <?php
  }
  ?>
</div>
  <div>
    <center>
      <button  class='play btn btn-success btn-sm'><i class="fas fa-play"></i></button>
    <button  class='stop btn btn-danger btn-sm'><i class="fas fa-pause"></i></button>
    </center>
  </div>
 </section> 
<!-- owl product section end -->
<!-- product section start -->
<?php require 'add_in_cart.php'; ?>
    <section style="background-color: #eee;">
        <div class="text-center container py-5">
          <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>
      
          <div class="row">

          <?php 
          include 'themancode.php';
          $topitem = mysqli_query($con,"SELECT * FROM items order by name asc");
          while($top = mysqli_fetch_assoc($topitem)){
            ?>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6 mb-4">
              <div class="card">
                <div
                  class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                  data-mdb-ripple-color="light"
                >
                  <img
                    src="product/<?php echo $top['image']?>"
                    class="w-100"
                    width="200"
                    height="200"
                  />
                  <a href="product_details.php?pid=<?php echo $top['id'] ?>&type=<?php echo $top['type'] ?>">
                    <div class="mask">
                      <div class="d-flex justify-content-start align-items-end h-100">
                        <h5><span class="badge bg-primary ms-2"><?php echo $top['type']?></span></h5>
                      </div>
                    </div>
                    <div class="hover-overlay">
                      <div
                        class="mask"
                        style="background-color: rgba(251, 251, 251, 0.15);"
                      ></div>
                    </div>
                  </a>
                </div>
                <div class="card-body">
                  <marquee behavior="alternate" scrollamount="3">  
                  <a href="" class="text-reset " style="max-width: 150px">
                    <h5 class="card-title mb-3"><?php echo $top['name']?></h5>
                  </a>
                  </marquee> 
                  <p><?php echo $top['price'] ." ₹"?></p>
                  <p>
                    <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="fas fa-star fa-sm"></i></li>
        <li><i class="far fa-star fa-sm"></i></li>
      </ul>
                  </p>
              
                </div>
              </div>
            </div>
            <?php
          }
          ?>
            <!-- second row -->
          </div>
        </div>
      </section>

      <!-- product section end -->
