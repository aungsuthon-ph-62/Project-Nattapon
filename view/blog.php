<?php

$perpage = 10;
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
    <?php if ($postCount > 0) { ?>
        <?php foreach ($post as $row) { ?>
            <div class="col-lg-6">
                <article class="d-flex flex-column" data-aos="zoom-out" data-aos-delay="10000">

                    <div class="post-img">
                        <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="img-fluid" data-aos="fade-in" data-aos-delay="1000">
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
                            <li class="d-flex align-items-center col-auto"><i class="bi bi-star-fill text-warning"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['post_rating'] ?> คะแนน</a></li>
                        </ul>
                    </div>

                    <div class="content">

                        <div class="mb-3">
                            <h6 class="bg-light p-1 rounded-4 text-center"><i class="fa-solid fa-tags text-secondary"></i> หมวดหมู่สาขาวิชา :</h6>
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

                    <div class="read-more mt-md-5 align-self-end">
                        <a href="?page=post-detail&i=<?= $row['post_unid'] ?>">รายละเอียด <i class="fa-solid fa-arrow-right"></i></a>
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
        <div class="text-center py-5">
            <h3>ยังไม่มีรายการโพสต์!</h3>
            <img class="img-fluid w-50" src="admin/assets/img/out-of-stock.png" alt="No comment" />
        </div>
    <?php } ?>
</div><!-- End blog posts list -->