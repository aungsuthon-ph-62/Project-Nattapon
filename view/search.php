<?php if (isset($_GET['page']) && isset($_GET['search'])) { ?>
    <?php
    $input = $_GET['search'];
    $post = search($conn, $input);
    $postCount = mysqli_num_rows($post);
    ?>


    <div class="row gy-4 posts-list">
        <?php if ($postCount > 0) { ?>
            <h3><i class="bi bi-search text-secondary fw-bold"></i> รายการค้นหา : <?= $input ?></h3>
            <?php foreach ($post as $row) { ?>
                <div class="col-lg-6">
                    <article class="d-flex flex-column" data-aos="zoom-out" data-aos-delay="10000">

                        <div class="post-img">
                            <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="img-fluid" data-aos="fade-in" data-aos-delay="1000" loading="lazy" width="100%" style="object-fit: cover;">
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
                                <li class="d-flex align-items-center col-auto"><i class="bi bi-star-fill text-warning"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?php if(!$row['post_rating']) { echo "0";}else{ echo $row['post_rating'];} ?> คะแนน</a></li>
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

                        <div class="read-more mt-md-5 align-self-end">
                            <a href="?page=post-detail&i=<?= $row['post_unid'] ?>">รายละเอียด <i class="fa-solid fa-arrow-right"></i></a>
                        </div>

                    </article>
                </div>
            <?php } ?>
            <!-- End post list item -->

            <?php mysqli_free_result($countComment); ?>
            <?php mysqli_free_result($catFaculty); ?>
            <?php mysqli_free_result($catProvinces); ?>
            <?php mysqli_free_result($post); ?>
        <?php } else { ?>
            <div class="text-center py-5">
                <h3>ยังไม่มีรายการโพสต์!</h3>
                <img class="img-fluid w-50" src="admin/assets/img/out-of-stock.png" alt="No comment" loading="lazy" />
            </div>
        <?php } ?>
    </div><!-- End blog posts list -->


<?php  } else {
    header("Location: ../index");
} ?>