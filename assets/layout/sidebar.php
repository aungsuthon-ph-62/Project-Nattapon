<div class="sidebar">

    <div class="sidebar-item search-form">
        <h3 class="sidebar-title">ค้นหา</h3>
        <form action="" class="mt-3">
            <input type="text">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End sidebar search formn-->

    <div class="sidebar-item categories">
        <h3 class="sidebar-title">หมวดหมู่สาขาวิชา</h3>
        <ul class="mt-3">
            <?php
            $catFaculty = fetchCatFaculty($conn);
            $catFacultyCount = mysqli_num_rows($catFaculty);
            ?>
            <?php if ($catFacultyCount > 0) { ?>
                <?php foreach ($catFaculty as $row) { ?>
                    <li><a href="<?= $row['id'] ?>"><?= $row['faculty_name'] ?></a></li>
                <?php } ?>
            <?php } else { ?>
                <div class="text-center py-5">
                    <h3>ยังไม่มีรายการ</h3>
                </div>
            <?php } ?>
        </ul>
    </div><!-- End sidebar categories-->

    <div class="sidebar-item recent-posts">
        <h3 class="sidebar-title">โพสต์ล่าสุด</h3>

        <div class="mt-3">
            <?php
            $limit = 5;
            $post = fetchPost($conn, $limit);
            $postCount = mysqli_num_rows($post);
            ?>
            <?php if ($postCount > 0) { ?>
                <?php foreach ($post as $row) { ?>
                    <div class="post-item mt-3">
                        <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="flex-shrink-0">
                        <div>
                            <h4><a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['post_topic'] ?></a></h4>
                            <time datetime="<?= $row['post_date'] ?>"><?= DateThai($row['post_date']) ?></time>
                        </div>
                    </div><!-- End recent post item-->
                <?php } ?>
            <?php } else { ?>
                <div class="text-center py-5">
                    <h3>ยังไม่มีรายการโพสต์!</h3>
                    <img class="img-fluid w-50" src="admin/assets/img/out-of-stock.png" alt="No comment" />
                </div>
            <?php } ?>

        </div>

    </div><!-- End sidebar recent posts-->

    <div class="sidebar-item tags">
        <h3 class="sidebar-title">หมวดหมู่จังหวัด</h3>
        <ul class="mt-3">
            <?php
            $queryProv = fetchCatProvinces();
            ?>
            <?php foreach ($queryProv as $rowPro) {
            ?>
                <li><a href="<?= $rowPro['name_th'] ?>"><?= $rowPro['name_th'] ?></a></li>
            <?php } ?>
        </ul>
    </div><!-- End sidebar tags-->

</div>