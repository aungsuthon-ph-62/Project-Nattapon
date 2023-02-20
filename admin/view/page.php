<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<?php if (!$_SESSION['id'] || !$_SESSION['role']) {
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อน";
    header('location: ../login.php');
    exit;
?>
<?php } else {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    if ($role == 'Member') {
        header("Location: ../index.php");
        exit;
    }

    require_once "../php/conn.php";

    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

function DateThai($strDate)

{

    $strYear = date("Y", strtotime($strDate)) + 543;

    $strMonth = date("n", strtotime($strDate));

    $strDay = date("j", strtotime($strDate));

    $strHour = date("H", strtotime($strDate));

    $strMinute = date("i", strtotime($strDate));

    $strSeconds = date("s", strtotime($strDate));

    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

    $strMonthThai = $strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
}
?>

<head>
    <?php include_once "../assets/layout/head.php"; ?>

    <style>
        <?php include "../assets/css/main.css"; ?>
    </style>

    <!-- Data table -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select 2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Summer note -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php include_once "../assets/layout/preload.php"; ?>
        <?php include_once "../view/alert.php"; ?>

        <!-- Navbar -->
        <?php include_once "../assets/layout/navbar.php"; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once "../assets/layout/sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php
            $p = isset($_GET['p']);
            switch ($p) {
                case "addPost":
                    include_once 'post/addPost.php';
                    break;
                case "viewPost":
                    include_once 'post/viewPost.php';
                    break;
                default:
                    echo "<script> window.location.href='../admin';</script>";
            }
            ?>
            <!-- /.content-wrapper -->
        </div>
        <?php include_once "../assets/layout/footer.php"; ?>

        <!-- <script src="assets/js/headfnc.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
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

        <!-- JS Validation -->
        <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="plugins/jquery-validation/additional-methods.min.js"></script>
        <script src="assets/js/postValidation.js"></script>

        <!-- Select2 -->
        <script src="plugins/select2/js/select2.full.min.js"></script>

        <!-- Summernote -->
        <script src="plugins/summernote/summernote-bs4.min.js"></script>
        <script src="assets/js/summernote.js"></script>



        <?php
        $conn->close();
        ?>
    </div>
</body>

</html>