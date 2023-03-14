<?php if (isset($_GET['p']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT * FROM faculty ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="bi bi-pencil-square"></i> แก้ไขหมวดหมู่คณะ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="../admin?p=viewFaculty">หมวดหมู่คณะ</a></li>
                        <li class="breadcrumb-item active">แก้ไขหมวดหมู่คณะ</li>
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
                        <form id="postForm" method="post" action="php/action.php" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="editFaculty">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputFaculty">รหัสนักศึกษา</label>
                                    <input type="text" class="form-control" id="inputFaculty" name="inputFaculty" value="<?= $user['faculty_name'] ?>">
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
        $(function() {
            $.validator.setDefaults({

            });
            $("#postForm").validate({
                rules: {
                    inputFaculty: {
                        required: true,
                    },
                },
                messages: {
                    inputFaculty: {
                        required: "กรุณากรอกชื่อคณะ!",
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