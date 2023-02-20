<?php if (isset($_GET['page']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT u.fname, u.lname, u.status, p.id, p.post_unid, p.post_content, p.post_date, 
p.post_topic, p.post_content, p.post_banner, p.post_provinces, fac.faculty_name 
FROM post_tbl as p 
INNER JOIN faculty as fac ON fac.id = p.post_faculty 
INNER JOIN user as u ON u.id = p.post_by 
WHERE p.post_unid = '$id'";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);
    ?>

    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <section>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded" src="admin/assets/img/postBanner/<?= $post['post_banner'] ?>" alt="<?= $post['post_banner'] ?>" /></figure>
                    <!-- Post content-->
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1"><?= $post['post_topic'] ?></h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">โพสต์เมื่อ : <?= $post['post_date'] ?> โดย <?= $post['fname'] ?> <?= $post['lname'] ?> <b class="text-danger">[<?= $post['status'] ?>]</b></div>
                        <!-- Post categories-->
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= $post['post_provinces'] ?></a>
                        <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= $post['faculty_name'] ?></a>
                    </header>

                    <article class="mb-5">
                        <?php print_r($post['post_content']); ?>
                    </article>
                </section>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card border-0 bg-light p-md-2">
                        <div class="card-body mb-3">
                            <!-- Comment form-->
                            <form method="POST" id="commentForm">
                                <div class="mb-3 shadow rounded-4">
                                    <textarea name="comment" id="comment" class="form-control border-0 p-md-4 overflow-hidden rounded-4" rows="5" placeholder="...เขียนความคิดเห็น"></textarea>
                                </div>
                                <span id="message" class="form-text text-danger"></span>
                                <span id="replying" class="form-text text-success"></span>
                                <input type="hidden" name="commentId" id="commentId" value="0">
                                <input type="hidden" name="sender" id="sender" value="<?= $user['id'] ?>">
                                <input type="hidden" name="postID" id="postID" value="<?= $post['id'] ?>">

                                <div class="text-end">
                                    <button type="submit" name="submit" id="submit" class="btn btn-primary rounded-pill"><i class="fa-solid fa-message mx-2"></i> แสดงความคิดเห็น</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-white border-top border-5 border-secondary rounded shadow">
                            <h5><i class="fa-solid fa-comments"></i> ความคิดเห็นทั้งหมด </h5>
                            <?php
                            $i = $post['id'];
                            $commentQuery = "SELECT c.comment_id, c.post_ref, c.parent_id, c.comment, c.comment_by, c.comment_at, u.id, u.fname, u.lname, u.img_user
                                FROM comment as c
                                INNER JOIN user as u ON u.id = c.comment_by
                                WHERE c.parent_id = '0' AND c.post_ref = '$i' ORDER BY c.comment_id DESC";
                            $commentsResult = mysqli_query($conn, $commentQuery) or die("database error:" . mysqli_error($conn));
                            $commentsCount = mysqli_num_rows($commentsResult);
                            if ($commentsCount > 0) { ?>
                                <?php while ($comment = mysqli_fetch_assoc($commentsResult)) { ?>
                                    <!-- Single comment-->
                                    <div class="d-flex py-md-3">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="img/user_img/<?= $comment['img_user'] ?>" alt="..." style="width: 50px; height:50 px;" /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold"><?= $comment['fname'] ?> <?= $comment['lname'] ?> <span class="fw-normal text-muted">[ <?= $comment['comment_at'] ?> ]</span></div>
                                            <?= $comment['comment'] ?>
                                        </div>
                                    </div>
                                    <hr>
                                <?php }
                                mysqli_free_result($commentsResult); ?>
                            <?php } else { ?>
                                <div class="text-center py-5">
                                    <h5>ยังไม่มีความคิดเห็น!</h5>
                                    <img class="img-fluid" src="img/no-chat.png" alt="No comment" style="width: 80px; height:80 px;" />
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                </section>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
                <!-- Categories widget-->
                <div class="card mb-4">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">Web Design</a></li>
                                    <li><a href="#!">HTML</a></li>
                                    <li><a href="#!">Freebies</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#!">JavaScript</a></li>
                                    <li><a href="#!">CSS</a></li>
                                    <li><a href="#!">Tutorials</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Side widget-->
                <div class="card mb-4">
                    <div class="card-header">Side Widget</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#commentForm").on("submit", function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "php/comments.php",
                    method: "POST",
                    data: formData,
                    dataType: "JSON",
                    success: function(response) {
                        if (!response.error) {
                            $("#commentForm")[0].reset();
                            $("#commentId").val("0");
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: '1200'
                            }).then((result) => {
                                window.location.reload();
                            });
                        } else if (response.error) {
                            $("#commentId").val("0");
                            $("#message").html(response.message);
                        }
                    },
                });
            });
            $(document).on("click", ".reply", function() {
                var commentId = $(this).attr("id");
                var replyName = $(this).attr("reply-name");
                $("#commentId").val(commentId);
                $("#replying").html(replyName);
                $("#comment").focus();
            });
        });
    </script>
    <?php mysqli_free_result($result); ?>
<?php } else {
    echo "<script> window.location.href='index';</script>";
} ?>