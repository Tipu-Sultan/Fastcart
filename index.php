<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'link.php';?>
<?php include 'cart_cal.php';?>
<?php include 'modals.php';?>

    <title>Home</title>
</head>
<body >
<style type="text/css">
  .nav-item {
   color: #bd418c;
  float: left;
  position: relative;
}

.nav-item::after {
  background-color: #bd418c;
  content: "";
  width: 0;
  height: 3px;
  left: 0;
  bottom: 0;
  transition: width 0.35s ease 0s;
  position: absolute;
}

.nav-item:hover::after {
  width: 100%;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
</style>
<!-- Navbar -->
  <?php 
  if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
  
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img
            src="images/mancode.jpg"
            height="20"
            alt="Mancode Logo"
            loading="lazy"
            class="rounded"
          />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <b><a class="nav-link" href="index.php"><i class="fa fa-home"></i> HOME</a></b>
          </li>
          <li class="nav-item">
            <b><a class="nav-link" href="orders.php"><i class="fab fa-product-hunt"></i> ORDERS</a></b>
          </li>
          <li class="nav-item">
            <b><a class="nav-link" href="wishlist.php"><i class="fa fa-heart"></i> WISHLIST</a></b>
          </li>
          <li class="nav-item">
            <b><a class="nav-link" href="profile.php"><i class="fa fa-user"></i> PROFILE</a></b>
          </li>
          <li class="nav-item">
            <b><a class="nav-link" href="cart.php?cid=<?php echo $_SESSION['token'] ?>">CART
        <i class="fas fa-shopping-cart"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php echo $count_cart_items ?></span>
        </a></b>
          </li>

            <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle font-weight-bold"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          Category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="all_categories.php"><i class="fab fa-product-hunt"></i> ALL CATEGORY</a>
          </li>
        </ul>
      </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
  
      <!-- Right elements -->
      <div class="d-flex align-items-center">
<!-- search elements -->
<form method="get" action="search.php">
<div class="input-group mx-2" >
  <div class="form-outline" style="width: 115px;">
    <input  type="text" class="form-control" name="query" required="required"/>
    <label class="form-label" for="form1">Search</label>
  </div>
  <button id="search-button" type="submit" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
</div>
</form>
        <!-- Icon -->
        <a class="text-reset me-3" href="cart.php?cid=<?php echo $_SESSION['token'] ?>">
        <i class="fas fa-shopping-cart"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php echo $count_cart_items ?></span>
        </a>
  
        <!-- Notifications -->
        <?php 
        $notify = mysqli_query($con,"SELECT * FROM notify WHERE status=0 and user_id='$uid'");
        $count = mysqli_num_rows($notify);
         ?>
        <div class="dropdown">
          <a
            class="text-reset me-3 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
            
          >
            <i class="fas fa-bell" id="notify"></i>
            <span class="badge rounded-pill badge-notification bg-danger"><?php echo $count ?></span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
          <?php 
          while($not = mysqli_fetch_array($notify)){

           ?>
            <li>
              <a class="dropdown-item" href="orders.php"><?php echo $not['message'] ?></a>
            </li>
            <?php
          }
          ?>
          </ul>
        </div>
        <!-- Avatar -->
        <div class="dropdown">
          <a
            class="dropdown-toggle d-flex align-items-center hidden-arrow"
            href="#"
            id="navbarDropdownMenuAvatar"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <img
              src="images/<?php echo $image ?>"
              class="rounded-circle"
              height="40"
              width="40"
              alt="users"
              loading="lazy"
            />
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuAvatar"
          >
            <li>
              <h4 class="dropdown-item text-secondary" ><i class="fa fa-user-circle"></i> <?php echo $users ?></h4>
            </li>
            <li>
              <a class="dropdown-item" href="orders.php"><i class="fab fa-product-hunt"></i> Orders</a>
            </li>

            <li>
              <a class="dropdown-item" href="wishlist.php"><i class="fa fa-heart"></i> wishlist</a>
            </li>
            <li>
              <a class="dropdown-item" href="profile.php?user_id=<?php echo $_SESSION['user_id'] ?>"><i class="fa fa-user-circle"></i> My profile</a>
            </li>
            
            <li>
              <a class="dropdown-item" href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#forgot"><i class="fas fa-cog"></i> Change Password</a>
            </li>
            <li>
              <a class="dropdown-item" href="#!" id="logout_btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <br><br>

  <!-- Navbar -->
  <!-- Navbar -->
    <?php
  }else{
    ?>
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
  
     <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img
            src="images/mancode.jpg"
            height="20"
            alt="Mancode Logo"
            loading="lazy"
            class="rounded"
          />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
           <b><a class="nav-link" href="index.php"><i class="fa fa-home"></i></a></b>
          </li>

          <li class="nav-item">
           <b><a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i></a></b>
          </li>
        </ul>
        <!-- Left links -->
<form method="GET" action="search.php">
  <div class="input-group mx-2" >
    <div class="form-outline">
      <input  type="text" class="form-control" name="query" required="required" placeholder="Search products" onkeyup="showResult(this.value)" />
      <label class="form-label" for="form1">Search</label>
    </div>
    <button id="search-button" type="submit" class="btn btn-primary">
    <i class="fas fa-search"></i>
    </button>
  </div>
</form>
      </div>
      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <a href="#" class="btn btn-primary mx-2"  data-mdb-toggle="modal" data-mdb-target="#login">LOGIN</a>

        <a href="#" class="btn btn-primary mx-2"  data-mdb-toggle="modal" data-mdb-target="#sign-in">SIGN-UP</a>
        </div>

      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <br><br>
  <!-- Navbar -->
  <?php
  }
   ?>  

<?php include 'slider.php';?>
<?php include 'top_product.php';?>
<?php include 'testimonials.php';?>
<?php include 'footer.php';?>

<script type="text/javascript">
  jQuery('#testimonials').on('submit',function(e){
    $("#testimoial_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>commenting...</span>");
    jQuery.ajax({
      url : 'tools.php',
      type : 'post',
      data:jQuery('#testimonials').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.error =='no'){
        jQuery('#test_msg').html(obj.msg);
        jQuery('#testimonials')[0].reset();
        jQuery('#testimoial_btn').html('Comment');
        jQuery('#testimoial_btn').attr('disabled',false);
        }else{
          jQuery('#test_msg').html(obj.msg);
        jQuery('#testimoial_btn').html('Try again');
        jQuery('#testimoial_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>

<input type="text" name="sesskey" id="sesskey" value="<?php echo session_id() ?>" hidden>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#logout_btn").on("click",function(){
        $("#logout_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Redirecting...</span>");
        jQuery('#logout_btn').attr('disabled',true);
        jQuery.ajax({
        url : "logout.php",
        type : "POST",
        data :{
          sesskey: $("#sesskey").val(),  
        },
        success: function(result){
          var obj = jQuery.parseJSON(result);
          if(obj.error=='no'){
             window.location = 'index.php';
             alert('Logout was successful');
        }
        }
      });
      });
    });
  </script>
</body>
</html>