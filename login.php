
<?php
session_start();
sleep(1);
    include 'themancode.php';
    $loginArr = array();
    if (isset($_POST['login'])) {
      include 'ip.php';
      $time=time()-30;
      $check_login_row=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as total_count from login_log where try_time>$time and ip_address='$ip'"));
      $total_count=$check_login_row['total_count'];
      if ($total_count == 3) {
        $loginArr = array('error'=>'yes','msg'=>'<p class="text-danger text-center">To many failed login attempts after 30 sec .</p>');
      }else{
      $both = $_POST['both'];
      $password = $_POST['password'];

      $email_search = " select * from redcart where status='active' and username='{$both}' or email='{$both}' ";
      $query =  mysqli_query($con,$email_search);

      $email_count = mysqli_num_rows($query);

      if ($email_count) {
       $email_pass = mysqli_fetch_assoc($query);

       $db_pass = $email_pass['password'];
       $pass_decode = password_verify($password, $db_pass);
       if ($pass_decode) {
        
       $_SESSION['username'] = $email_pass['username'];
       $_SESSION['sesskey'] = session_id();
       $_SESSION['name'] = $email_pass['name'];
       $_SESSION['image'] = $email_pass['image'];
       $_SESSION['id'] = $email_pass['id'];
       $_SESSION['user_id'] = $email_pass['user_id'];
       $_SESSION['token'] = $email_pass['token'];
       $_SESSION['mobile'] = $email_pass['mobile'];
       $_SESSION['email'] = $email_pass['email'];

       /////////////////
        $_SESSION['address'] = $email_pass['address'];
        $_SESSION['zip'] = $email_pass['zip'];
        $_SESSION['state'] = $email_pass['state'];
        $_SESSION['last_login'] = $email_pass['last_login'];

        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
         $times = date("Y-m-d H:i:s");
         $online = "update redcart set last_login='$times',sesskey='{$_SESSION['sesskey']}' where user_id='{$_SESSION['user_id']}' ";
         $query = mysqli_query($con,$online);
         mysqli_query($con,"delete from login_log where ip_address='$ip'");
         $loginArr = array('error'=>'no','msg'=>'<p class="text-danger text-center">Login successful</p>');

        
       }else{
        $loginArr = array('error'=>'yes','msg'=>'<p class="text-danger text-center">Incorrect password</p>');
        $total_count++;
        $rem_attm=3-$total_count;
        if($rem_attm==0){
        $loginArr = array('error'=>'yes','msg'=>'<p class="text-danger text-center">To many failed login attempts. Please login after 30 sec.</p>');
        }else{
        $loginArr = array('error'=>'yes','msg'=>'<p class="text-danger text-center">'.$rem_attm.' attempts remaining</p>');
        }
        $try_time=time();
        mysqli_query($con,"insert into login_log(ip_address,try_time) values('$ip','$try_time')");
        }
      }else{
        $loginArr = array('error'=>'yes','msg'=>'<p class="text-danger text-center">User or Email not found</p>');
      }
    }
    }
    echo json_encode($loginArr);
    ?>

