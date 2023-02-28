<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link  rounded-pill active" href="#activity" data-toggle="tab">กิจกรรม</a></li>
            <?php if (isset($_GET['p'])) {
                $p = $_GET['p']; ?>
                <?php if ($p == "viewProfile") { ?>
                    <li class="nav-item"><a class="nav-link rounded-pill" href="#settings" data-toggle="tab">แก้ไขข้อมูลส่วนตัว</a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="activity">

                <?php
                $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date,
                        u.fname, u.lname, u.img_user
                        FROM post_tbl as p 
                        INNER JOIN user as u ON u.id = p.post_by 
                        ORDER BY p.id DESC";
                $postTable_result = mysqli_query($conn, $sql);
                $postCount = mysqli_num_rows($postTable_result);
                if ($postCount > 0) { ?>
                    <?php foreach ($postTable_result as $row) { ?>
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle" src="../img/user_img/<?= $row['img_user'] ?>" alt="user image">
                                <span class="username">
                                    <p class="m-0"><?= $row['fname'] ?> <?= $row['lname'] ?></p>
                                </span>
                                <span class="description">โพสต์เมื่อ - <?= DateThai($row['post_date']) ?></span>
                            </div>
                            <p class="m-0">
                                <i class="fa-solid fa-building text-primary"></i> ชื่อบริษัท : <b><?= $row['post_topic'] ?></b>
                            </p>
                            <p>
                                <i class="fa-solid fa-location-dot text-danger"></i> ที่อยู่ : <b><?= $row['post_address'] ?></b>
                            </p>
                            <p>
                                <a data-toggle="collapse" class="text-muted" href="#<?php echo $row['post_unid']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $row['post_unid']; ?>"><i class="fa-solid fa-circle-info text-info"></i> รายละเอียดโพสต์</a>
                            </p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse" id="<?php echo $row['post_unid']; ?>">
                                        <div class="card card-body border-0 shadow">
                                            <article>
                                                <?= $row['post_content'] ?>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <a data-toggle="collapse" href="#review<?= $row['post_unid'] ?>" role="button" aria-expanded="false" aria-controls="review<?= $row['post_unid'] ?>" href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1 text-info"></i> รีวิว (<?php $countReview = countComments($conn, $row['id']); foreach ($countReview as $reviews) { echo $reviews['noComments']; } ?>)
                                </a>
                            </p>
                            <div class="row">
                                <div class="col">
                                    <div class="collapse" id="review<?= $row['post_unid'] ?>">
                                        <?php
                                        $i = $row['id'];
                                        $commentQuery = "SELECT c.comment_id, c.post_ref, c.parent_id, c.comment, c.comment_by, c.comment_at, u.id, u.fname, u.lname, u.img_user
                                FROM comment as c
                                INNER JOIN user as u ON u.id = c.comment_by
                                WHERE c.parent_id = '0' AND c.post_ref = '$i' ORDER BY c.comment_id DESC";
                                        $commentsResult = mysqli_query($conn, $commentQuery) or die("database error:" . mysqli_error($conn));
                                        $commentsCount = mysqli_num_rows($commentsResult);
                                        if ($commentsCount > 0) { ?>
                                            <?php foreach ($commentsResult as $comment) { ?>
                                                <div class="post clearfix">
                                                    <div class="user-block">
                                                        <img class="img-circle" src="../img/user_img/<?= $comment['img_user'] ?>" alt="user image">
                                                        <span class="username">
                                                            <a class="text-muted"><?= $comment['fname'] ?> <?= $comment['lname'] ?></a>
                                                        </span>
                                                        <span class="description">แสดงความคิดเห็นเมื่อ - <?= DateThai($comment['comment_at']); ?></span>
                                                    </div>
                                                    <p>
                                                        <?= $comment['comment'] ?>
                                                    </p>
                                                </div>
                                            <?php }
                                            mysqli_free_result($commentsResult); ?>
                                        <?php } else { ?>
                                            <div class="text-center py-5">
                                                <h5>ยังไม่มีความคิดเห็น!</h5>
                                                <img class="img-fluid" src="assets/img/out-of-stock.png" alt="No comment" style="width: 80px; height:80 px;" />
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="post">
                        <div class="text-center py-5">
                            <h5>ยังไม่มีรายการโพสต์!</h5>
                            <img class="img-fluid" src="assets/img/out-of-stock.png" alt="Out of post" style="width: 80px; height:80 px;" />
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="tab-pane" id="settings">
                <form id="postForm" method="post" action="php/action.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="editMember">
                    <input type="hidden" name="oldImage" value="<?= $user['img_user'] ?>">
                    <input type="hidden" name="uid" value="<?= $user['id'] ?>">
                    <input type="hidden" name="oldPassword" value="<?= $user['pass'] ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputFile">รูปภาพส่วนตัว</label>
                            <div class="p-md-5">
                                <?php if ($user['img_user'] == "") { ?>
                                    <img src="../img/user.png" id='previewImg' class='img-thumbnail rounded-lg w-25'>
                                <?php } else { ?>
                                    <img src="../img/user_img/<?= $user['img_user'] ?>" id='previewImg' class='img-thumbnail rounded-lg w-25'>
                                <?php } ?>
                            </div>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputImage" name="inputImage" accept='image/gif, image/jpeg, image/png, image/jpg'>
                                    <label class="custom-file-label" for="inputImage">แก้ไขรูปภาพส่วนตัว</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputFname">ชื่อจริง</label>
                                <input type="text" class="form-control" id="inputFname" name="inputFname" value="<?= $user['fname'] ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputLname">นามสกุล</label>
                                <input type="text" class="form-control" id="inputLname" name="inputLname" value="<?= $user['lname'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStdID">รหัสนักศึกษา</label>
                            <input class="form-control" id="inputStdID" name="inputStdID" value="<?= $user['std_no'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">อีเมลล์</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?= $user['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">พาสเวิร์ด</label>
                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="กรอกพาสเวิร์ดใหม่ที่นี่" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">สถานะ</label>
                            <select id="inputStatus" class="form-control" id="inputStatus" name="inputStatus">
                                <option class="bg-gradient-success" value="<?= $user['status'] ?>" selected><?= $user['status'] ?></option>
                                <option value="Member">สมาชิก</option>
                                <option value="Admin">แอดมิน</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <button type="submit" class="btn bg-gradient-success rounded-pill float-right float-md-left"><i class="fa-solid fa-check"></i> ยืนยัน</button>
                        <button type="reset" class="btn bg-gradient-warning rounded-pill float-left float-md-right"><i class="fa-solid fa-arrow-rotate-left"></i> รีเซ็ท</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<?php if (isset($_GET['p'])) {
    $p = $_GET['p']; ?>
    <?php if ($p == "viewProfile") { ?>
        <script>
            let imgInput = document.querySelector('#inputImage');
            let previewImg = document.querySelector('#previewImg');

            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
            $(function() {
                $.validator.setDefaults({

                });
                $("#postForm").validate({
                    rules: {
                        inputFname: {
                            required: true,
                        },
                        inputLname: {
                            required: true,
                        },
                        inputStdID: {
                            required: true,
                            number: true
                        },
                        inputEmail: {
                            required: true,
                            email: true
                        },
                        inputPassword: {
                            minlength: 5
                        },
                        inputStatus: {
                            required: true,
                        },
                    },
                    messages: {
                        inputFname: {
                            required: "กรุณากรอกชื่อจริง!",
                        },
                        inputLname: {
                            required: "กรุณากรอกนามสกุล!",
                        },
                        inputStdID: {
                            required: "กรุณาเลือกกรอกรหัสนักศึกษา!",
                            number: "รหัสนักศึกษาต้องเป็นตัวเลขเท่านั้น!",
                        },
                        inputEmail: {
                            required: "กรุณากรอกอีเมลล์!",
                            email: "กรุณาตรวจสอบความถูกต้องของอีเมล์!",
                        },
                        inputPassword: {
                            minlength: "รหัสผ่านต้องมีความยาวมากกว่า 5 ตัวอักษร!",
                        },
                        inputStatus: {
                            required: "กรุณาเลือกสถานะ!",
                        },
                    },
                    errorElement: "span",
                    errorPlacement: function(error, element) {
                        error.addClass("invalid-feedback");
                        element.closest(".form-group").append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass("is-invalid");
                    },
                });
            });
        </script>
    <?php } ?>
<?php } ?>