<?php 
require('nav.php'); 
if (!isset($_SESSION['user_id'])) {
   header('location:index.php');
   die();
 }

if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];
    }else{
    $coupon_id = '';
    $coupon_str = '';
    $coupon_value = '';
    $cart_value = '';
    }

?>

<section
  class="p-4 p-md-5 mt-4"
  style="
    background-image: url(https://mdbcdn.b-cdn.net/img/Photos/Others/background3.webp);
  "
>
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-5">
      <div class="card rounded-3">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <h3>THEMANCODE</h3>
            <h6>Payment</h6>
          </div>

            <div
              class="px-3 py-4 border border-primary border-2 rounded mt-4 d-flex justify-content-between"
            >
              <div class="d-flex flex-row align-items-center">
                <img src="https://i.imgur.com/S17BrTx.webp" class="rounded" width="60" />
                <div class="d-flex flex-column ms-4">
                  <span class="h5 mb-1">Total pay amount</span>
                  <span class="small text-muted">Total items : <?php echo $total_cart ?></span>
                </div>
              </div>
              <div class="d-flex flex-row align-items-center">
                <span class="h2 mx-1 mb-0">
                  <?php
                  if (isset($_SESSION['COUPON_ID'])) {
                    echo $cart_value;
                  }else{
                 echo $total_vat ;
               }
                  ?></span>
                <span class="text-muted font-weight-bold mt-2"> ₹</span>
              </div>
            </div>
            <form id="confirm_order" name="confirm_order">
              <div class="form-outline mt-4">
              <input
                type="text"
                id="formControlLgXsd"
                class="form-control form-control-lg"
                name="number"
                id="number"
                value="<?php echo $_SESSION['mobile'] ?>"
                require=""
              />
              <label class="form-label" for="formControlLgXsd">Mobile number</label>
            </div>

            <div class="form-check mt-3">
               <input class="form-check-input mb-4" type="radio" name="cod" id="cod" value="COD" />
               <label class="form-check-label" for="flexRadioDefault1">COD</label>
            </div>
           <!--  card section -->
              <p class="text-info mt-3">Pay online through Razor-Pay</p>
              <a href="http://localhost/fastcart/razorpay/razorpay/index.php"><img src="images/razorpay.png" width="96" height="21"></a>
              
            </div>
            <button id="place_order" class="btn btn-success btn-lg btn-block" name="submit">Place order</button>
            <p class="text-center text-danger" id="empty"></p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script type="text/javascript">
  jQuery('#confirm_order').on('submit',function(e){
    $("#place_order").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Redirecting...</span>");
    jQuery('#place_order').attr('disabled',true);
    jQuery.ajax({
      url : 'thanks.php',
      type : 'post',
      data:jQuery('#confirm_order').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
         if(obj.redirect =='no'){
        window.location = 'orders.php?ord_msg='+obj.ord_msg;
        jQuery('#place_order').attr('disabled',false);
        }else if(obj.redirect =='yes'){
          jQuery('#succ_msg').html('Not inserted');
          jQuery('#confirm_order')[0].reset();
          jQuery('#place_order').html('retry');
        jQuery('#place_order').attr('disabled',false);
        }
      }
    });


  e.preventDefault();
  });
</script>