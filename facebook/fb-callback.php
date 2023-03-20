<?php

require_once 'config.php';


$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

$_SESSION['fb_access_token'] = (string) $accessToken;

$response = $fb->get('/me?fields=id,first_name,last_name,email,link', $_SESSION['fb_access_token']);
$responseImg = $fb->get('/me/picture?redirect=false&type=large', $_SESSION['fb_access_token']);

$user = $response->getGraphUser();
$img = $responseImg->getGraphUser();

// Connect to the database
require_once '../php/conn.php';

date_default_timezone_set('Asia/Bangkok');

// Escape user inputs for security
$fname = mysqli_real_escape_string($conn, $user['first_name']);
$lname = mysqli_real_escape_string($conn, $user['last_name']);
$email = mysqli_real_escape_string($conn, $user['email']);
$picture = mysqli_real_escape_string($conn, $img['url']);
$date = date("Y-m-d H:i:s");

// Check if the user already exists in the database
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {

    // Get picture profile
    $pictureData = file_get_contents($picture);
    $filename = uniqid() . '.jpg';
    $file = '../img/user_img/' . $filename;
    file_put_contents($file, $pictureData);

    // Insert the user into the database
    $sql = "INSERT INTO user (fname, lname, email, img_user, status, reg_date) VALUES ('$fname', '$lname', '$email', '$filename', 'Member', '$date')";
    if (mysqli_query($conn, $sql)) {
        // Get the user ID and status from the database
        $sql = "SELECT id, status FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['id'];
        $user_status = $row['status'];

        // Set the session variables
        $_SESSION['id'] = $user_id;
        $_SESSION['role'] = $user_status;
        $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";

        // Redirect to index.php
        header('Location: ../index');
        mysqli_close($conn);
        exit;
    } else {
        $e = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        $_SESSION['error'] = $e;

        // Redirect to index.php
        header('Location: ../login');
        mysqli_close($conn);
        exit;
    }
} else {
    // Get the user ID and status from the database
    $sql = "SELECT id, status FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['id'];
    $user_status = $row['status'];

    // Set the session variables
    $_SESSION['id'] = $user_id;
    $_SESSION['role'] = $user_status;

    // Redirect to index.php
    header('Location: ../index');
    mysqli_close($conn);
    exit;
}
