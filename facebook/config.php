<?php
if(!SESSION_ID()){
    session_start();
}
require_once 'vendor/autoload.php'; // change path as needed

$app_id = '915471712928374';
$app_secret = '1350d8366c06f4bc28adbd39db458f63';

$fb = new \Facebook\Facebook([
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
]);

