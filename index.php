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

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs p-0">
      <div class="container w-50" data-aos="zoom-in" delay="7000">
        <a href="index" class="logo d-flex align-items-center justify-content-center">
          <img src="admin/assets/img/logo-horizon.jpg" class="img-fluid" alt="Logo">
          <!-- <h1>Logo<span>.</span></h1> -->
        </a>
      </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <!-- Blog -->
            <?php $page = isset($_GET['page']) ? $_GET['page'] : '';
            if ($page) { ?>
              <?php
              switch ($page) {
                case "post-detail":
                  include_once 'view/post-details.php';
                  break;
                default:
                  include_once 'view/blog.php';
              }
              ?>
            <?php } else { ?>
              <?php include_once 'view/blog.php'; ?>
            <?php } ?>
            <!-- End Blog -->

          </div>

          <div class="col-lg-4">

            <!-- ฺBlog Sidebar -->
            <?php include_once 'assets/layout/sidebar.php'; ?>
            <!-- End Blog Sidebar -->

          </div>

        </div>

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

  <!-- Comment -->
  <script src="assets/js/comment.js"></script>

  <?php
  include_once 'admin/assets/alert.php';
  ?>

  <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
    <?php mysqli_free_result($fetchUser); ?>
  <?php } ?>
  <?php mysqli_free_result($queryProv); ?>
  <?php mysqli_free_result($countComment); ?>
  <?php mysqli_free_result($catFaculty); ?>
  <?php mysqli_free_result($catProvinces); ?>
  <?php mysqli_free_result($post); ?>

</body>

</html>