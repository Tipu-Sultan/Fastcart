<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
       header('Location:index.php');
       die();
}
sleep(2);
include 'themancode.php';
$jsonLimit=array();
$username = mysqli_real_escape_string($con,$_POST['username']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$address = mysqli_real_escape_string($con,$_POST['address']);
$landmark = mysqli_real_escape_string($con,$_POST['landmark']);
$state = mysqli_real_escape_string($con,$_POST['state']);
$city = mysqli_real_escape_string($con,$_POST['city']);
$zip = mysqli_real_escape_string($con,$_POST['zip']);
$uid = $_SESSION['user_id'];
$tran_id = bin2hex(random_bytes(8));
$order_update = mysqli_query($con,"update order_items set username='$username',email='$email',address='$address',landmark='$landmark',state='$state',city='$city',zip='$zip' where user_id='$uid' ");

if($order_update){
	$jsonLimit=array('redirect'=>'yes','tran_id'=>$tran_id);
}else{
	$jsonLimit=array('redirect'=>'no','tran_id'=>$tran_id);
}
echo json_encode($jsonLimit); 
 ?>