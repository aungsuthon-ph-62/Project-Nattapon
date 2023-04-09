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
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM user WHERE id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users");
        }
        ?>
        <a href="users" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img class="rounded-circle" src="../img/user_img/<?= $row['img_user']; ?>" alt="<?= $row['img_user']; ?>" style="width: 50px; object-fit:cover;" loading="lazy">
        <div class="details">
          <span>
            <?php if ($row['status'] == 'Member') { ?>
              <i class="fa-solid fa-user"></i>
            <?php } elseif ($row['status'] == 'Admin') { ?>
              <i class="fa-solid fa-headset"></i>
            <?php } ?>
            <?php echo $row['fname'] . " " . $row['lname'] ?>
          </span>
          <p><?php echo $row['chat_status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="พิมพ์ข้อความที่นี่..." autocomplete="off">
        <button><i class="fa-solid fa-ellipsis" id="sendIcon"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>