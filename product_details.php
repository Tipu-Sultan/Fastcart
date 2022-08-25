<?php include 'nav.php';

 ?>
<?php include 'add_in_cart.php'; ?>
<br>
<br>
<?php
if (isset($_SESSION['user_id'])) {
include 'themancode.php'; 
if (isset($_GET['pid'])) {
$user_id=$_SESSION['user_id'];
$pit = $_GET['pid'];
$slug_items = mysqli_query($con,"select * from items where id=$pit ");
$pid = mysqli_fetch_assoc($slug_items);
$slug_id = $pid['id'];

$gallery = mysqli_query($con,"select * from product_gallery where pid=$slug_id ");
$sizes = mysqli_query($con,"select * from sizes");
$color = mysqli_query($con,"select * from sizes");

$wishlist =mysqli_num_rows(mysqli_query($con,"select * from order_items where status='wishlist' and item_id={$slug_id} and user_id='$user_id' "));


}
}
 ?>
 <?php 
 if (isset($_SESSION['user_id'])) {
 ?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"><a href="product/<?php echo $pid['image'] ?>"> <img id="main-image" src="product/<?php echo $pid['image'] ?>" width="250" /></a> </div>
                            <div class="thumbnail text-center"> 
                                <?php 
                            while($gid = mysqli_fetch_array($gallery)){
                                ?>
                                <img onclick="change_image(this)" src="product/<?php echo $gid['p_image'] ?>" width="70">
                                <?php
                            }

                             ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Info</span> </div> <a class="text-reset me-3" href="cart.php?cid=<?php echo $_SESSION['token'] ?>">
        <i class="fas fa-shopping-cart"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php echo $total_cart ?></span>
        </a>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Type : <?php echo $pid['type'] ?></span>
                                <h5 class="text-uppercase"><?php echo $pid['name'] ?></h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price"><?php echo $pid['price']." ₹" ?></span>
                                    <!-- <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div> -->
                                </div>
                            </div>
                            <p class="about"><?php echo $pid['brief_info'] ?></p>
                            <div class="sizes mt-3">
                                <h6 class="text-uppercase">Color</h6>
                                <?php 
                                while($cid = mysqli_fetch_array($color)){
                                 ?> 
                                <label class="radio">
                                <input onclick="color('<?php echo $cid['colors'] ?>')" type="radio" name="color" value="<?php echo $cid['colors'] ?>" >
                                <input type="text" name="sid" id="id" value="<?php echo $slug_id ?>" hidden>
                                <span><?php echo $cid['colors'] ?></span>
                                </label>
                                <?php
                            }
                                ?>
                            </div>

                            <div class="sizes mt-1">
                                <h6 class="text-uppercase">Size</h6>
                                <?php 
                                while($sid = mysqli_fetch_array($sizes)){
                                 ?> 
                                <label class="radio">
                                <input onclick="sizes('<?php echo $sid['sizes'] ?>')" type="radio" name="sizes" value="<?php echo $sid['sizes'] ?>" >
                                <input type="text" name="sid" id="id" value="<?php echo $slug_id ?>" hidden>
                                <span><?php echo $sid['sizes'] ?></span>
                                </label>
                                <?php
                            }
                                ?>
                            </div>
                            <div class="cart mt-4 align-items-center">
                            <?php
              if(add_in_cart($slug_id)){
              echo '<p><a type="button" class="btn btn-outline-secondary" disabled>Added</a></p>';
              }else{
              ?>
              <a href="cart_add.php?item_id=<?php echo $slug_id ?>"><button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button></a>
              <?php 
              if ($wishlist>0) {
                  ?>
                  <button  class="btn btn-outline-dark" title="Already wishlist"><i class="fa fa-heart  pl-4 mx-2 text-danger" ></i></button>
                  <?php
              }else
              {
                ?>
                  
                  <button  class="btn btn-outline-dark" onclick="wishlist('<?php echo $pit ?>')" id="wishlist" title="Add to wishlist"><i class="fa fa-heart  pl-4 mx-2 " ></i></button>
                  <?php
              }
               ?> 
              <?php
              }
              ?> 
                    <br>
                    <br>
                     <label>Enter Delivery Pin</label>
                       <div class="d-flex flex-row align-items-center mt-2">
                          <i class="fa fa-map-marker fa-lg me-3 fa-fw" aria-hidden="true"></i>
                          <div class="form-group w-25">
                            <input type="text" class="form-control" id="pin" placeholder="Enter pin code" required="">
                          </div>
                          <button  class="btn btn-outline-dark mx-2" onclick="pin()" id="pin_btn" title="search"> <i class="fa fa-search  pl-4 mx-2 " ></i></button>
                        </div>
                        <p id="pinMsg"></p>

                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h5 class="text-center">Suggested products</h5>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <?php 
                    $type = $_GET['type'];
                    $topitem = mysqli_query($con,"SELECT * FROM items where type='$type' order by name asc");
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
                  <p class="text-center "><?php echo $top['price'] ." ₹"?></p>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}else{
    echo "<h2 style='text-align: center;margin-top: 100px;'>Please login <a href='#' data-mdb-toggle='modal' data-mdb-target='#login'>click here</a></h2>";
}
?>
<?php include 'footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    function pin(){
        $("#pin_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>pining...</span>");
    jQuery('#pin_btn').attr('disabled',true);
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'pin',
        zip: $("#pin").val(),
        },
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.error=="no")
        {
            jQuery('#pinMsg').html(obj.msg);
            jQuery('#pin_btn').html('<i class="fa fa-search  pl-4 mx-2 " ></i>');
            jQuery('#pin_btn').attr('disabled',false);
        }
      }
    });
  }
  function sizes(size){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'sizes',
        sid:size,
        pid: $("#id").val(),
        },
      success:function(result){
        

      }
    });
  }

  function color(color){
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data :{
        type:'color',
        cid:color,
        pid: $("#id").val(),
        },
      success:function(result){
        

      }
    });
  }
</script>
<script type="text/javascript">
    function wishlist(id){
        $("#wishlist").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>wishting...</span>");
    jQuery('#wishlist').attr('disabled',true);
        jQuery.ajax({
      url:'tools.php',
      type:'post',
      data:'type=wishlist&pid='+id,
      success:function(result){
        var obj = jQuery.parseJSON(result);
              if(obj.error=='no'){
            jQuery('#wishlist').html('<i class="fa fa-heart pl-4 mx-2 text-danger"></i>');
            jQuery('#wishlist').attr('disabled',true);
            
        }else if(obj.error=='yes'){
            jQuery('#wishlist').html(obj.msg);
            
        }
      }
    });
  }
</script>