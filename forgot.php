

<?php
sleep(1); 
session_start();

include 'themancode.php';
$otpArr = array();
$type  = $_POST['type'];
if ($type == 'otp' && !empty($_POST['email'])) { 
  $email = $_POST['email'];
  $count = mysqli_num_rows(mysqli_query($con,"SELECT * FROM redcart where email = '$email'"));
  $fetch = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM redcart where email = '$email'"));
  $digits = 6; 
  $otp = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
  if ($count>0) {
  $update = mysqli_query($con,"update redcart set otp=$otp where email='$email'");
  if ($update) {
        $otpArr = array('opt_er'=>'no','msg'=>'<p class="text-success text-center">Hi '.$fetch['name'].' your OTP is : '.$otp.'</p>');
  }else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP Sending failed</p>');
  }
}else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Email not found</p>');
}
}


if ($type == 'resetapss') {
$otp= mysqli_real_escape_string($con, $_POST['otp']) ;  
$password= mysqli_real_escape_string($con, $_POST['password']) ;
$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']) ;
         
$pass = password_hash($password, PASSWORD_BCRYPT);
$cpass = password_hash($cpassword, PASSWORD_BCRYPT);
$resetapss = mysqli_query($con,"SELECT * FROM redcart where otp='$otp'");
$count  = mysqli_num_rows($resetapss);
if ($count>0) {
  $res = mysqli_fetch_array($resetapss);
  $otps = $res['otp'];
if ($otps === $otp) {
  if (strlen($password)>7){
$pass = mysqli_query($con,"update redcart set password='$pass',cpassword='$cpass' where otp='$otp'");
  if ($pass) {
  $otpArr = array('is_error' =>'no','msg'=>'<p class="text-success text-center">Password changed successfully</p>');
  }else{
    $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Password not changed</p>');
  }
}else{
  $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">Password must be at least 8 Alphanumerics</p>');
}
}else{
      $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP not matched or Expire</p>');
}

}else{
      $otpArr = array('is_error' =>'yes','msg'=>'<p class="text-danger text-center">OTP not matched or Expire</p>');
}
}

echo json_encode($otpArr);
 ?>