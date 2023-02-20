<nav class="navbar navbar-expand-lg bg-light border-bottom border-3">
    <div class="container">
        <a class="navbar-brand" href="index">หน้าแรก</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        คณะ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        หมวดหมู่
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link mt-3 mt-md-0 mx-md-3" href="#">
                        <i class="fa-solid fa-comment"></i> แชท
                    </a>
                </li>
            </ul>
            <a class="nav-link mt-3 mt-md-0 mx-md-2" href="?page=profile">
                <span for="profileImage"><?= $user['fname']; ?><?= $user['lname']; ?></span>
                <?php if ($user['img_user'] != '') { ?>
                    <img src="img/user_img/<?= $user['img_user'] ?>" alt="Profile image" id="profileImage" class="img-fluid rounded-circle ms-2" style="width: auto; height: 3rem;">
                <?php } else { ?>
                    <img src="img/user.png" alt="Profile image" id="profileImage" class="img-fluid rounded-circle ms-2" style="width: auto; height: 3rem;">
                <?php } ?>
            </a>
            <a class="nav-link mt-3 mt-md-0 ms-md-4" href="php/action.php?action=logout">
                Logout
            </a>
        </div>
    </div>
</nav>