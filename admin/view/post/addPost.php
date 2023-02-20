<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa-solid fa-plus"></i> เพิ่มโพสต์</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                    <li class="breadcrumb-item"><a href="../admin?p=viewPost">โพสต์</a></li>
                    <li class="breadcrumb-item active">เพิ่มโพสต์</li>
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
                        <h3 class="card-title"><i class="fa-solid fa-plus"></i> เพิ่มโพสต์</h3>
                    </div>
                    <form id="postForm" method="post" action="php/action.php" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="addPost">
                        <input type="hidden" name="uid" id="uid" value="<?php echo $id ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputFile"><i class="fa-solid fa-image"></i> แนบรูปภาพหน้าปก</label>
                                <div class="p-md-5">
                                    <img src="../img/image.png" id='previewImg' class='img-thumbnail rounded-lg w-25'>
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="postBanner" name="postBanner" accept='image/gif, image/jpeg, image/png, image/jpg'>
                                        <label class="custom-file-label" for="postBanner">เลือกไฟล์</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postOffice"><i class="fa-solid fa-building"></i> ชื่อบริษัท</label>
                                <input type="text" name="postOffice" class="form-control" id="postOffice" placeholder="กรอกชื่อบริษัท">
                            </div>
                            <div class="form-group">
                                <label for="postAddress"><i class="fa-solid fa-location-dot"></i> ที่อยู่บริษัท</label>
                                <textarea class="form-control" name="postAddress" id="postAddress" rows="3" placeholder="กรอกที่อยู่บริษัท"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postProvinces"><i class="fa-solid fa-tags"></i> หมวดหมู่ (จังหวัด)</label>
                                        <div class="select2-success">
                                            <select class="select2" multiple="multiple" style="width: 100%;" id="postProvinces" name="postProvinces[]">
                                                <?php
                                                require_once "assets/vendor/province-db/conn.php";
                                                $provSql = "SELECT * FROM provinces";
                                                $queryProv = mysqli_query($connProvinces, $provSql);
                                                ?>
                                                <?php foreach ($queryProv as $rowPro) {
                                                ?>

                                                    <option value="<?= $rowPro['name_th'] ?>"><?= $rowPro['name_th'] ?></option>
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
                                            <select class="select2 " multiple="multiple" style="width: 100%;" id="postFaculty" name="postFaculty[]">
                                                <?php
                                                require_once "php/conn.php";
                                                $facsql = "SELECT * FROM faculty";
                                                $facQ = mysqli_query($conn, $facsql);
                                                ?>
                                                <?php foreach ($facQ as $rowFac) {
                                                ?>

                                                    <option value="<?= $rowFac['id'] ?>"><?= $rowFac['faculty_name'] ?></option>
                                                <?php }
                                                mysqli_free_result($facQ); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea id="summernote" name="postContent" class="form-control"></textarea>
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
                postBanner: {
                    required: true,
                },
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