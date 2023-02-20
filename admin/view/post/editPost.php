<?php if (isset($_GET['p']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref,
    u.fname, u.lname
    FROM post_tbl as p 
    INNER JOIN user as u ON u.id = p.post_by 
    ORDER BY p.id = '$id'";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    require_once "php/fetchFaculty.php";
    $faculty = faculty($conn, $post['faculty_ref']);

    require_once "php/fetchProvinces.php";
    $provinces = provinces($conn, $post['provinces_ref']);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="bi bi-pencil-square"></i> แก้ไขโพสต์</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="../admin?p=viewPost">โพสต์</a></li>
                        <li class="breadcrumb-item active">แก้ไขโพสต์</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-info-circle-fill"></i> รายละเอียด</h3>
                        </div>
                        <form id="postForm" action="php/action.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="editPost">
                            <input type="hidden" name="pid" value="<?php echo $post['id'] ?>">
                            <input type="hidden" name="uid" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="oldBanner" value="<?php echo $post['post_banner'] ?>">
                            <input type="hidden" name="provinces" value="<?php echo $post['provinces_ref'] ?>">
                            <input type="hidden" name="faculty" value="<?php echo $post['faculty_ref'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php
                                    if ($post['post_banner'] == "") { ?>
                                        <label for="exampleInputFile"><i class="fa-solid fa-image"></i> รูปภาพหน้าปก</label>
                                        <div class="d-none d-md-block">
                                            <img src="assets/img/out-of-stock.png" class='img-thumbnail rounded-lg' style="width: 30%;">
                                        </div>
                                        <div class="d-block d-md-none">
                                            <img src="assets/img/out-of-stock.png" class='img-thumbnail rounded-lg' style="width: 70%;">
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text rounded-pill" id="basic-addon1">ไม่มีไฟล์ภาพ</span>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <label for="exampleInputFile"><i class="fa-solid fa-image"></i> รูปภาพหน้าปก</label>
                                        <div class="d-none d-md-block">
                                            <img src="assets/img/postBanner/<?= $post['post_banner'] ?>" class='img-thumbnail rounded-lg' style="width: 30%;">
                                        </div>
                                        <div class="d-block d-md-none">
                                            <img src="assets/img/postBanner/<?= $post['post_banner'] ?>" class='img-thumbnail rounded-lg' style="width: 70%;">
                                        </div>
                                    <?php } ?>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="postBanner" name="postBanner" accept='image/gif, image/jpeg, image/png, image/jpg' value="<?= $post['post_banner'] ?>">
                                            <label class="custom-file-label" for="postBanner">แก้ไขรูปภาพที่นี่</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="postOffice"><i class="fa-solid fa-building"></i> ชื่อบริษัท</label>
                                    <input type="text" name="postOffice" class="form-control" id="postOffice" value="<?= $post['post_topic'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="postAddress"><i class="fa-solid fa-location-dot"></i> ที่อยู่บริษัท</label>
                                    <textarea class="form-control" name="postAddress" id="postAddress" rows="10"><?= $post['post_address'] ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postProvinces"><i class="fa-solid fa-tags"></i> หมวดหมู่ (จังหวัด)</label>
                                            <div class="select2-success">
                                                <?php
                                                $provincesArray = [];

                                                foreach ($provinces as $provincesRow) {
                                                    $provincesArray[] = $provincesRow['cp_name'];
                                                }
                                                ?>
                                                <select class="select2" multiple="multiple" style="width: 100%;" id="postProvinces" name="postProvinces[]">
                                                    <?php
                                                    require_once "assets/vendor/province-db/conn.php";
                                                    $provSql = "SELECT * FROM provinces";
                                                    $queryProv = mysqli_query($connProvinces, $provSql);
                                                    ?>
                                                    <?php foreach ($queryProv as $rowPro) {
                                                    ?>
                                                        <option value="<?= $rowPro['name_th'] ?>" <?= in_array($rowPro['name_th'], $provincesArray) ? 'selected' : '' ?>>
                                                            <?= $rowPro['name_th'] ?>
                                                        </option>
                                                    <?php }
                                                    mysqli_free_result($queryProv); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postFaculty"><i class="fa-solid fa-tags"></i> หมวดหมู่ (สาขาวิชา)</label>
                                            <div class="select2-success">
                                                <?php
                                                $facultyArray = [];

                                                foreach ($faculty as $facultyRow) {
                                                    $facultyArray[] = $facultyRow['cf_name'];
                                                }
                                                ?>
                                                <select class="select2 " multiple="multiple" style="width: 100%;" id="postFaculty" name="postFaculty[]">
                                                    <?php
                                                    require_once "php/conn.php";
                                                    $facsql = "SELECT * FROM faculty";
                                                    $facQ = mysqli_query($conn, $facsql);
                                                    ?>
                                                    <?php foreach ($facQ as $rowFac) { ?>
                                                        <option value="<?= $rowFac['id'] ?>" <?= in_array($rowFac['id'], $facultyArray) ? 'selected' : '' ?>>
                                                            <?= $rowFac['faculty_name'] ?></option>
                                                    <?php }
                                                    mysqli_free_result($facQ); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><i class="fa-solid fa-circle-info"></i> รายละเอียด</label>
                                    <textarea id="summernote" name="postContent" class="form-control"><?= $post['post_content'] ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn bg-gradient-success rounded-pill float-right float-md-left"><i class="fa-solid fa-check"></i> ยืนยัน</button>
                                <button type="reset" class="btn bg-gradient-warning rounded-pill float-left float-md-right"><i class="fa-solid fa-arrow-rotate-left"></i> รีเซ็ท</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        let imgInput = document.querySelector('#postBanner');
        let previewImg = document.querySelector('#previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file);
            }
        }
        $(function() {
            $.validator.setDefaults({

            });
            $("#postForm").validate({
                rules: {
                    postOffice: {
                        required: true,
                    },
                    postAddress: {
                        required: true,
                    },
                    postProvinces: {
                        required: true,
                    },
                    postFaculty: {
                        required: true,
                    },
                    summernote: {
                        required: true,
                    },
                },
                messages: {
                    postBanner: {
                        required: "กรุณาเพิ่มรูปภาพหน้าปก!",
                    },
                    postOffice: {
                        required: "กรุณากรอกชื่อบริษัท!",
                    },
                    postAddress: {
                        required: "กรุณากรอกที่อยู่บริษัท!",
                    },
                    postProvinces: {
                        required: "กรุณาเลือกหมวดหมู่จังหวัด!",
                    },
                    postFaculty: {
                        required: "กรุณาเลือกหมวดหมู่คณะ!",
                    },
                    summernote: {
                        required: "กรุณากรอกเนื้อหา!",
                    },
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    element.closest(".form-group").append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass("is-invalid");
                },
            });
        });
    </script>
<?php } else {
    echo "<script> window.location.href='../admin';</script>";
} ?>