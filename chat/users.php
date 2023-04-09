<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  header("location: ../index");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <a href="../profile">
          <div class="content">
            <?php
            $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = {$_SESSION['id']}");
            if (mysqli_num_rows($sql) > 0) {
              $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <img class="rounded-circle" src="../img/user_img/<?= $row['img_user']; ?>" alt="<?= $row['img_user']; ?>" style="width: 50px; object-fit:cover;" loading="lazy">
            <div class="details">
              <span>
                <?php if (isset($_SESSION['role'])) { ?>
                  <?php if ($_SESSION['role'] == 'Member') { ?>
                    <i class="fa-solid fa-user"></i>
                  <?php } elseif ($_SESSION['role'] == 'Admin') { ?>
                    <i class="fa-solid fa-headset"></i>
                  <?php } ?>
                <?php } ?>
                <?php echo $row['fname'] . " " . $row['lname'] ?>
              </span>
              <p><?php echo $row['chat_status']; ?></p>
            </div>
          </div>
        </a>
      </header>
      <div class="search">
        <span class="text">เลือกผู้ใช้เพื่อเริ่มต้นการสนทนา</span>
        <input type="text" placeholder="พิมพ์ชื่อเพื่อค้นหา...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <?php if (isset($_SESSION['role'])) { ?>
    <?php if ($_SESSION['role'] == 'Member') { ?>
      <script src="javascript/users.js"></script>
    <?php } elseif ($_SESSION['role'] == 'Admin') { ?>
      <script src="javascript/admin.js"></script>
    <?php } ?>
  <?php } ?>

</body>

</html>