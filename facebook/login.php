<?php

require_once 'config.php';

$helper = $fb->getRedirectLoginHelper();

$redirectURL = "http://".$_SERVER['SERVER_NAME']."/Project_Nattapon/facebook/fb-callback.php";
$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($redirectURL, $permissions);

// echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
