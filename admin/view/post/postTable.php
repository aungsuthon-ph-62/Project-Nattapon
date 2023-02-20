<?php

$sql = "SELECT p.id, p.post_unid, p.post_topic, p.post_banner, p.post_address, p.post_content, p.post_date,
u.fname, u.lname
FROM post_tbl as p 
INNER JOIN user as u ON u.id = p.post_by 
ORDER BY p.id DESC";
$postTable_result = mysqli_query($conn, $sql);
$i = 0;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">โพสต์</h3>
        <div class="card-tools">
            <?php if (isset($_GET['p']) != "viewPost") { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a href="../admin?p=viewPost" class="dropdown-item"><i class="fa-solid fa-table-cells"></i> ดูทั้งหมด</a>
                        <a href="../admin?p=addPost" class="dropdown-item"><i class="fa-solid fa-plus"></i> เพิ่มโพสต์</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="index?p=addPost" class="btn btn-primary"><i class="fa-solid fa-plus"></i> เพิ่มโพสต์</a>
            <?php } ?>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="postTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>หมายเลขโพสต์</th>
                    <th>ชื่อบริษัท</th>
                    <th>โพสต์โดย</th>
                    <th>วันที่โพสต์</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postTable_result as $row) { ?>
                    <tr>
                        <td><?php echo $i = $i + 1; ?></td>
                        <td><?php echo $row['post_unid']; ?></td>
                        <td class="text-truncate"><?php echo substr($row['post_topic'], 0, 50) . "..."; ?></td>
                        <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                        <td><?php echo DateThai($row['post_date']); ?></td>
                        <td class="d-md-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="postAction">
                                <a href="../admin?p=postInfo&i=<?php echo $row['id']; ?>" class="btn btn-info"><i class="bi bi-info-circle"></i></a>
                                <a href="../admin?p=editPost&i=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-danger deletePost" id="<?php echo $row['post_unid'] ?>" data-post-title="<?php echo $row['post_unid'] ?>"><i class="bi bi-trash3"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php }
                mysqli_free_result($postTable_result); ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).on('click', '.deletePost', function() {
        var id = $(this).attr("id");
        var postTitle = $(this).attr("data-post-title");

        swalWithBootstrapButtons.fire({
            title: 'ยืนยันการลบรายการนี้ใช่หรือไม่?',
            html: "<h5>รายการ : " + postTitle + "</h5>",
            footer: '<b>ลบรายการแล้วจะไม่สามารถกู้คืนได้อีก</b>',
            icon: "warning",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ใช่, ยืนยันการลบ!',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = "php/action.php?deletePost=" + id;
            }
        });
    });
</script>