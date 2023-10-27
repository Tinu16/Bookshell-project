<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("sppr6075m89gtkhq3m2p5dk28suoji33.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Bookshell Login");
$gClient->setRedirectUri("http://localhost/bookshell/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// login URL
$login_url = $gClient->createAuthUrl();
?>