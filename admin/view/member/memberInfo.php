<?php if (isset($_GET['p']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT * FROM user WHERE std_no = $id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="bi bi-info-circle-fill"></i> ข้อมูลสมาชิก</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="../admin?p=viewMember">สมาชิก</a></li>
                        <li class="breadcrumb-item active">ข้อมูลสมาชิก</li>
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
                            <h3 class="card-title"><i class="bi bi-info-circle-fill"></i> รายละเอียด</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">รูปภาพส่วนตัว</label>
                                    <div class="p-md-5">
                                        <a href="../img/user_img/<?= $user['img_user'] ?>" target="_blank">
                                            <?php if ($user['img_user'] == "") { ?>
                                                <img src="../img/user.png" id='previewImg' class='img-thumbnail rounded-lg w-25'>
                                            <?php } else { ?>
                                                <img src="../img/user_img/<?= $user['img_user'] ?>" id='previewImg' class='img-thumbnail rounded-lg w-25'>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFname">ชื่อจริง</label>
                                        <input type="text" class="form-control" id="inputFname" name="inputFname" value="<?= $user['fname'] ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputLname">นามสกุล</label>
                                        <input type="text" class="form-control" id="inputLname" name="inputLname" value="<?= $user['lname'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputStdID">รหัสนักศึกษา</label>
                                    <input class="form-control" id="inputStdID" name="inputStdID" value="<?= $user['std_no'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">อีเมลล์</label>
                                    <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?= $user['email'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">สถานะ</label>
                                    <select id="inputStatus" class="form-control" id="inputStatus" name="inputStatus" disabled>
                                        <option class="bg-gradient-success" value="<?= $user['status'] ?>" selected><?= $user['status'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="../admin?p=viewMember" class="btn bg-gradient-warning rounded-pill float-right float-md-left"><i class="bi bi-arrow-left"></i> ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else {
    echo "<script> window.location.href='../admin';</script>";
} ?>