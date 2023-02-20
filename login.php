<?php
session_start();
include_once 'layout/head.php';
include_once 'view/modal.php';
?>

<body>
    <main class="vh-100" style="background-color: #42BDED;">
        <div class="container py-5 p-md-5 h-100">
            <div class="py-3 py-md-5">
                <div class="container py-5 p-md-5">
                    <div class="card bg-white border border-3 rounded-5 shadow position-relative">
                        <img src="img/user.png" alt="" class="img-fluid position-absolute translate-middle start-50" style="width: auto; height: 13rem;">
                        <div class="card-body py-5 py-md-0 p-md-5 mt-5 mt-md-5">
                            <h1 class="text-center fw-light my-4 my-md-0">Login</h1>
                            <div class="container p-md-5 my-3 my-md-0">
                                <form class="px-md-5 py-3 py-md-0" action="php/action.php" method="post">
                                    <input type="hidden" name="action" value="login">
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="text" class="form-control shadow" id="inputEmail" name="inputEmail" placeholder="กรอกชื่อผู้ใช้">
                                            <label for="inputEmail"> อีเมลล์</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="password" class="form-control shadow" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" autocomplete="on">
                                            <label for="inputPassword"> รหัสผ่าน</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5 text-end">
                                        <a role='button' class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#changePassword">ลืมรหัสผ่าน ?</a>
                                    </div>
                                    <div class="d-grid gap-2 px-md-5">
                                        <button type="submit" class="btn btn-lg text-light" style="background-color: #42BDED;">เข้าสู่ระบบ</button>
                                    </div>
                                </form>
                                <div class="mt-3 px-md-5 text-center">
                                    <a href="register.php" class="text-decoration-none h5">ลงทะเบียน</a>
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    <a href="forgot_password.php" class="btn btn-danger btn-lg mx-2"><i class="fa-brands fa-google-plus-g"></i></a>
                                    <a href="forgot_password.php" class="btn btn-primary btn-lg mx-2"><i class="fa-brands fa-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php 
        include_once 'view/alert.php';
    ?>
</body>

</html>