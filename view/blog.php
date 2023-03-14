<?php

$starPerPage = 10;
if (isset($_GET['recommend'])) {
    $starPage = $_GET['recommend'];
} else {
    $starPage = 1;
}

$starStart = ($starPage - 1) * $starPerPage;
$starPost = fetchStarPost($conn, $starStart, $starPerPage);
$starCount = mysqli_num_rows($starPost);


$perpage = 20;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start = ($page - 1) * $perpage;
$post = fetchMainPost($conn, $start, $perpage);
$postCount = mysqli_num_rows($post);

?>

<div class="row gy-4 posts-list">
    <!-- Recommend blog -->
    <?php if ($starCount > 0) { ?>
        <h3><i class="fa-solid fa-star text-warning"></i> รายการแนะนำ : </h3>
        <?php foreach ($starPost as $starRow) { ?>
            <div class="col-lg-6">
                <article class="card d-flex flex-column border-0" data-aos="zoom-out" data-aos-delay="10000">

                    <div class="card-body p-0">

                        <div class="post-img">
                            <img src="admin/assets/img/postBanner/<?= $starRow['post_banner'] ?>" alt="<?= $starRow['post_banner'] ?>" class="img-fluid rounded" data-aos="fade-in" data-aos-delay="1000">
                        </div>

                        <h2 class="title">
                            <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>"><?= $starRow['post_topic'] ?></a>
                        </h2>

                        <div class="meta-top">
                            <ul class="row">
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-person"></i> <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>"><?= $starRow['status'] ?></a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-clock"></i> <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>"><time datetime="<?= $starRow['post_date'] ?>"><?= DateThai($starRow['post_date']) ?></time></a></li>
                                <?php $countComment = countComments($conn, $starRow['id']); ?>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-chat-dots"></i> <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>">
                                        <?php foreach ($countComment as $countComments) { ?>
                                            <?= $countComments['noComments']; ?> รีวิว
                                        <?php } ?></a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-eye"></i> <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>"><?= $starRow['post_view'] ?> ครั้ง</a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-star-fill text-warning"></i> <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>"><?php if (!$starRow['post_rating']) {
                                                                                                                                                                                        echo "0";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo $starRow['post_rating'];
                                                                                                                                                                                    } ?> คะแนน</a></li>
                            </ul>
                        </div>

                        <div class="content">

                            <div class="mb-3">
                                <h6 class="bg-light p-1 rounded-4 text-center"><i class="fa-solid fa-tags text-secondary"></i> หมวดหมู่คณะ :</h6>
                                <?php $catFaculty = catFaculty($conn, $starRow['faculty_ref']); ?>
                                <ul class="cats">
                                    <?php foreach ($catFaculty as $rowFac) { ?>
                                        <li><a href="?page=search&search=<?= $rowFac['faculty_name'] ?>"><?= $rowFac['faculty_name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="mb-3">
                                <h6 class="bg-light p-1 rounded-4 text-center"><i class="fa-solid fa-location-dot text-danger"></i> หมวดหมู่จังหวัด :</h6>
                                <?php $catProvinces = catProvinces($conn, $starRow['provinces_ref']); ?>
                                <ul class="cats">
                                    <?php foreach ($catProvinces as $rowPro) { ?>
                                        <li><a href="?page=search&search=<?= $rowPro['cp_name'] ?>"><?= $rowPro['cp_name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0">
                        <div class="read-more mt-md-5 text-end">
                            <a href="?page=post-detail&i=<?= $starRow['post_unid'] ?>">รายละเอียด <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                </article>
            </div>
        <?php } ?>
        <!-- End post list item -->

        <div class="blog-pagination">
            <ul class="justify-content-center">
                <?php $totalStarPage = recommendPagination($conn, $starPerPage); ?>
                <li class="rounded"><a href="?recommend=1"><i class="bi bi-caret-left-fill text-secondary"></i></a></li>
                <?php for ($k = 1; $k <= $totalStarPage; $k++) { ?>
                    <li class="rounded"><a href="?recommend=<?= $k ?>"><?= $k ?></a></li>
                <?php } ?>
                <li class="rounded"><a href="?recommend=<?= $totalStarPage ?>"><i class="bi bi-caret-right-fill text-secondary"></i></a></li>
            </ul>
        </div><!-- End blog pagination -->


    <?php } else { ?>
        <h3><i class="fa-solid fa-star text-warning"></i> รายการแนะนำ : </h3>
        <div class="text-center py-5">
            <h3>ยังไม่มีรายการโพสต์!</h3>
            <img class="img-fluid w-50" src="admin/assets/img/out-of-stock.png" alt="No comment" />
        </div>
    <?php } ?>
    <!-- End Recommend blog -->

    <hr>

    <!-- General blog -->
    <?php if ($postCount > 0) { ?>
        <h3><i class="fa-solid fa-bars fw-bold text-secondary"></i> รายการทั่วไป : </h3>
        <?php foreach ($post as $row) { ?>
            <div class="col-lg-6">
                <article class="card d-flex flex-column border-0" data-aos="zoom-out" data-aos-delay="10000">

                    <div class="card-body p-0">

                        <div class="post-img">
                            <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="img-fluid rounded" data-aos="fade-in" data-aos-delay="1000">
                        </div>

                        <h2 class="title">
                            <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['post_topic'] ?></a>
                        </h2>

                        <div class="meta-top">
                            <ul class="row">
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-person"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['status'] ?></a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-clock"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><time datetime="<?= $row['post_date'] ?>"><?= DateThai($row['post_date']) ?></time></a></li>
                                <?php $countComment = countComments($conn, $row['id']); ?>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-chat-dots"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>">
                                        <?php foreach ($countComment as $countComments) { ?>
                                            <?= $countComments['noComments']; ?> รีวิว
                                        <?php } ?></a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-eye"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['post_view'] ?> ครั้ง</a></li>
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-star-fill text-warning"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?php if (!$row['post_rating']) {
                                                                                                                                                                                        echo "0";
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo $row['post_rating'];
                                                                                                                                                                                    } ?> คะแนน</a></li>
                            </ul>
                        </div>

                        <div class="content">

                            <div class="mb-3">
                                <h6 class="bg-light p-1 rounded-4 text-center"><i class="fa-solid fa-tags text-secondary"></i> หมวดหมู่คณะ :</h6>
                                <?php $catFaculty = catFaculty($conn, $row['faculty_ref']); ?>
                                <ul class="cats">
                                    <?php foreach ($catFaculty as $rowFac) { ?>
                                        <li><a href="?page=search&search=<?= $rowFac['faculty_name'] ?>"><?= $rowFac['faculty_name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="mb-3">
                                <h6 class="bg-light p-1 rounded-4 text-center"><i class="fa-solid fa-location-dot text-danger"></i> หมวดหมู่จังหวัด :</h6>
                                <?php $catProvinces = catProvinces($conn, $row['provinces_ref']); ?>
                                <ul class="cats">
                                    <?php foreach ($catProvinces as $rowPro) { ?>
                                        <li><a href="?page=search&search=<?= $rowPro['cp_name'] ?>"><?= $rowPro['cp_name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0">
                        <div class="read-more mt-md-5 text-end">
                            <a href="?page=post-detail&i=<?= $row['post_unid'] ?>">รายละเอียด <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>

                </article>
            </div>
        <?php } ?>
        <!-- End post list item -->

        <div class="blog-pagination">
            <ul class="justify-content-center">
                <?php $totalPage = pagination($conn, $perpage); ?>
                <li class="rounded"><a href="?page=1"><i class="bi bi-caret-left-fill text-secondary"></i></a></li>
                <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                    <li class="rounded"><a href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
                <li class="rounded"><a href="?page=<?= $totalPage ?>"><i class="bi bi-caret-right-fill text-secondary"></i></a></li>
            </ul>
        </div><!-- End blog pagination -->


    <?php } else { ?>
        <h3><i class="fa-solid fa-bars fw-bold text-secondary"></i> รายการทั่วไป : </h3>
        <div class="text-center py-5">
            <h3>ยังไม่มีรายการโพสต์!</h3>
            <img class="img-fluid w-50" src="admin/assets/img/out-of-stock.png" alt="No comment" />
        </div>
    <?php } ?>
</div><!-- End blog posts list -->