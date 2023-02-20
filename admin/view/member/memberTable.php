<?php
$userId = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id != '$userId' ORDER BY id DESC";
$postTable_result = mysqli_query($conn, $sql);
$i = 0;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">รายการผู้ใช้งาน</h3>
        <div class="card-tools">
            <?php if (isset($_GET['p']) != "viewMember") { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a href="../admin?p=viewMember" class="dropdown-item"><i class="fa-solid fa-table-cells"></i> ดูทั้งหมด</a>
                        <a href="../admin?p=addMember" class="dropdown-item"><i class="fa-solid fa-plus"></i> เพิ่มสมาชิก</a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="index?p=addMember" class="btn btn-primary"><i class="fa-solid fa-plus"></i> เพิ่มสมาชิก</a>
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
        <table id="memberTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>รหัสนักศึกษา</th>
                    <th>อีเมลล์</th>
                    <th>สถานะ</th>
                    <th>สมัครสมาชิกเมื่อ</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $postTable_result as $row) { ?>
                    <tr>
                        <td><?php echo $i = $i + 1; ?></td>
                        <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
                        <td><?php echo $row['std_no']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo DateThai($row['reg_date']); ?></td>
                        <td class="d-md-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="postAction">
                                <a href="../admin?p=memberInfo&i=<?php echo $row['std_no']; ?>" class="btn btn-info"><i class="bi bi-info-circle"></i></a>
                                <a href="../admin?p=editMember&i=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-danger deleteMember" id="<?php echo $row['std_no']; ?>" data-post-title="<?php echo $row['email']; ?>"><i class="bi bi-trash3"></i></button>
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
    $(document).on("click", ".deleteMember", function () {
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
        window.location.href = "php/action.php?deleteMember=" + id;
      }
    });
});
</script>