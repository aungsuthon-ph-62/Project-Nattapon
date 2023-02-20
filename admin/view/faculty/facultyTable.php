<?php
$sql = "SELECT * FROM faculty ORDER BY id DESC";
$postTable_result = mysqli_query($conn, $sql);
$i = 0;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">รายการหมวดหมู่สาขาวิชา</h3>
        <div class="card-tools">
            <?php if (isset($_GET['p']) != "viewFaculty") { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a href="../admin?p=viewFaculty" class="dropdown-item"><i class="fa-solid fa-table-cells"></i> ดูทั้งหมด</a>
                        <a href="../admin?p=addFaculty" class="dropdown-item"><i class="fa-solid fa-plus"></i> เพิ่มสาขาวิชา</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="index?p=addfaculty" class="btn btn-primary"><i class="fa-solid fa-plus"></i> เพิ่มสาขาวิชา</a>
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
        <table id="facultyTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>สาขาวิชา</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($postTable_result as $row) { ?>
                    <tr>
                        <td><?php echo $i = $i + 1; ?></td>
                        <td><?php echo $row['faculty_name']; ?></td>
                        <td class="d-md-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="postAction">
                                <a href="../admin?p=editFaculty&i=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-danger deletefaculty" id="<?php echo $row['id']; ?>" data-post-title="<?php echo $row['faculty_name']; ?>"><i class="bi bi-trash3"></i></button>
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
    $(document).on("click", ".deletefaculty", function() {
        var id = $(this).attr("id");
        var postTitle = $(this).attr("data-post-title");

        swalWithBootstrapButtons.fire({
                title: "ยืนยันการลบรายการนี้ใช่หรือไม่?",
                html: "<h5>รายการ : " + postTitle + "</h5>",
                footer: "<b>ลบรายการแล้วจะไม่สามารถกู้คืนได้อีก</b>",
                icon: "warning",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "ใช่, ยืนยันที่จะลบ!",
                cancelButtonText: "ยกเลิก",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.value) {
                    window.location.href = "php/action.php?deleteFaculty=" + id;
                }
            });
    });
</script>