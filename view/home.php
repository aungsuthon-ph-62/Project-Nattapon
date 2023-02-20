<?php
$sql = "SELECT u.fname, u.lname, p.id, p.post_unid, p.post_content, p.post_date, 
p.post_topic, p.post_content, p.post_banner, p.post_provinces, fac.faculty_name 
FROM post_tbl as p 
INNER JOIN faculty as fac ON fac.id = p.post_faculty 
INNER JOIN user as u ON u.id = p.post_by 
ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);
?>

<section class='container'>
    <div class="row d-flex align-items-stretch p-3 p-md-5">
        <?php while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-3">
                <a href="?page=postDetail&i=<?php echo $row['post_unid']; ?>" class="text-decoration-none">
                    <div class="card border-0 shadow rounded-4 overflow-hidden mb-3 h-100 ">
                        <img src="admin/assets/img/postBanner/<?php echo $row['post_banner']; ?>" class="card-img-top h-75" alt="<?php echo $row['post_banner']; ?>">
                        <div class="card-body h-100 text-dark">
                            <h5 class="card-title"><?php echo $row['post_topic']; ?></h5>
                            <p class="card-text text-truncate"><?php echo substr($row['post_topic'], 0, 50) . "..."; ?></p>
                            <p class="card-text"><small class="text-muted">วันที่โพสต์ : <?php echo $row['post_date']; ?></small></p>
                        </div>
                    </div>
                </a>
            </div>

        <?php } mysqli_free_result($result); ?>
    </div>
</section>