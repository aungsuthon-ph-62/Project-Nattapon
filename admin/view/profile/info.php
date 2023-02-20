<div class="card card-success card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle border-0" src="../img/user_img/<?= $user['img_user'] ?>" alt="<?= $user['img_user'] ?>">
        </div>
        <h3 class="profile-username text-center"><?= $user['fname'] ?> <?= $user['lname'] ?></h3>
        <p class="text-center bg-gradient-success mx-md-5 rounded-pill"><?= $user['status'] ?></p>
        <div class="card card-dark shadow">
            <div class="card-header">
                <h3 class="card-title">เกี่ยวกับฉัน</h3>
            </div>

            <div class="card-body">
                <strong><i class="fa-solid fa-id-card mr-1"></i> รหัสนักศึกษา</strong>
                <p class="text-muted"><?= $user['std_no'] ?></p>
                <hr>
                <strong><i class="fa-solid fa-envelope mr-1"></i> อีเมลล์</strong>
                <p class="text-muted">
                <?= $user['email'] ?>
                </p>
                <hr>
            </div>

        </div>
    </div>

</div>