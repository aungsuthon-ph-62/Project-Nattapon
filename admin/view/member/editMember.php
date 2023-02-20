<?php if (isset($_GET['p']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="bi bi-pencil-square"></i> แก้ไขสมาชิก</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="../admin?p=viewMember">สมาชิก</a></li>
                        <li class="breadcrumb-item active">แก้ไขสมาชิก</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-info-circle-fill"></i> รายละเอียด </h3>
                        </div>
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

                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-success rounded-pill float-right float-md-left"><i class="fa-solid fa-check"></i> ยืนยัน</button>
                                <button type="reset" class="btn bg-gradient-warning rounded-pill float-left float-md-right"><i class="fa-solid fa-arrow-rotate-left"></i> รีเซ็ท</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
<?php } else {
    echo "<script> window.location.href='../admin';</script>";
} ?>