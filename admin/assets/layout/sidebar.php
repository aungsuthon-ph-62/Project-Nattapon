<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../admin" class="brand-link">
        <img src="assets/img/user-gear.png" alt="user-gear" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ระบบจัดการหลังบ้าน</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if ($user['img_user'] != '') { ?>
                    <img src="../img/user_img/<?= $user['img_user'] ?>" class="img-circle elevation-2" alt="User Image">
                <?php } else { ?>
                    <img src="../img/user.png" class="img-circle elevation-2" alt="User Image">
                <?php } ?>
            </div>
            <div class="info">
                <a href="../admin?p=viewProfile" class="d-block"><?= $user['fname'] ?> <?= $user['lname'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../admin" class="nav-link <?php if (!isset($_GET['p'])) {
                                                            echo "active";
                                                        } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            แดชบอร์ด
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin?p=viewPost" class="nav-link <?php if (isset($_GET['p'])) {
                                                                        $p = $_GET['p'];
                                                                        if ($p == "viewPost") {
                                                                            echo "active";
                                                                        }
                                                                    } ?>">
                        <i class="nav-icon fa-solid fa-table-cells"></i>
                        <p>โพสต์</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin?p=viewReview" class="nav-link <?php if (isset($_GET['p'])) {
                                                                            $p = $_GET['p'];
                                                                            if ($p == "viewReview") {
                                                                                echo "active";
                                                                            }
                                                                        } ?>">
                        <i class="nav-icon fa-solid fa-comments"></i>
                        <p>จัดการรีวิว</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin?p=viewFaculty" class="nav-link <?php if (isset($_GET['p'])) {
                                                                            $p = $_GET['p'];
                                                                            if ($p == "viewFaculty") {
                                                                                echo "active";
                                                                            }
                                                                        } ?>">
                        <i class="nav-icon fa-solid fa-tag"></i>
                        <p>สาขาวิชา</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../admin?p=viewMember" class="nav-link <?php if (isset($_GET['p'])) {
                                                                        $p = $_GET['p'];
                                                                        if ($p == "viewMember") {
                                                                            echo "active";
                                                                        }
                                                                    } ?>">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            จัดการสมาชิก
                        </p>
                    </a>
                </li>
                <li class="nav-header">เมนูผู้ใช้งาน</li>
                <li class="nav-item">
                    <a href="../admin?p=viewProfile" class="nav-link <?php if (isset($_GET['p'])) {
                                                                            $p = $_GET['p'];
                                                                            if ($p == "viewProfile") {
                                                                                echo "active";
                                                                            }
                                                                        } ?>">
                        <i class="nav-icon text-info bi bi-person-fill"></i>
                        <p>
                            ข้อมูลส่วนตัว
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../php/action.php?action=logout" class="nav-link">
                        <i class="nav-icon text-danger bi bi-box-arrow-right"></i>
                        <p class="text">ออกจากระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>