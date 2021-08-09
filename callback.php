<?php session_start();
require_once("config.php");
try{
    $accessToken = $helper->getAccessToken() ;

}catch(\Facebook\Exceptions\FacebookResponseException $e){
    echo "Response Exception: ". $e->getMessage();
    exit();
}catch(\Facebook\Exceptions\FacebookSDKException $e){
    echo "SDK Exception: ". $e->getMessage();
    exit();
}

if(!$accessToken){
    header("Location: login-v2.php");
    exit();
}else{
    $oAuth2Client = $fb->getOAuth2Client();
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

    $response = $fb->get("/me?fields=id, first_name, last_name, email, picture.type(large)", $accessToken);
    $userData = $response->getGraphNode()->asArray();

    $_SESSION['access_token'] = (string) $accessToken;

    $_SESSION['user_id'] = $userData['id'];
    $_SESSION['user_email'] = $userData['email'];
    $_SESSION['user_full_name'] = $userData['first_name'].' '.$userData['last_name'];
    $imgArr = $userData['picture'];
    $_SESSION['user_image'] = $imgArr['url'];
    $_SESSION['method'] = 'FB';
    header('Location: index3.php');
}



?>