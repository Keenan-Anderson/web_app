<?php session_start();
require_once('../vendor/autoload.php');
require_once('config.php');
if(isset($_GET['code'])){
    $token = $google->fetchAccessTokenWithAuthCode($_GET['code']);
}else{
    header('Location: login-v2.php');
    exit();
}

if(isset($token["error"]) != 'invalid_grant'){
  $oAuth = new Google_Service_Oauth2($google);
$user_data = $oAuth->userinfo_v2_me->get();

$_SESSION['user_id'] = $user_data['id'];
$_SESSION['user_full_name'] = $user_data['name'];
$_SESSION['user_email'] = $user_data['email'];
$_SESSION['user_image'] = $user_data['picture'];
$_SESSION['method'] = 'google';
header("Location: index3.php");
}
else{
    header("Location: login-v2.php");
}

?>