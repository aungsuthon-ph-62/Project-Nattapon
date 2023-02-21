<?php
session_start();
?>

<?php if (!$_SESSION['id'] || !$_SESSION['role']) {
  $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อน";
  header('location: ../login');
  exit;
?>
<?php } else {
  $id = $_SESSION['id'];
  $role = $_SESSION['role'];

  if ($role == 'Member') {
    echo "<script> window.location.href='../index';</script>";
    exit;
  }

  require_once "php/conn.php";

  $query = "SELECT * FROM user WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
}

require_once "php/dateThai.fnc.php";
require_once "php/count/countPost.php";
require_once "php/count/countMember.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "assets/layout/head.php"; ?>

  <style>
    <?php include "assets/css/main.css"; ?>
  </style>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>

  <?php $p = isset($_GET['p']) ? $_GET['p'] : ''; {
    if ($p == "addPost" || $p == "editPost" || $p == "postInfo") { ?>
      <!-- Select 2 -->
      <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
      <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
      <!-- Summer note -->
      <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <?php } else { ?>
      <!-- Data table -->
      <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <?php } ?>
  <?php } ?>

  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include_once "view/alert.php"; ?>


  <div class="wrapper">

    <!-- Preloader -->
    <?php include_once "assets/layout/navbar.php"; ?>

    <!-- Navbar -->
    <?php include_once "assets/alert.php"; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once "assets/layout/sidebar.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $p = isset($_GET['p']) ? $_GET['p'] : '';
      if ($p) { ?>
        <?php
        switch ($p) {
          case "viewProfile":
            include_once 'view/profile/viewProfile.php';
            break;
          case "editFaculty":
            include_once 'view/faculty/editFaculty.php';
            break;
          case "addfaculty":
            include_once 'view/faculty/addFaculty.php';
            break;
          case "facultyInfo":
            include_once 'view/faculty/facultyInfo.php';
            break;
          case "viewFaculty":
            include_once 'view/faculty/viewFaculty.php';
            break;
          case "editMember":
            include_once 'view/member/editMember.php';
            break;
          case "addMember":
            include_once 'view/member/addMember.php';
            break;
          case "memberInfo":
            include_once 'view/member/memberInfo.php';
            break;
          case "viewMember":
            include_once 'view/member/viewMember.php';
            break;
          case "editPost":
            include_once 'view/post/editPost.php';
            break;
          case "addPost":
            include_once 'view/post/addPost.php';
            break;
          case "postInfo":
            include_once 'view/post/postInfo.php';
            break;
          case "viewPost":
            include_once 'view/post/viewPost.php';
            break;
          default:
            include_once 'view/dashboard.php';
        }
        ?>

      <?php } else { ?>
        <?php include_once 'view/dashboard.php'; ?>
      <?php } ?>
      <!-- /.content-wrapper -->
    </div>
    <?php include_once "assets/layout/footer.php"; ?>

    <!-- <script src="assets/js/headfnc.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>

    <?php $p = isset($_GET['p']) ? $_GET['p'] : ''; {
      if ($p == "addPost" || $p == "editPost" || $p == "postInfo") { ?>
        <!-- Select2 -->
        <script src="plugins/select2/js/select2.full.min.js"></script>
        <script src="assets/js/selected2.js"></script>
        <!-- JS Validation -->
        <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- Summernote -->
        <script src="plugins/summernote/summernote-bs4.min.js"></script>
        <script src="assets/js/summernote.js"></script>
      <?php } elseif ($p == "addMember" || $p == "editMember" || $p == "addFaculty" || $p == "editFaculty" || $p = "viewProfile") { ?>
        <!-- JS Validation -->
        <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="plugins/jquery-validation/additional-methods.min.js"></script>
      <?php } ?>
    <?php } ?>

    <!-- Datatable -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/js/datatable.js"></script>
    <!-- Dashboard -->
    <script src="dist/js/pages/dashboard.js"></script>

    <script>
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn bg-gradient-success rounded-pill mx-3",
          cancelButton: "btn bg-gradient-danger rounded-pill mx-3",
        },
        buttonsStyling: false,
      });
    </script>





    <?php

    $conn->close();
    ?>
  </div>


  <!-- <script>
    $(document).bind("contextmenu", function(e) {
      e.preventDefault();
    });
    $(document).keydown(function(event) {
      if (event.keyCode == 123) {
        return false; //Prevent from F12
      } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
        return false; //Prevent from ctrl+shift+i
      }
    });
  </script> -->
</body>

</html>