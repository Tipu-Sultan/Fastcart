<?php 

   include('themancode.php');
   date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
   $time =  time();

   if ($time>1661266282) {
   $sql = "select * from redcart";
   $q = mysqli_query($con,$sql);
   $html = "
<table>
    <tr><td>Name       : <td>Hi,SULTAN</td></td></tr>
    <tr><td>message    : <td> recover your account verification was requested for your email: teepul</td></td></tr>
    <tr><td>link      : <td>http://localhost/redstore/admin/adm_login.php?token=102030</td></td></tr>
    <tr><td>contact us : <td>this link valid for 10 minutes for further problems contact this number '9919408817' Thank You !  </td></td></tr>
  </table>
  ";
  include('smtp/PHPMailerAutoload.php');
  $mail=new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host="smtp.gmail.com";
  $mail->Port=587;
  $mail->SMTPSecure="tls";
  $mail->SMTPAuth=true;
  $mail->Username="tipu@student.iul.ac.in";
  $mail->Password="GB&ec=GAlA8wE&flow";
  $mail->SetFrom("tipu@student.iul.ac.in");
  while ($row = mysqli_fetch_array($q)){
  $email = $row['email'];
  $mail->addAddress($email);
}
  $mail->IsHTML(true);
  $mail->Subject="activate account confirmation";
  $mail->Body=$html;
  $mail->SMTPOptions=array('ssl'=>array(
    'verify_peer'=>false,
    'verify_peer_name'=>false,
    'allow_self_signed'=>false
  ));

  if($mail->send()){
echo "send email";
  }
  }
  else
  {
    echo "time remaining";

  }

 ?>