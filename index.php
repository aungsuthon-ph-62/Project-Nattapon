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

  <?php

  ?>
</head>

<body>


  <!-- ======= Header ======= -->
  <?php
  include_once 'assets/layout/navbar.php';
  include_once 'view/modal.php';
  ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="hero-animated" class="hero-animated d-flex align-items-center shadow-lg">
      <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out" data-aos-delay="7000">
        <img src="admin/assets/img/logo-horizon-removebg-preview.png" class="img-fluid animated" loading="lazy" width="100%" style="object-fit: cover;">
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container py-md-5" data-aos="fade-up" data-aos-delay="10000">

        <div class="row g-5">
          <div class="col-lg-8">
            <!-- Blog -->
            <?php $page = isset($_GET['page']) ? $_GET['page'] : '';
            if ($page) { ?>
              <?php
              switch ($page) {
                case "search":
                  include_once 'view/search.php';
                  break;
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

  <?php
  include_once 'admin/assets/alert.php';
  ?>

  <?php
  include_once 'view/modal.php';
  ?>


  <!-- ======= Footer ======= -->
  <?php include_once 'assets/layout/footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>



  <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
    <?php mysqli_free_result($fetchUser); ?>
  <?php } ?>

  <!-- Main JS File -->
  <script src="assets/js/main.js" defer></script>

  <script src="assets/js/delete_review.js" defer></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <script src="assets/vendor/aos/aos.js" defer></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js" defer></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js" defer></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js" defer></script>
</body>

</html>