<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

// Set up the Google API client
$client = new Google_Client();
$client->setClientId('326495523578-f7that9oud03jgae2j824pio4aag4uob.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/Project_Nattapon/google_auth/redirect.php');
$client->addScope('email');
$client->addScope('profile');

// Handle the Google login request
if (isset($_GET['code'])) {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        $oauth2 = new Google_Service_Oauth2($client);
        $userinfo = $oauth2->userinfo->get();

        // Connect to the database
        require_once '../php/conn.php';

        date_default_timezone_set('Asia/Bangkok');

        // Escape user inputs for security
        $fname = mysqli_real_escape_string($conn, $userinfo->givenName);
        $lname = mysqli_real_escape_string($conn, $userinfo->familyName);
        $email = mysqli_real_escape_string($conn, $userinfo->email);
        $picture = mysqli_real_escape_string($conn, $userinfo->picture);
        $date = date("Y-m-d H:i:s");

        // Check if the user already exists in the database
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {

            // Get picture profile
            $pictureUrl = $userinfo->picture;
            $pictureData = file_get_contents($pictureUrl);
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
            $_SESSION['status'] = $user_status;

            // Redirect to index.php
            header('Location: ../index');
            mysqli_close($conn);
            exit;
        }

        // Close the database connection
        mysqli_close($conn);
    } catch (Exception $e) {
        $_SESSION['error'] = $e;

        // Redirect to login.php
        header('Location: ../login');
        exit;
    }
} else {
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
}
