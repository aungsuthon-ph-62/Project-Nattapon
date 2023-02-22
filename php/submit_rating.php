<?php

//submit_rating.php

$conn = new PDO("mysql:host=localhost;dbname=db_project", "root", "");

if (isset($_POST["rating_data"])) {

	date_default_timezone_set('Asia/Bangkok');
	$data = array(
		':sender'		=>	$_POST["sender"],
		':user_review'		=>	$_POST["user_review"],
		':user_rating'		=>	$_POST["rating_data"],
		':post_ref'		=>	$_POST["post_ref"],
		':datetime'			=>	date("Y-m-d H:i:s")
	);

	$query = "
	INSERT INTO comment
	(post_ref, comment, user_rating, comment_by, comment_at) 
	VALUES (:post_ref, :user_review, :user_rating, :sender, :datetime)
	";

	$statement = $conn->prepare($query);

	$statement->execute($data);

	echo "เพิ่มรีวิวสำเร็จ!";
}

if (isset($_POST["action"])) {

	$post_ref = $_POST['post_ref'];
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;

	$query = "SELECT c.post_ref, c.user_rating
	FROM comment as c
	WHERE c.post_ref = '$post_ref'
	ORDER BY c.comment_id";

	$result = $conn->query($query, PDO::FETCH_ASSOC);

	foreach ($result as $row) {


		if ($row["user_rating"] == '5') {
			$five_star_review++;
		}

		if ($row["user_rating"] == '4') {
			$four_star_review++;
		}

		if ($row["user_rating"] == '3') {
			$three_star_review++;
		}

		if ($row["user_rating"] == '2') {
			$two_star_review++;
		}

		if ($row["user_rating"] == '1') {
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];
	}

	$average_rating = $total_user_rating / $total_review;



	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review
	);

	if ($average_rating != 0) {
		$average_rating = number_format($average_rating, 1);
		$sql = "UPDATE post_tbl SET post_rating='$average_rating' WHERE id = '$post_ref'";
		$result_query =  $conn->query($sql);
	}

	echo json_encode($output);
}

