<?php
$comment_id = $_POST['edit_id'];
require_once "conn.php";
$sql = "SELECT c.comment_id, c.post_ref, c.comment, c.comment_by, c.comment_at, c.user_rating
    FROM comment as c
    WHERE c.comment_id = '$comment_id'";
$comment = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));
$fetchComment = mysqli_fetch_assoc($comment);
?>

    <div class="comments py-5">
        <div class="reply-form">
            <div class="container">
                <div class="d-flex align-items-center">
                    <h5 class="me-3">ให้คะแนน</h5>
                    <h4>
                        <i class="fas fa-star star-light star mr-1" id="star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light star mr-1" id="star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light star mr-1" id="star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light star mr-1" id="star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light star mr-1" id="star_5" data-rating="5"></i>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <input type="hidden" name="edit_row" id="edit_row" value="<?= $fetchComment['comment_id'] ?>">
                    <textarea name="edit_userReview" id="edit_userReview" class="form-control" placeholder="เขียนความคิดเห็นของคุณที่นี่*" rows="5"><?= $fetchComment['comment'] ?></textarea>
                    <span id="message" class="form-text text-danger">

                    </span>
                </div>
            </div>

        </div>
    </div>
