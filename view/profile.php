<main>
    <div class="container px-md-5 py-5 py-md-3">
        <div class="card mb-3" style="border-style: solid; border-color: #42BDED; border-width: medium;">
            <div class="card-body">
                <div class="row px-md-3">
                    <div class="col-md-4 bg-light p-5">
                        <?php if ($user['img_user'] != '') { ?>
                            <img src="img/user_img/<?= $user['img_user'] ?>" class="img-thumbnail border-0 bg-light" alt="User profile image">
                        <?php } else { ?>
                            <img src="img/user.png" class="img-thumbnail border-0 bg-light" alt="User profile image">
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <div class="container">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                ชื่อจริง
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted">
                                                <?= $user['fname']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                นามสกุล
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted">
                                                <?= $user['lname']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                รหัสนักศึกษา
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted">
                                                <?= $user['std_no']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                อีเมลล์
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted">
                                                <?= $user['email']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="fw-bold">
                                                สถานะ
                                            </p>
                                        </div>
                                        <div class="col-8">
                                            <h6 class="text-muted">
                                                <?= $user['status']; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfile">แก้ไขโปรไฟล์</button>
                            <button type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#changePassword">เปลี่ยนรหัสผ่าน</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>
            โพสต์ทั้งหมดของฉัน
        </h3>
        <!-- <div class="card mb-3 p-3" style="border-style: solid; border-color: #42BDED; border-width: medium;">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead> -->
        <!-- <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr> -->
        <!-- </thead>
                    <tbody class="table-group-divider"> -->
        <!-- <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr> -->
        <!-- <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr> -->
        <!-- </tbody>
                </table>
            </div>
        </div> -->
    </div>
</main>