<?php
session_start();
require_once "php/conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    header("Location: index");
    exit;
}

?>

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
                <div class="card border-0 shadow-lg rounded-3 my-5 py-5">
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">เข้าสู่ระบบ</h5>
                        <form action="php/action.php" method="post" autocomplete="on">
                            <input type="hidden" name="action" value="login">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputEmail" name="inputEmail" placeholder="กรอกอีเมลล์">
                                <label for="inputEmail">อีเมลล์</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control border-2 border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน">
                                <label for="inputPassword">รหัสผ่าน</label>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-primary btn-login text-uppercase fw-bold rounded-5" type="submit">
                                    เข้าสู่ระบบ
                                </button>
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3">
                                <p class="m-0">หากยังเคยสมัครสมาชิก - <a href="register">คลิ๊กที่นี่!</a></p>
                            </div>
                            <hr class="my-3">
                            <div class="d-grid mt-5 mb-2 px-md-5">
                                <a href="google_auth/redirect" class="btn btn-danger btn-login text-uppercase fw-bold">
                                    <i class="fab fa-google me-2"></i> เข้าสู่ระบบด้วย Google
                                </a>
                            </div>
                            <div class="d-grid px-5">
                                <a href="<?php echo htmlspecialchars($fb_login_url); ?>" class="btn btn-primary btn-login text-uppercase fw-bold">
                                    <i class="fab fa-facebook-f me-2"></i> Log in with Facebook
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