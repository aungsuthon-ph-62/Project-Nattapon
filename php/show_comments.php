<?php
require_once("conn.php");
if (isset($_POST['postID'])) {
    $i = $_POST['postID'];
}

$commentQuery = "SELECT c.comment_id, c.post_ref, c.parent_id, c.comment, c.comment_by, c.comment_at, u.id, u.fname, u.lname, u.img_user
FROM comment as c
INNER JOIN user as u ON u.id = c.comment_by
WHERE c.parent_id = '0' AND c.post_ref = '$i' ORDER BY c.comment_id DESC";
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:" . mysqli_error($conn));
$commentHTML = '';
while ($comment = mysqli_fetch_assoc($commentsResult)) {
    $commentHTML .= '
        <div class="d-flex py-3 mb-4">
                <div class="flex-shrink-0"><img class="rounded-circle" src="img/user_img/' . $comment["img_user"] . '" alt="..." style="width: 50px; height:50 px;"></div>
                <div class="ms-3">
                    <div class="fw-bold">' . $comment["fname"] . ' ' . $comment["lname"] . ' : ' . $comment["comment_at"] . '</div>
		            ' . $comment["comment"] . '
                    <div class="text-end">
		                <button type="button" class="btn btn-outline-primary rounded-pill reply" reply-name="กำลังตอบกลับ : ' . $comment["fname"] . '"  id="' . $comment["comment_id"] . '"><i class="fa-solid fa-comments"></i> ตอบกลับ</button>
                    </div>
                </div>
        </div>  
    ';
    $commentHTML .= getCommentReply($conn, $comment["comment_id"], $i);
}
if ($commentHTML == "") { ?>
    <div class="text-center py-5">
        <h5>ยังไม่มีความคิดเห็น!</h5>
        <img class="img-fluid" src="img/no-chat.png" alt="No comment" style="width: 80px; height:80 px;" />
    </div>
<?php }
echo $commentHTML;

function getCommentReply($conn, $parentId = 0, $i, $marginLeft = 0)
{
    $commentHTML = '';
    $commentQuery = "SELECT c.comment_id, c.post_ref, c.parent_id, c.comment, c.comment_by, c.comment_at, u.id, u.fname, u.lname, u.img_user
    FROM comment as c
    INNER JOIN user as u ON u.id = c.comment_by
    WHERE c.parent_id = '$parentId' AND c.post_ref = '$i'";
    $commentsResult = mysqli_query($conn, $commentQuery);
    $commentsCount = mysqli_num_rows($commentsResult);
    if ($parentId == 0) {
        $marginLeft = 0;
    } else {
        $marginLeft = $marginLeft + 30;
    }
    if ($commentsCount > 0) {
        while ($comment = mysqli_fetch_assoc($commentsResult)) {
            $commentHTML .= '
            <div class="d-flex mt-4" style="margin-left:' . $marginLeft . 'px">
				
                    <div class="flex-shrink-0"><img class="rounded-circle" src="img/user_img/' . $comment["img_user"] . '" alt="..." style="width: 50px; height:50 px;"></div>
                    <div class="ms-3">
                        <div class="fw-bold">' . $comment["fname"] . ' ' . $comment["lname"] . ' : ' . $comment["comment_at"] . '</div>
		                ' . $comment["comment"] . '
                        <div class="text-end">
		                <button type="button" class="btn btn-outline-primary rounded-pill reply" reply-name="กำลังตอบกลับ : ' . $comment["fname"] . '"  id="' . $comment["comment_id"] . '"><i class="fa-solid fa-comments"></i> ตอบกลับ</button>
				        </div>
				    </div>
				
			</div>
				';
            $commentHTML .= getCommentReply($conn, $comment["comment_id"], $i, $marginLeft);
        }
    }
    return $commentHTML;
}
?>