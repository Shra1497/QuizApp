<?php
session_start();
if(isset($_SESSION['login_id'])){
    header('Location: index.php');
    exit;
}
require 'google-api/vendor/autoload.php';

$client = new Google_Client();
$guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
$client->setHttpClient($guzzleClient);
$client->setClientId('410048790725-o6lvgluqc39se3lcfk2qrrgu1bbdb6ju.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:8080/quizapp/index.php');
$client->addScope("email");
$client->addScope("profile");
if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
		$_SESSION['login_id'] = $google_account_info->id;
        $_SESSION['name'] = trim($google_account_info->name);
        $_SESSION['email'] = $google_account_info->email;
		header('Location: welcome.php');
    }else{
        header('Location: index.php');
        exit;
    }
}else{ 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Quiz System</title>
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <link rel="shortcut icon" type="image/png" href="image/logo.png" />
        <style type="text/css">
		 body {
                width: 100%;
                background: url(image/book.png) ;
                background-position: center center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            }
			
			
    </style>
</head>
<body>
    <center>
        <div class="intro">
            <h1>Quiz system </h1>
			<a type="button" class="btn" href="<?php echo $client->createAuthUrl(); ?>">Sign in with Google</a>
		</div>
    </center>
</body>
</html>
<?php } ?>
