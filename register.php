<?php require_once 'facebook/login.php'; ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?php
    include_once 'assets/layout/head.php';
    ?>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto  py-5">
                <div class="card border-0 shadow-lg rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">สมัครสมาชิก</h5>
                        <form action="php/action.php" method="post" autocomplete="on">
                            <input type="hidden" name="action" value="register">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputFname" name="inputFname" placeholder="กรอกชื่อจริง">
                                <label for="inputFname">ชื่อจริง</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputLname" name="inputLname" placeholder="กรอกนามสกุล">
                                <label for="inputLname">นามสกุล</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputStd_id" name="inputStd_id" placeholder="กรอกรหัสนักศึกษา">
                                <label for="inputStd_id">รหัสนักศึกษา</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputEmail" name="inputEmail" placeholder="กรอกอีเมลล์">
                                <label for="inputEmail">อีเมลล์</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน">
                                <label for="inputPassword">รหัสผ่าน</label>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold rounded-5" type="submit">
                                    สมัครสมาชิก
                                </button>
                            </div>
                            <hr class="my-4">
                            <div class="d-grid mb-2 px-5">
                                <a href="google_auth/redirect" class="btn btn-danger btn-login text-uppercase fw-bold">
                                    <i class="fab fa-google me-2"></i> เข้าสู่ระบบด้วย Google
                                </a>
                            </div>
                            <div class="d-grid px-5">
                                <a href="<?= $loginUrl ?>" class="btn btn-primary btn-login text-uppercase fw-bold">
                                    <i class="fab fa-facebook-f me-2"></i> เข้าสู่ระบบด้วย Facebook
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <?php
    include_once 'view/alert.php';
    ?>
</body>

</html>