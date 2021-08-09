<?php include "includes/db.php";
  if(isset($_POST['submit'])){
    $temp_password = $_POST['temp_PW'];
    $new_password = $_POST['new_PW'];
    $conf_password = $_POST['conf_PW'];
    if($new_password === $conf_password){
      $user_id = $_GET['id'];
      $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
      $reset_query = mysqli_query($connection, $query);
      $db_user = mysqli_fetch_assoc($reset_query);
      $db_token = $db_user['token'];
      // check if temp password matches database
      if($temp_password !== $db_token){
        echo "<h3>please check your email for your temporary password and try again";
      }else{
        $new_password = mysqli_real_escape_string($connection, $new_password);
        $new_password = password_hash($new_password, CRYPT_BLOWFISH);
        $new_PW_query = "UPDATE users SET user_password = '{$new_password}', token = '' WHERE user_id = {$user_id}";
        $update_PW = mysqli_query($connection, $new_PW_query);
        if(!$update_PW){
          die("password could not be updated ". mysqli_error($connection));
        }else{

          header("Location: login-v2.php");
        }

      }

    }else{
      echo "<h3>Sorry, new passwords do not match. Please retype your password and try again.";
    }
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Recover Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index3.php" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, enter your temporary password to recover your password now.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" name="temp_PW" class="form-control" placeholder="Temporary Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="new_PW" class="form-control" placeholder="New Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="conf_PW" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login-v2.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
