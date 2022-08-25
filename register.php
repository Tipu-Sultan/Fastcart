    <?php
    session_start();
    sleep(1);
    $sign_arr = array();
    include 'themancode.php';
    if (!empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['email'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']) ;
    $username = mysqli_real_escape_string($con, $_POST['username']) ;
    $email = mysqli_real_escape_string($con, $_POST['email']) ;
    $password= mysqli_real_escape_string($con, $_POST['password']) ;
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']) ;
    $agree = mysqli_real_escape_string($con, $_POST['agree']) ;

    $len = strlen($username);

    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
    $token =bin2hex(random_bytes(15));
    $user_id ="TMC".bin2hex(random_bytes(2));
    $emailquery = "select * from redcart where email='{$email}' and username='{$username}'";
    $query = mysqli_query($con,$emailquery);
    $emailcount = mysqli_num_rows($query);
    if($emailcount>0){

    $sign_arr = array('is_error'=>'yes','msgs'=>"<p class='text-danger text-center'>Email and User already taken </p>");
    }else{

    if (ctype_alnum($username)) {

    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Username must be Alpha-numeric</p>');
    }else{
      if ($len < 8) {
        $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Username must be 8 chars like (az,AZ,09,@!#)</p></p>');
      }else{
    if($password === $cpassword){
      if (strlen($password)< 8) {
        $sign_arr = array('error'=>'yes','msg'=>'<p>Password must be 8 chars like (az,AZ,09,@!#)</p>');
      }else{
    $insertquery = "insert into redcart(user_id,name,username, email, password, cpassword, status,agree,token,image) values('$user_id','$name','$username','$email','$pass','$cpass','inactive','$agree','$token','user.png')";
    $iquery = mysqli_query($con, $insertquery);
    if ($iquery) {

    $sign_arr = array('is_error'=>'no','msgs'=>'<p class="text-success text-center">Hi '.$name.'  your account created successfully</p>');


    }else{

    ?>
    <script>
    alert("Registration Failed!");
    </script>
    <?php
    }

    }

  }else{

    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Password are not matched</p>');
    }
  }
    }
    }
  }else{
    $sign_arr = array('is_error'=>'yes','msgs'=>'<p class="text-danger text-center">Please fill form properly</p>');
  }
    echo json_encode($sign_arr);

    ?>