<!-- signin -->
<div class="modal fade" id="sign-in" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign up</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
      
                      <form class="mx-1 mx-md-4" action="#agree" method="POST" id="signin" name="signin">
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Amit,Ayan"/>
                            <label class="form-label" for="form3Example1c">Your Name</label>
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="username_singin" class="form-control" name="username" placeholder="(az,AZ,09,@!#)" onkeyup="findusers(this.value)"/>
                            <label class="form-label" for="form3Example1c">Username</label>
                          </div>
                        </div>
                        <p class="text-danger" id="dataTable">* </p>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" id="email_singin" class="form-control" name="email"/>
                            <label class="form-label" for="form3Example3c">Your Email</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password" class="form-control" name="password" placeholder="(az,AZ,09,@!#)" onkeyup="signpass(this.value)"/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>
                        <p id="pass_msg"></p>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="cpassword_singin" class="form-control" name="cpassword" />
                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                          </div>
                        </div>
      
                        <div class="form-check d-flex justify-content-center mb-5">
                          <input
                            class="form-check-input me-2"
                            type="checkbox"
                            value="I agree all statements in Terms of service"
                            id="agree_singin"
                            name="agree"
                          />
                          <label class="form-check-label" for="form2Example3">
                            I agree all statements in <a href="#!">Terms of service</a>
                          </label>
                        </div>
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                         <button  class="btn btn-primary btn-block mb-4" id="signin_btn" name="submit">Signin</button>
                        </div>
                              

                      </form>
                      <div id="succ_msg">
                        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- ///////////// -->
<script type="text/javascript">
  jQuery('#signin').on('submit',function(e){
    $("#signin_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>creating...</span>");
    jQuery('#signin_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'register.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var sin = jQuery.parseJSON(result);
         if(sin.is_error == 'no'){
        jQuery('#succ_msg').html(sin.msgs);
        jQuery('#signin')[0].reset();
        jQuery('#signin_btn').html('done');
        jQuery('#signin_btn').attr('disabled',false);
        }else if(sin.is_error == 'yes'){
          jQuery('#succ_msg').html(sin.msgs);
          jQuery('#signin')[0].reset();
          jQuery('#signin_btn').html('retry');
        jQuery('#signin_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>
<!-- //////////////////////// -->
<script type="text/javascript">
    function findusers(str) {
        if (str.length==0) {
    document.getElementById("dataTable").innerHTML="";
    document.getElementById("dataTable").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{search:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#dataTable').html(obj.res);
                }else if (obj.error == 'yes'){
                    $('#dataTable').html(obj.msg);
                }
            }
        });
    }
</script>
<script type="text/javascript">
    function signpass(str) {
        if (str.length==0) {
    document.getElementById("pass_msg").innerHTML="";
    document.getElementById("pass_msg").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{alpha:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#pass_msg').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#pass_msg').html(obj.msg);
                }
            }
        });
    }
</script>

<!-- login  -->

<div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
      
                      <form class="mx-1 mx-md-4" method="POST" action="#" id="login_form" name="login_form">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="both_lgin" class="form-control" name="both" required=""/>
                            <input type="text" id="copy_both" class="form-control" name="login" value="login" hidden="" />
                            <label class="form-label" for="form3Example1c">Email / Username</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_login" class="form-control" name="password" required=""/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>

                        <p id="login_msg"></p>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" class="btn btn-primary btn-lg" id="login_btn">Login now</button>
                        </div>
                        <p class="text-center"><a href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#forgot">Forgot password</a></p>
                      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery('#login_form').on('submit',function(e){
    $("#login_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Connecting...</span>");
    jQuery('#login_btn').attr('disabled',true);
    jQuery.ajax({
            type: 'POST',
            url: 'login.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
      success:function(result){
        var login = jQuery.parseJSON(result);
         if(login.error == 'no'){
          window.location = 'index.php';
          alert('Login successfully');
        jQuery('#login_form')[0].reset();
        }else if(login.error == 'yes'){
          jQuery('#login_msg').html(login.msg);
          jQuery('#login_form')[0].reset();
          jQuery('#login_btn').html('retry');
        jQuery('#login_btn').attr('disabled',false);
        }
      }
    });
    e.preventDefault();
  });
</script>

<!-- forgot account -->
<div class="modal fade" id="forgot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forgot</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Forgot password</p>
      
                      <form class="mx-1 mx-md-4" method="POST" id="opt_form" name="opt_form" >
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="email_forgot" name="email" class="form-control" onkeyup="otpEnableDisable(this) " required=""/>
                            <input type="text" id="type_forgot" name="type" value="otp" hidden>
                            <label class="form-label" for="form3Example1c">Email or Mobile</label>
                          </div>
                        </div>
      
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" id="otp_btn" class="btn btn-primary btn-lg" disabled="disabled">GET OTP</button>
                        </div>
                        <div id="otp_msg">
                          
                        </div>
                      </form>
                      <script type="text/javascript">
    function otpEnableDisable() {
        var val = document.getElementById('email_forgot').value;
        if(val.length>5) {
            document.getElementById('otp_btn').disabled='';
        }
        else {
            document.getElementById('otp_btn').disabled='disabled';
        }
    }
</script>
                      
                      <form class="mx-1 mx-md-4" method="POST" id="reset_pass" name="reset_pass">
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="otp_otp" class="form-control" name="otp" onkeyup="EnableDisable(this)" required="" />
                            <input type="text" id="type_otp" name="type" value="resetapss" hidden>
                            <label class="form-label" for="form3Example1c">Enter OTP</label>
                          </div>
                        </div>
      
                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_otp" class="form-control" name="password" placeholder="(az,AZ,09,@!#)" onkeyup="passwrds(this.value)" required=""/>
                            <label class="form-label" for="form3Example4c">Password</label>
                          </div>
                        </div>
                        <p id="pass_msgs"></p>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="password_otp" class="form-control" name="cpassword" required=""/>
                            <label class="form-label" for="form3Example4c">Repeat Password</label>
                          </div>
                        </div>
                        <input type="checkbox" onclick="myFunction()">Show Password


                        <div id="reset_msg">
                          
                        </div>
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <button type="submit" name="submit" id="reset_btn" class="btn btn-primary btn-lg" disabled="disabled">Reset now</button>
                        </div>
                        <p class="text-center"><a href="#" data-mdb-dismiss="modal" data-mdb-toggle="modal" data-mdb-target="#login">Retry login</a></p>
                        <div id="reset_msg">
                          
                        </div>
                      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("password_otp");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


<script type="text/javascript">
    function EnableDisable() {
        var val = document.getElementById('otp_otp').value;
        if(val.length>5) {
            document.getElementById('reset_btn').disabled='';
        }
        else {
            document.getElementById('reset_btn').disabled='disabled';
        }
    }
</script>

<script type="text/javascript">
    function passwrds(str) {
        if (str.length==0) {
    document.getElementById("pass_msgs").innerHTML="";
    document.getElementById("pass_msgs").style.border="0px";
    return;
  }
        $.ajax({
            url:"filter.php",
            type: "POST",
            data :{alpha:str},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.error == 'no') {
                    $('#pass_msgs').html(obj.msg);
                }else if (obj.error == 'yes'){
                    $('#pass_msgs').html(obj.msg);
                }
            }
        });
    }
</script>

<script type="text/javascript">
  jQuery('#reset_pass').on('submit',function(e){
    $("#reset_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Reseting...</span>");
    jQuery('#reset_btn').attr('disabled',true);
    jQuery.ajax({
      url : 'forgot.php',
      type : 'post',
      data:jQuery('#reset_pass').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.is_error == 'no'){
        jQuery('#reset_msg').html(obj.msg);
        jQuery('#reset_pass')[0].reset();
        jQuery('#reset_btn').html('Done');
        jQuery('#reset_btn').attr('disabled',false);
      }else{
        jQuery('#reset_msg').html(obj.msg);
        jQuery('#reset_pass')[0].reset();
        jQuery('#reset_btn').html('Try again');
        jQuery('#reset_btn').attr('disabled',false);
      }
      }
    });
    e.preventDefault();
  });
</script>

<script type="text/javascript">
  jQuery('#opt_form').on('submit',function(e){
    $("#otp_btn").html("<div class='spinner-border text-danger spinner-border-sm'></div> <span style='font-size:12px;'>Sending...</span>");
    jQuery('#otp_btn').attr('disabled',true);
    jQuery.ajax({
      url : 'forgot.php',
      type : 'post',
      data:jQuery('#opt_form').serialize(),
      success:function(result){
        var obj = jQuery.parseJSON(result);
        if(obj.opt_er == 'no'){
        jQuery('#otp_msg').html(obj.msg);
        jQuery('#opt_form')[0].reset();
        jQuery('#otp_btn').html('Resend');
        jQuery('#otp_btn').attr('disabled',false);
      }else{
        jQuery('#otp_msg').html(obj.msg);
        jQuery('#opt_form')[0].reset();
        jQuery('#otp_btn').html('Try again');
        jQuery('#otp_btn').attr('disabled',false);
      }
      }
    });
    e.preventDefault();
  });
</script>
<div class="modal fade" id="del_account" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Delete account</p>

        <p class="text-center text-danger">Are you sure to delete this account</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
        <a href="?del_account=<?php echo $_SESSION['user_id'] ?>&sesskey=<?php echo $_SESSION['sesskey'] ?> "><button type="button" class="btn btn-danger">delete</button></a>
      </div>
    </div>
  </div>
</div>


<!-- //////////////remove image -->


  <!-- Modal -->
  <div class="modal fade" id="myModaledit" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
      <div class="form-group">
                  <h4 class="modal-title">Image changing setup on</h4>

                <label class="font-weight-bold">image</label>
                <?php
if (isset($image)) {
?>
<a href="images/<?php echo $image?>"><img  style="border-radius: 50%;" src="images/<?php echo $image?>" alt="?" height="50" width="50"></a><br>
<?php
}else{
echo "NULL";
}
?>
<p><a href="edit_redirect.php?repic=<?php echo $view['user_id']?>">Remove picture</a></p>
                 <!-- File upload form -->
<form id="uploadForm" class="mt-2" enctype="multipart/form-data" method="post">
    <label>Choose File:</label>
    <input type="text" name="user_id" value="<?php echo $user_id ?>" hidden>
    <input type="file" name="file" id="fileInput" class="form-control" required="">
    <br>
    <input class="form-control" type="submit" name="submit" value="UPLOAD"/>
</form>
<!-- Progress bar -->
<div class="progress mt-5">
    <div class="progress-bar"></div>
</div>

<!-- Display upload status -->
<div id="uploadStatus" class="mt-5"></div>

        </div>
        </div>
      </div>
    </div>
  </div>

 <!-- script tag end -->
<script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
      jQuery('#upload_btn').attr('disabled',true);
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'edit_redirect.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                 var sin = jQuery.parseJSON(resp);
             if(sin.is_error == 'no'){
            jQuery('#uploadStatus').html(sin.msgs);
            jQuery('#uploadForm')[0].reset();
            jQuery('#upload_btn').html('UPLOADED');
            jQuery('#upload_btn').attr('disabled',true);
            }else if(sin.is_error == 'yes'){
            jQuery('#uploadStatus').html(sin.msgs);
            jQuery('#uploadForm')[0].reset();
            jQuery('#upload_btn').html('Retry');
            jQuery('#upload_btn').attr('disabled',false);
            }
            }
        });
    });
  
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (JPG, PNG, GIF, JPEG');
            $("#fileInput").val('');
            return false;
        }
    });
});
</script>
