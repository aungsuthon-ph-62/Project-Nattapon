<?php

$sql = "SELECT cm.comment_id, cm.comment, cm.user_rating, cm.comment_at, u.fname, u.lname, p.post_unid
FROM comment as cm
INNER JOIN user as u ON u.id = cm.comment_by 
INNER JOIN post_tbl as p ON p.id = cm.post_ref 
ORDER BY cm.comment_id DESC";
$postTable_result = mysqli_query($conn, $sql);
$i = 0;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">รีวิว</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <div class="card-body">
        <table id="reviewTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รีวิว</th>
                    <th>คะแนน</th>
                    <th>โดย</th>
                    <th>วันที่แสดงความคิดเห็น</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postTable_result as $row) { ?>
                    <tr>
                        <td><?php echo $i = $i + 1; ?></td>
                        <td><?php echo $row['comment']; ?></td>
                        <td class="text-md-center text-truncate">
                            <?php
                            for ($star = 1; $star <= 5; $star++) {
                                $html = '';
                                $class_name = '';

                                if ($row['user_rating'] >= $star) {
                                    $class_name = 'text-warning';
                                } else {
                                    $class_name = 'star-light';
                                }

                                echo $html .= '<i class="fas fa-star ' . $class_name . ' fs-6 mr-1"></i>';
                            }
                            ?>
                        </td>
                        <td class="text-truncate"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                        <td><?php echo DateThai($row['comment_at']); ?></td>
                        <td class="d-md-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="postAction">
                                <button type="button" class="btn btn-danger deletePost" id="<?php echo $row['comment_id'] ?>" data-post-title="<?php echo $row['comment'] ?>"><i class="bi bi-trash3"></i></button>
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
                window.location.href = "php/action.php?deleteReview=" + id;
            }
        });
    });
</script>