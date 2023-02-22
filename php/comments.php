<?php
require_once("conn.php");
if(!empty($_POST["comment"])){
	date_default_timezone_set('Asia/Bangkok');
	$date = date("Y-m-d H:i:s");

    $commentID = mysqli_real_escape_string($conn, $_POST["commentId"]);
    $sender = mysqli_real_escape_string($conn, $_POST["sender"]);
    $post_ref = mysqli_real_escape_string($conn, $_POST["post_ref"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $rating_data = mysqli_real_escape_string($conn, $_POST["rating_data"]);

	$insertComments = "INSERT INTO comment (post_ref, parent_id, comment, user_rating, comment_by, comment_at) VALUES ('$post_ref', '$commentID', '$rating_data', '$comment', '$sender', '$date')";
	mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));	
	$message = 'แสดงความคิดเห็นสำเร็จ!';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: กรุณาเขียนความคิดเห็น! </label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
echo json_encode($status);
