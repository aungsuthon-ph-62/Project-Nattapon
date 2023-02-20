<!-- Post modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">โพสต์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-3 px-md-5 py-3 py-md-3">

                <form action="php/action.php" method='post' enctype='multipart/form-data'>
                    <input type="hidden" name="action" value="uploadImg">
                    <div class='mb-3'>
                        <div class="modal-body px-3 px-md-5 py-3 py-md-3">
                            <div class="p-5 px-md-5 py-md-3 mb-3" style="background-color: #D9D9D9;">
                                <img src="img/image.png" id='previewImg' class='img-fluid rounded'>
                            </div>
                        </div>
                        <label for="image" class='form-label'>Image</label>
                        <input type="file" multiple='multiple' accept='image/gif, image/jpeg, image/png' id='imgInput' name='post_image' class='form-control streched-link'>
                    </div>

                    <input type="hidden" name="action" value="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="inputname" name="inputname" placeholder="ชื่อบริษัท">
                        <label for="inputname"> ชื่อบริษัท </label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="inputaddress" name="inputaddress" placeholder="กรอกที่อยู่">
                        <label for="inputaddress"> ที่อยู่ </label>
                    </div>

                    <input type="hidden" name="userid" value="userid">
                    <div class="form-floating mb-3">
                        <input type="hidden" class="form-control shadow" id="userid" name="userid" value="<?= $user['id'] ?>">

                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-danger mx-3 mb-3" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary mx-3 mb-3" name="submit">ยืนยัน</button>
                    </div>

                </form>
            </div>

            <script>
                let imgInput = document.querySelector('#imgInput');
                let previewImg = document.querySelector('#previewImg');

                imgInput.onchange = evt => {
                    const [file] = imgInput.files;
                    if (file) {
                        previewImg.src = URL.createObjectURL(file);
                    }
                }
            </script>

        </div>
    </div>
</div>

<!-- Edit profile modal -->
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">แก้ไขโปรไฟล์</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3 px-md-5 py-3 py-md-3">
                <form action="php/action.php" method="post">
                    <input type="hidden" name="action" value="editProfile">
                    <div class="p-5 px-md-5 py-md-3 mb-3" style="background-color: #D9D9D9;">
                        <img src="img/user.png" class="img-thumbnail" alt="User profile image">
                        <p class="text-center m-0">เพิ่มรูปภาพ</p>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="editFname" name="editFname" value="<?= $user['fname'] ?>">
                        <label for="editFname"> ชื่อจริง</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="editLname" name="editLname" value="<?= $user['lname'] ?>">
                        <label for="editLname"> นามสกุล</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="editStd_id" name="editStd_id" value="<?= $user['std_no'] ?>">
                        <label for="editStd_id"> รหัสนักศึกษา</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control shadow" id="editEmail" name="editEmail" value="<?= $user['fname'] ?>">
                        <label for="editEmail"> อีเมลล์</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-danger mx-3">ยกเลิก</button>
                        <button type="button" class="btn btn-primary mx-3" data-bs-dismiss="modal">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change passwrod modal -->
<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3 px-md-5 py-3 py-md-3">
                <form action="php/action.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control shadow" id="changeStd_id" name="changeStd_id" placeholder="กรุณากรอกรหัสนักศึกษาเพื่อยืนยัน">
                        <label for="changeStd_id"> กรุณากรอกรหัสนักศึกษาเพื่อยืนยัน</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control shadow" id="changePassword" name="changePassword" placeholder="รหัสผ่านใหม่" autocomplete="off">
                        <label for="changePassword"> รหัสผ่านใหม่</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-danger mx-3">ยกเลิก</button>
                        <button type="button" class="btn btn-primary mx-3" data-bs-dismiss="modal">ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>