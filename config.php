<?php require_once('../vendor/autoload.php');
//google credentials
  const GOOGLE_CLIENT_ID = '887515830767-s1ebg13cp0i5cihq4k1j1p0hpe68h4ui.apps.googleusercontent.com';
  const GOOGLE_SECRET = '46c6P7ig-3RNDs9qWR1wqlDh';

//fb credentials
class FB{
const FB_APP_ID = '900696620802009';
const FB_APP_SECRET = 'fe1b25d228af9cbf00ea0783879394cd';
const FB_REDIRECT_URI = "http://localhost/minor-assesment/login-v2.php";
}
$fb = new \Facebook\Facebook([
    'app_id' => FB::FB_APP_ID,
    'app_secret' => FB::FB_APP_SECRET,
    'default_graph_version' => 'v2.10',

    //'default_access_token' => '{access-token}', // optional
  ]);
$helper = $fb->getRedirectLoginHelper();

$google = new Google_client();
$google->setClientId(GOOGLE_CLIENT_ID);
$google->setClientSecret(GOOGLE_SECRET);
$google->setApplicationName("Keenans Web App Login");
$google->setRedirectUri('http://localhost/minor-assesment/controller.php');
$google->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

$login_url = $google->createAuthUrl();
?>