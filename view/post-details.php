<?php
if (isset($_GET['page']) && isset($_GET['i'])) { ?>
  <?php
  $unid = $_GET['i'];
  $post = post($conn, $unid);
  $row = mysqli_fetch_assoc($post);
  ?>
  <article class="blog-details">

    <div class="post-img">
      <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="img-fluid w-100" data-aos="zoom-in" delay="5000">
    </div>

    <h2 class="title"><?= $row['post_topic'] ?></h2>

    <div class="meta-top">
      <ul>
        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html"><?= $row['status'] ?></a></li>
        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="<?= $row['post_date'] ?>"><?= DateThai($row['post_date']) ?></time></a></li>
        <?php $countComment = countComments($conn, $row['id']); ?>
        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">
            <?php foreach ($countComment as $countComments) { ?>
              <?= $countComments['noComments']; ?> ความคิดเห็น
            <?php } ?></a></li>
      </ul>
    </div><!-- End meta top -->

    <div class="content">
      <article style="display:block">
        <?php print_r($row['post_content']); ?>
      </article>
    </div><!-- End post content -->

    <div class="contact border-top">
      <h5><i class="fa-solid fa-location-dot text-danger mt-4"></i> ที่อยู่บริษัท</h5>
      <div class="map">
        <iframe src="https://maps.google.com/maps?q=<?= $row['post_topic'] ?>,<?= $row['post_address'] ?>&output=embed" frameborder="0" allowfullscreen></iframe>
      </div><!-- End Google Maps -->
    </div>

    <div class="meta-bottom">
      <i class="bi bi-tags"></i>
      <ul class="cats">
        <?php $catFaculty = catFaculty($conn, $row['faculty_ref']); ?>
        <?php foreach ($catFaculty as $rowFac) { ?>
          <li><a href="<?= $rowFac['faculty_name']; ?>"><?= $rowFac['faculty_name']; ?></a></li>
        <?php } ?>
      </ul>

      <i class="bi bi-geo-alt"></i>
      <ul class="tags">
        <?php $catProvinces = catProvinces($conn, $row['faculty_ref']); ?>
        <?php foreach ($catProvinces as $rowPro) { ?>
          <li><a href="<?= $rowPro['cp_name']; ?>"><?= $rowPro['cp_name']; ?></a></li>
        <?php } ?>
      </ul>
    </div><!-- End meta bottom -->

  </article><!-- End blog post -->



  <div class="comments">
    <h4 class="comments-count">
      <?php foreach ($countComment as $countComments) { ?>
        <?= $countComments['noComments']; ?> ความคิดเห็น
      <?php } ?>
    </h4>

    <?php $comments = fetchComment($conn, $row['id']); ?>
    <?php foreach ($comments as $comment) { ?>
      <div id="comment" class="comment border-bottom">
        <div class="d-flex">
          <div class="comment-img"><img src="img/user_img/<?= $comment['img_user']; ?>" alt=""></div>
          <div>
            <h5><?= $comment['fname'] ?> <?= $comment['lname']; ?></h5>
            <time datetime="<?= $comment['comment_at'] ?>"><?= DateThaiTime($comment['comment_at']); ?></time>
            <p class="text-break">
              <?= $comment['comment'] ?>
            </p>
          </div>
        </div>
      </div><!-- End comment -->
    <?php } ?>



    <div class="reply-form">
      <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>

        <h4><i class="bi bi-chat-dots-fill text-primary"></i> แสดงความคิดเห็น</h4>
        <form method="POST" id="commentForm">
          <div class="row">
            <div class="col form-group">
              <textarea name="comment" id="comment" class="form-control" placeholder="เขียนความคิดเห็นของคุณที่นี่*" rows="5"></textarea>
              <span id="message" class="form-text text-danger">

              </span>
              <span id="replying" class="form-text text-success">

              </span>
              <input type="hidden" name="commentId" id="commentId" value="0">
              <input type="hidden" name="sender" id="sender" value="<?= $id ?>">
              <input type="hidden" name="postID" id="postID" value="<?= $row['id'] ?>">
            </div>
          </div>
          <button type="submit" name="submit" id="submit" class="btn btn-primary rounded-5">ยืนยัน</button>

        </form>

      <?php } else { ?>
        <h4 class="text-center"><i class="bi bi-x-circle-fill text-danger"></i> กรุณาเข้าสู่ระบบเพื่อแสดงความคิดเห็น!</h4>
      <?php } ?>
    </div>


  </div><!-- End blog comments -->
  <?php mysqli_free_result($comments); ?>
<?php  } else {
  header("Location: ../index");
} ?>