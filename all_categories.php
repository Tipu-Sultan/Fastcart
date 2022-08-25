<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
</head>
<body>
<?php

 include 'nav.php';
if (!isset($_SESSION['username'])) {
      header('Location:index.php');
      die();
    }
 ?>

<!-- product section start -->
<?php require 'add_in_cart.php'; ?>
    <section style="background-color: #eee;">
        <div class="text-center container py-5">
          <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>
      
          <div class="row" id="limits">
            <div class="col-lg-2 ">
              <div class="processor p-2">
                <div class="heading d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase">Filter</h6>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="MEN" id="men" onclick="men()"><label class="form-check-label" for="flexCheckDefault">MEN</label> </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="WOMEN" id="women" onclick="women()"><label class="form-check-label" for="flexCheckDefault">WOMEN</label> </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div class="form-check"> <input class="form-check-input" type="checkbox" value="electronic" id="elctronics" onclick="electronics()" ><label class="form-check-label" for="flexCheckDefault">ELECTRONICS</label> </div>
                </div>
            </div>
            </div>
          <?php 
          include 'themancode.php';
          $topitem = mysqli_query($con,"SELECT * FROM items ");
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
                        <h5><span class="badge bg-primary ms-2">New</span></h5>
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

 <script type="text/javascript">
   function men(){
        jQuery.ajax({
      url:'categories.php',
      type:'post',
      data:'type=MEN',
      success:function(result){
        jQuery('#limits').html(result);
      }
    });
  }

  function women(){
        jQuery.ajax({
      url:'categories.php',
      type:'post',
      data:'type=WOMEN',
      success:function(result){
        jQuery('#limits').html(result);
      }
    });
  }

  function electronics(){
        jQuery.ajax({
      url:'categories.php',
      type:'post',
      data:'type=electronic',
      success:function(result){
        jQuery('#limits').html(result);
      }
    });
  }
 </script>   
<?php include 'footer.php';?>
</body>
</html>