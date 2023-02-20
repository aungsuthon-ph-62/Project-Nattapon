<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <base href="index">

    <title>ศูนย์ปฏิบัติการร่วมในการช่วยเหลือประชาชนขององค์กรปกครองส่วนท้องถิ่นอำเภอนาเยีย จังหวัดอุบลราชธานี</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="ศูนย์ปฏิบัติการร่วมในการช่วยเหลือประชาชนขององค์กรปกครองส่วนท้องถิ่นอำเภอนาเยีย จังหวัดอุบลราชธานี">
    <meta name="keywords" content="อำเภอนาเยีย, นาเยีย, องค์กรปกครองส่วนท้องถิ่น, ศูนย์ปฏิบัติการ">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo time(); ?>">

    <!-- Favicons -->
    <link href="../assets/img/ตรากรมส่งเสริมการปกครองท้องถิ่น.png" rel="icon">
    <!-- <link href="assets/img/favicon.ico" rel="icon"> -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,200;0,300;0,400;0,500;0,700;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <!-- jQuery -->

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,200;0,300;0,400;0,500;0,700;1,200;1,300;1,400;1,500;1,700&family=Noto+Sans+Thai:wght@300;400;700&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Prompt:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <!-- Font -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <script src="dist/js/adminlte.min.js"></script>
    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Font Awesome -->

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Sweet Alert -->
</head>


<body class="hold-transition login-page pt-5">
    <?php 
        include "assets/layout/preload.php";
    ?>
    <div class="login-box h-100 mt-5 pt-5">
        <div class="card shadow-lg">
            <div class="card-body login-card-body border border-success p-5">
                <div class="login-logo">
                    <a href="login">
                        <img src="../assets/img/ตรากรมส่งเสริมการปกครองท้องถิ่น.png" alt="Logo-Brand" class="img-fluid">
                    </a>
                </div>
                <p class="login-box-msg h5 text-dark">Admin - Dashboard</p>
                <form action="php/action.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control border-top-0 border-left-0 border-right-0" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text border-top-0 border-left-0 border-right-0">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control border-top-0 border-left-0 border-right-0" name="password" placeholder="Password" autocomplete="on">
                        <div class="input-group-append">
                            <div class="input-group-text border-top-0 border-left-0 border-right-0">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn bg-gradient-success btn-lg btn-block shadow rounded-pill">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>