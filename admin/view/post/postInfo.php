<?php if (isset($_GET['p']) && isset($_GET['i'])) { ?>
    <?php
    $id = $_GET['i'];
    $sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date, p.provinces_ref, p.faculty_ref,
    u.fname, u.lname
    FROM post_tbl as p 
    INNER JOIN user as u ON u.id = p.post_by 
    WHERE p.id = '$id'";
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
                    <h1><i class="bi bi-info-circle-fill"></i> ข้อมูลโพสต์</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../admin">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="../admin?p=viewPost">โพสต์</a></li>
                        <li class="breadcrumb-item active"><?php echo $post['post_unid'] ?></li>
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
                                    <a href="assets/img/postBanner/<?= $post['post_banner'] ?>">
                                        <pre class="text-muted text-wrap"><?php echo $post['post_banner']; ?></pre>
                                    </a>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="postOffice"><i class="fa-solid fa-building"></i> ชื่อบริษัท</label>
                                <input type="text" name="postOffice" class="form-control" id="postOffice" value="<?= $post['post_topic'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="postAddress"><i class="fa-solid fa-location-dot"></i> ที่อยู่บริษัท</label>
                                <textarea class="form-control" name="postAddress" id="postAddress" rows="10" disabled><?= $post['post_address'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postProvinces">หมวดหมู่ (จังหวัด)</label>
                                        <div class="row">
                                            <?php while ($rowPro = mysqli_fetch_assoc($provinces)) {
                                            ?>
                                                <div class="col-md-auto mb-3">
                                                    <div class="bg-gradient-success rounded-pill p-2 shadow">
                                                        <p class="text-center text-md-start m-0">
                                                            <i class="fa-solid fa-tags"></i> <?= $rowPro['cp_name'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php }
                                            mysqli_free_result($provinces); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postFaculty">หมวดหมู่ (สาขาวิชา)</label>
                                        <div class="row">
                                            <?php while ($rowFac = mysqli_fetch_assoc($faculty)) {
                                            ?>
                                                <div class="col-md-auto mb-3">
                                                <div class="bg-gradient-success rounded-pill p-2 shadow">
                                                        <p class="text-center text-md-start m-0">
                                                            <i class="fa-solid fa-tags"></i> <?= $rowFac['faculty_name'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php }
                                            mysqli_free_result($faculty); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5><i class="fa-solid fa-circle-info"></i> รายละเอียด </h5>
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container-fluid">
                                    <article style="display:block"> <?php print_r($post['post_content']); ?></article>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../admin?p=viewPost" class="btn bg-gradient-warning rounded-pill float-right float-md-left"><i class="bi bi-arrow-left"></i> ย้อนกลับ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else {
    echo "<script> window.location.href='../admin';</script>";
} ?>