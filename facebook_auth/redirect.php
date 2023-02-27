<?php

require_once 'config.php';
require_once '../php/conn.php'; // Database connection file

$permissions = ['email']; //optional

if (isset($accessToken)) {
	if (!isset($_SESSION['facebook_access_token'])) {
		//get short-lived access token
		$_SESSION['facebook_access_token'] = (string) $accessToken;

		//OAuth 2.0 client handler
		$oAuth2Client = $fb->getOAuth2Client();

		//Exchanges a short-lived access token for a long-lived one
		$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
		$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

		//setting default access token to be used in script
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	} else {
		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
	}

	//redirect the user to the index page if it has $_GET['code']
	if (isset($_GET['code'])) {
		header('Location: ./');
	}

	try {
		$fb_response = $fb->get('/me?fields=name,first_name,last_name,email,picture.width(400).height(400)');
		$fb_user = $fb_response->getGraphUser();
		$user_id = $fb_user->getProperty('id');
		$user_first_name = $fb_user->getProperty('first_name');
		$user_last_name = $fb_user->getProperty('last_name');
		$user_email = $fb_user->getProperty('email');
		$user_picture = $fb_user->getPicture()->getUrl();

		$sql = "INSERT INTO user (fname, lname, email, img_user) VALUES ('$user_first_name', '$user_last_name', '$user_email', '$user_picture')";

		if (mysqli_query($conn, $sql)) {
			// User data inserted successfully
			$user_id = mysqli_insert_id($conn);
			// Store user ID in session
			$_SESSION['user_id'] = $user_id;
			// Redirect to the user dashboard or homepage
			header('Location: user_dashboard.php');
			exit();
		} else {
			echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
		}
	} catch (Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Facebook API Error: ' . $e->getMessage();
		session_destroy();
		// redirecting user back to app login page
		header("Location: ../login");
		exit;
	} catch (Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK Error: ' . $e->getMessage();
		exit;
	}
} else {
	// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used
	$fb_login_url = $fb_helper->getLoginUrl('http://localhost/Project_Nattapon/facebook_auth/redirect.php', $permissions);
}
?>

<a href="<?php echo htmlspecialchars($fb_login_url); ?>" class="btn btn-primary btn-login text-uppercase fw-bold">
	<i class="fab fa-facebook-f me-2"></i> Log in with Facebook
</a>