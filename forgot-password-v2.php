<?php use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

 include "includes/head.php";
 include "../secret.php";

if(isset($_POST['submit'])){
  if(isset($_POST['user_email'])){
    $user_email = $_POST['user_email'];
    //if email found send temp password
    $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
    $user_by_email = mysqli_query($connection, $query);
    $db_user = mysqli_fetch_assoc($user_by_email);
    if(empty($db_user)){
      echo "user not found";
    }else{
      $user_name = $db_user['user_full_name'];
      $user_id = $db_user['user_id'];
      $length = 12;
      $token = bin2hex(openssl_random_pseudo_bytes($length));
      $query = "UPDATE users SET token = '{$token}' WHERE user_email = '{$user_email}'";
      $pW_query = mysqli_query($connection, $query);

      $mail = new PHPMailer();
      $mail->IsSMTP();
      $mail->Mailer = "smtp";

      $mail->SMTPDebug  = 0;  
      $mail->SMTPAuth   = TRUE;
      $mail->SMTPSecure = "tls";
      $mail->Port       = 587;
      $mail->Host       = "smtp.gmail.com";
      $mail->Username   = "keenananderson.91@gmail.com";
      $mail->Password   = Secret::PW;

      $mail->IsHTML(true);
      $mail->AddAddress($user_email, $user);
      $mail->SetFrom("keenansWebApp@gmail.com", "keenans-webApp");
      $mail->Subject = "One Time Password";
      $content = "<b>a one time password has been set for you please use it to reset your password.</b> <br/><br/> $token <br/><br/> note: this password only works via the forgotten password feature";

      $mail->MsgHTML($content); 
      if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
      } else {
        header("Location: recover-password-v2.php?id=".$user_id);
      } 
    }
  }  
}
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="user_email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Request new password</button>
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
