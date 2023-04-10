<header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

        <a href="index" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
            <img src="admin/assets/img/logo-nobg.png" alt="Logo" loading="lazy">
            <!-- <h1>Logo<span>.</span></h1> -->
        </a>

        <nav id="navbar" class="navbar">
            <ul>

                <li><a class="nav-link active" href="index">หน้าหลัก</a></li>

                <li class="dropdown "><a href="#"><span>หมวดหมู่คณะ</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul class="shadow">
                        <?php
                        $catFaculty = fetchCatFaculty($conn);
                        $catFacultyCount = mysqli_num_rows($catFaculty);
                        ?>
                        <?php if ($catFacultyCount > 0) { ?>
                            <?php foreach ($catFaculty as $row) { ?>
                                <li><a href="?page=search&search=<?= $row['faculty_name'] ?>"><?= $row['faculty_name'] ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="text-center py-5">
                                <h3>ยังไม่มีรายการ</h3>
                            </div>
                        <?php } ?>
                    </ul>
                </li>

                <li class="dropdown "><a href="#"><span>หมวดหมู่จังหวัด</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                    <ul class="shadow">
                        <?php
                        require_once "admin/assets/vendor/province-db/conn.php";
                        $provSql = "SELECT * FROM provinces ORDER BY name_th ASC";
                        $queryProv = mysqli_query($connProvinces, $provSql) or die("database error:" . mysqli_error($connProvinces));
                        $catProCount = mysqli_num_rows($queryProv);
                        ?>
                        <?php if ($catProCount > 0) { ?>
                            <?php foreach ($queryProv as $row) { ?>
                                <li><a href="?page=search&search=<?= $row['name_th'] ?>"><?= $row['name_th'] ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="text-center py-5">
                                <h3>ยังไม่มีรายการ</h3>
                            </div>
                        <?php } ?>
                    </ul>
                </li>

                <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
                    <li><a href="chat/users" target="_blank"><span><i class="fa-solid fa-message"></i> แชท</span></a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
                    <div class="d-block d-md-none">
                        <li><a class="nav-link" href="index">ข้อมูลผู้ใช้</a></li>
                        <li><a class="nav-link" href="index">ออกจากระบบ</a></li>
                    </div>
                <?php } else { ?>
                    <div class="d-block d-md-none">
                        <li><a class="nav-link" href="login">เข้าสู่ระบบ</a></li>
                    </div>
                <?php } ?>
            </ul>

            <i class="bi bi-list mobile-nav-toggle d-none"></i>
        </nav><!-- .navbar -->

        <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
            <div class="d-md-block d-none">
                <div class="btn-group">
                    <a href="profile" class="me-auto mb-2 p-1">
                        <div class="d-flex align-items-center">
                            <?php if ($user['img_user'] == '') { ?>
                                <div class="me-2"><img class="rounded-circle" src="img/user.png" alt="User image" style="width: 50px; object-fit:cover;" loading="lazy" loading="lazy"></div>
                            <?php } else { ?>
                                <div class="me-2"><img class="rounded-circle" src="img/user_img/<?= $user['img_user']; ?>" alt="<?= $user['img_user']; ?>" style="width: 50px;" loading="lazy"></div>
                            <?php } ?>
                            <div class="me-auto">
                                <?= $user['fname']; ?> <?= $user['lname']; ?>
                            </div>
                        </div>
                    </a>
                    <button type="button" class="btn text-dark border-0 rounded-5 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">ข้อมูลผู้ใช้</span>
                    </button>
                    <ul class="dropdown-menu border-0 shadow-lg">
                        <li><a class="dropdown-item" href="profile"><i class="bi bi-person-vcard-fill text-primary"></i> ข้อมูลผู้ใช้</a></li>
                        <li class="px-3">
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="php/action.php?action=logout&id=<?= $user['id']; ?>"><i class="fa-solid fa-right-from-bracket text-danger"></i> ออกจากระบบ</a></li>
                    </ul>
                </div>
            </div>
        <?php } else { ?>
            <a class="btn-getstarted rounded-pill" href="login">เข้าสู่ระบบ</a>
        <?php } ?>

    </div>
</header>