<?php
session_start();
?>

<?php if (!$_SESSION['id'] || !$_SESSION['role']) {
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบก่อน";
    header('location: login');
    exit;
?>
<?php } else {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    if ($role == 'Admin') {
        header("Location: admin");
        exit;
    }

    require_once "php/conn.php";

    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
?>
    <?php
    include_once 'layout/head.php';
    include_once 'view/modal.php';
    ?>
    <style>
        <?php include "css/style.css"; ?>
    </style>

    <body>
        <?php
        include_once 'layout/navbar.php';
        ?>
        <section style="background-color: #5BD1FF;">
            <div class="container py-3 px-5">
                <form class="d-flex" role="search">
                    <input class="form-control me-2 form-control-lg shadow" type="search" placeholder="ค้นหา" aria-label="Search">
                    <button class="btn text-white me-2 shadow" type="submit" style="background-color: #00B7FE;">ค้นหา</button>
                </form>
            </div>
        </section>

        <?php $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($page) { ?>
            <?php
            switch ($page) {
                case "postDetail":
                    include_once 'view/postDetail.php';
                    break;
                case "profile":
                    include_once 'view/profile.php';
                    break;
                default:
                    include_once 'view/home.php';
            }
            ?>
        <?php } else { ?>
            <?php include_once 'view/home.php'; ?>
        <?php } ?>


        <?php
        include_once 'layout/footer.php';
        include_once 'view/alert.php';
        ?>
        <?php mysqli_free_result($result); mysqli_close($conn);  ?>
    </body>

    </html>
<?php } ?>