<?php
session_start();
include_once 'layout/head.php';
?>

<body>
    <main class="vh-100" style="background-color: #42BDED;">
        <div class="container py-5 p-md-5 h-100">
            <div class="py-3 py-md-5">
                <div class="container py-5 p-md-5">
                    <div class="card bg-white border border-3 rounded-5 shadow">
                        <div class="card-header rounded-bottom rounded-5" style="background-color: #42BDED;">
                            <h1 class="text-center text-white">Register</h1>
                        </div>
                        <div class="card-body py-5 py-md-0 p-md-5">
                            <div class="container p-md-5 my-3 my-md-0">
                                <form class="px-md-5 py-3 py-md-0" action="php/action.php" method="post">
                                    <input type="hidden" name="action" value="register">
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="text" class="form-control" id="inputFname" name="inputFname" placeholder="กรอกชื่อจริง">
                                            <label for="inputFname"> ชื่อจริง</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="text" class="form-control" id="inputLname" name="inputLname" placeholder="กรอกนามสกุล">
                                            <label for="inputLname"> นามสกุล</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="text" class="form-control" id="inputStd_id" name="inputStd_id" placeholder="กรอกรหัสนักศึกษา">
                                            <label for="inputStd_id"> รหัสนักศึกษา</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="กรอกอีเมลล์">
                                            <label for="inputEmail"> อีเมลล์</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 px-md-5">
                                        <div class="form-floating col-12 mb-3 mb-md-4 ">
                                            <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="กรอกรหัสผ่าน" autocomplete="off">
                                            <label for="inputPassword"> รหัสผ่าน</label>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-lg text-light mx-2" style="background-color: #42BDED;">ยืนยัน</button>
                                        <a href="login.php" class="btn btn-danger btn-lg mx-2">ยกเลิก</a>
                                    </div>
                                </form>
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