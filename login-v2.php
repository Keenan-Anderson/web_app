<?php
require_once "../vendor/autoload.php";
 include "includes/head.php" ;
 include "config.php";?>

<?php

$redirectTo = 'http://localhost/minor-assesment/callback.php';
$data = ['email'];
$fullURL = $helper->getLoginUrl($redirectTo, $data);
  if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
    $get_user = mysqli_query($connection, $query);
    $db_user = mysqli_fetch_assoc($get_user);
    if(empty($db_user)){
      echo "<h6>email not found</h6>";
    }else{
      $db_user_id = $db_user['user_id'];
      $user_full_name = $db_user['user_full_name'];
      $db_email = $db_user['user_email'];
      $db_password = $db_user['user_password'];
      if(!password_verify($user_password, $db_password)){
        echo "<h6>invalid user credentials</h6>";
      }else{
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_full_name'] = $db_user['user_full_name'];
        $_SESSION['user_email'] = $db_email;
        $_SESSION['user_image'] = $db_user['user_image'];
        $_SESSION['user_education'] = $db_user['user_education'];
        $_SESSION['user_location'] = $db_user['user_location'];
        $_SESSION['user_skills'] = $db_user['user_skills'];
        $_SESSION['method'] = "local";     
        header("Location: index3.php");
      }
    }
  }

?>

<body class="hold-transition login-page">

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="user_email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="user_password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <div class="text-center">
        <H5>-OR-</H5>
      </div>
      
      <div class="social-auth-links text-center mt-2 mb-3">


      <div class="fb-login-button"  data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>

      <!-- <div class="col-12"></div> -->
            <input type="button" style="width:320px" onclick="window.location='<?php echo $fullURL ?>'" value="Continue with Facebook" name="submit" class="btn btn-primary" width="320">

            <input type="button" style="width:320px" onclick="window.location='<?php echo $login_url ?>'" value="Continue with Google +" name="submit" class="btn btn-danger" width="320">
          
      
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password-v2.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register-v2.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
