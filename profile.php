<!DOCTYPE html>
<html lang="th">

<head>
    <?php
    session_start();
    require_once 'php/conn.php';
    require_once 'php/fetch.php';
    require_once 'php/count.php';
    require_once 'admin/php/dateThai.fnc.php';
    require_once 'php/dateThaiTime.fnc.php';


    if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];

        if ($role == 'Admin') {
            header("Location: admin");
            exit;
        }

        $fetchUser = fetchUser($conn, $id);
        $user = mysqli_fetch_assoc($fetchUser);
    }
    ?>
    <?php
    include_once 'assets/layout/head.php';
    ?>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php
    include_once 'assets/layout/navbar.php';
    ?>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Hero ======= -->
        <section id="hero-animated" class="hero-animated d-flex align-items-center shadow-lg">
            <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out" data-aos-delay="7000">
                <img src="admin/assets/img/logo-horizon-removebg-preview.png" class="img-fluid animated">
            </div>
        </section>
        <!-- End Hero -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">
                <!-- ======= About Section ======= -->
                <section id="about" class="about">
                    <div class="container" data-aos="fade-up">

                        <div class="section-header">
                            <h2 class="fw-bold">ข้อมูลผู้ใช้</h2>
                        </div>

                        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="2000">

                            <div class="col-lg-5">
                                <div class="about-img">
                                    <img src="img/user_img/<?= $user['img_user'] ?>" id='previewImg' class="img-fluid img-thumbnail border-0 rounded-5 shadow-lg" alt="<?= $user['img_user'] ?>" data-aos="fade-in" data-aos-delay="10000">
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <!-- Tabs -->
                                <ul class="nav nav-pills mb-3">
                                    <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">ข้อมูลส่วนตัว</a></li>
                                    <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">แก้ไขข้อมูลส่วนตัว</a></li>
                                </ul><!-- End Tabs -->

                                <!-- Tab Content -->
                                <div class="tab-content" id="tabContent">
                                    <div class="tab-pane fade show active" id="tab1">
                                        <div class="info">
                                            <div class="info-item d-flex align-items-center mt-4">
                                                <i class="bi bi-person-fill"></i>
                                                <h4>ชื่อจริง - นามสกุล</h4>
                                            </div>
                                            <p><?= $user['fname'] ?> <?= $user['lname'] ?></p>

                                            <div class="info-item d-flex align-items-center mt-4">
                                                <i class="bi bi-person-vcard"></i>
                                                <h4>รหัสนักศึกษา</h4>
                                            </div>
                                            <p><?= $user['std_no'] ?></p>

                                            <div class="info-item d-flex align-items-center mt-4">
                                                <i class="bi bi-envelope-at-fill"></i>
                                                <h4>อีเมลล์</h4>
                                            </div>
                                            <p><?= $user['email'] ?></p>

                                            <div class="info-item d-flex align-items-center mt-4">
                                                <i class="bi bi-calendar2-date-fill"></i>
                                                <h4>สมัครสมาชิกเมื่อ</h4>
                                            </div>
                                            <p><?= DateThai($user['reg_date']) ?></p>

                                            <div class="info-item d-flex align-items-center mt-4">
                                                <i class="bi bi-globe"></i>
                                                <h4>สถานะ</h4>
                                            </div>
                                            <p><?= $user['status'] ?></p>
                                        </div>
                                    </div><!-- End Tab 1 Content -->

                                    <div class="tab-pane fade show" id="tab2">
                                        <div class="container px-md-5 shadow rounded-4">
                                            <form class="px-md-3 py-5" id="postForm" action="php/action.php" method="post" enctype="multipart/form-data" autocomplete="off">
                                                <input type="hidden" name="action" value="editMember">
                                                <input type="hidden" name="oldImage" value="<?= $user['img_user'] ?>">
                                                <input type="hidden" name="uid" value="<?= $user['id'] ?>">
                                                <input type="hidden" name="oldPassword" value="<?= $user['pass'] ?>">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">แก้ไขรูปภาพส่วนตัว</label>
                                                    <input class="form-control rounded-5 border border-2 border-secondary" type="file" id="inputImage" name="inputImage" accept='image/gif, image/jpeg, image/png, image/jpg'>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputFname" name="inputFname" value="<?= $user['fname'] ?>">
                                                            <label for="floatingInput">ชื่อจริง</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputLname" name="inputLname" value="<?= $user['lname'] ?>">
                                                            <label for="floatingInput">นามสกุล</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control border-bottom border-top-0 border-start-0 border-end-0 rounded-0" name="inputStdID" value="<?= $user['std_no'] ?>">
                                                        <label for="floatingInput">รหัสนักศึกษา</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputEmail" name="inputEmail" value="<?= $user['email'] ?>">
                                                        <label for="floatingInput">อีเมลล์</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control border-bottom border-top-0 border-start-0 border-end-0 rounded-0" id="inputPassword" name="inputPassword" placeholder="กรอกพาสเวิร์ดใหม่ที่นี่">
                                                        <label for="floatingInput">รหัสผ่านใหม่</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary rounded-pill"><i class="bi bi-check-lg m-0 text-light"></i> ยืนยัน</button>
                                            </form>
                                        </div>
                                    </div><!-- End Tab 2 Content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- End About Section -->
            </div>

        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include_once 'assets/layout/footer.php'; ?>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <!-- JS Validation -->
    <script src="admin/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="assets/js/editProfile.js"></script>


    <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
        <?php mysqli_free_result($fetchUser); ?>
    <?php } ?>

    <?php
    include_once 'admin/assets/alert.php';
    ?>
</body>

</html>