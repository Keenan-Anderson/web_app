<?php include "includes/head.php" ?>

<?php
  if(isset($_POST['submit'])){
    // get user inut from form post
    $fullName = $_POST['full_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];
    $temp_password = $_POST['confirm_password'];
    if(!isset($_POST['terms'])){
      $terms = false;
    }else{
      $terms = $_POST['terms'];
    }

    // check if passwords match
    if($temp_password != $password){
      echo "<h3>Passwords do not match</h3>";
    }elseif(!$terms){
      echo "<h6> to create an account please agree to the terms</h6>";
    }else{
      // clean user input for database
      $fullName = mysqli_real_escape_string($connection,$fullName);
      $email = mysqli_real_escape_string($connection,$email);
      $password = mysqli_real_escape_string($connection,$password);
      //enctrypt password
      $password = password_hash($password, CRYPT_BLOWFISH);
      //db query
      $query = "INSERT INTO users(user_full_name, user_email, user_password)";
      $query .= "VALUES ('{$fullName}', '{$email}', '{$password}')";
      $new_user = mysqli_query($connection, $query);
      if(!$new_user){
        die("New user could not be created". mysqli_error($connection));
      }
      header("Location: login-v2.php");
    }

  }


?>


<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input name="full_name" type="text" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
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
        <div class="input-group mb-3">
          <input type="password" name="confirm_password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="true">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login-v2.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
