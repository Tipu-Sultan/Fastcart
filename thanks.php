<?php 
session_start();

sleep(2);
include 'cart_cal.php';
if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
 }

$uid = $_SESSION['user_id'];
$jsonLimit=array();
$order_id ="tmc"."2021".(date("m")).bin2hex(random_bytes(2));

$delivered = date("Y/m/d", strtotime(' +3 day'));

$cod = mysqli_real_escape_string($con,$_POST['cod']);
$number = mysqli_real_escape_string($con,$_POST['number']);

$order_update = mysqli_query($con,"update order_items set order_id='$order_id',delivered='$delivered',processed='10',status='confirmed' where user_id='$uid' and status='added_in_cart' ");

   // for confirmed

$cart_data = mysqli_query($con,"select * from order_items where order_id='$order_id' and status='confirmed' ");
$data = mysqli_fetch_array($cart_data);

$total_vat;
$email = $data['email'];
$username = $data['username'];
$address = $data['address'];
$zip = $data['zip'];
$cod = $_POST['cod'];
$image = $data['image'];
if (isset($_SESSION['COUPON_ID'])) {
    $coupon_id = $_SESSION['COUPON_ID'];
    $coupon_str = $_SESSION['COUPON_CODE'];
    $coupon_value = $_SESSION['COUPON_VALUE'];
    $cart_value =$_SESSION['cart_value'];

    $confirms = mysqli_query($con,"insert into confirm(order_id,user_id,username,email,number,address,price,total_item,image,coupon_id,coupon_value,coupon_code,cod,zip,status,date)values('$order_id','$uid','$username','$email','$number','$address',$cart_value,$total_cart,'$image',$coupon_id,'$coupon_value','$coupon_str','$cod','$zip','pending','$delivered')");
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
    unset($_SESSION['cart_value']);
    }else{
    
$confirm = mysqli_query($con,"insert into confirm(order_id,user_id,username,email,number,address,price,total_item,image,coupon_value,cod,zip,status,date)values('$order_id','$uid','$username','$email','$number','$address',$total_vat,$total_cart,'$image','0','$cod','$zip','pending','$delivered')");
    }

$notify = mysqli_query($con,"insert into notify (user_id,message)values('$uid','Hi $users you order new product')");

if($notify){
	$jsonLimit=array('redirect'=>'no','ord_msg'=>'order-id-'.$order_id);

}else{
	$jsonLimit=array('redirect'=>'yes');
}
echo json_encode($jsonLimit); 
 ?>