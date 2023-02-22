<?php
if (isset($_GET['page']) && isset($_GET['i'])) { ?>
  <?php
  $unid = $_GET['i'];

  $increaseView = countView($conn, $unid);

  $post = post($conn, $unid);
  $row = mysqli_fetch_assoc($post);
  ?>
  <article class="blog-details">

    <div class="post-img">
      <img src="admin/assets/img/postBanner/<?= $row['post_banner'] ?>" alt="<?= $row['post_banner'] ?>" class="img-fluid w-100" data-aos="zoom-in" data-aos-delay="15000">
    </div>

    <h2 class="title"><?= $row['post_topic'] ?></h2>

    <div class="meta-top">
      <ul class="row">
        <li class="d-flex align-items-center col-auto"><i class="bi bi-person"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['status'] ?></a></li>
        <li class="d-flex align-items-center col-auto"><i class="bi bi-clock"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><time datetime="<?= $row['post_date'] ?>"><?= DateThai($row['post_date']) ?></time></a></li>
        <?php $countComment = countComments($conn, $row['id']); ?>
        <li class="d-flex align-items-center col-auto"><i class="bi bi-chat-dots"></i> <a href="?page=post-detail&i=<?= $row['post_unid'] ?>">
            <?php foreach ($countComment as $countComments) { ?>
              <?= $countComments['noComments']; ?> รีวิว
            <?php } ?>
          </a>
        </li>
        <li class="d-flex align-items-center col-auto"><i class="bi bi-eye"></i><a href="?page=post-detail&i=<?= $row['post_unid'] ?>"><?= $row['post_view'] ?> ครั้ง</a></li>
      </ul>
    </div><!-- End meta top -->

    <div class="content py-3">
      <article style="display:block" data-aos="fade-in" data-aos-delay="20000">
        <?php print_r($row['post_content']); ?>
      </article>
    </div><!-- End post content -->

    <div class="contact border-top">
      <h5><i class="fa-solid fa-location-dot text-danger mt-4"></i> ที่อยู่บริษัท</h5>
      <div class="map" data-aos="zoom-out" data-aos-delay="5000">
        <iframe src="https://maps.google.com/maps?q=<?= $row['post_topic'] ?>,<?= $row['post_address'] ?>&output=embed" frameborder="0" allowfullscreen></iframe>
      </div><!-- End Google Maps -->
    </div>

    <div class="meta-top mb-3">
      <ul>
        <li class="d-flex align-items-center"><i class="bi bi-eye-fill fs-5"></i><a href="?page=post-detail&i=<?= $row['post_unid'] ?>" class="fs-5"><?= $row['post_view'] ?> ครั้ง</a></li>
      </ul>
    </div><!-- End meta top -->

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

  <div class="card border-0 shadow my-5">
    <div class="card-body">
      <div class="row container">
        <div class="col-md-5 text-center order-last order-md-first">
          <h1 class="text-warning my-3">
            <b><span id="average_rating">0.0</span> / 5</b>
          </h1>
          <div class="mb-3">
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
          </div>
          <h3><span id="total_review">0</span> รีวิว</h3>
        </div>
        <div class="col-md-7">
          <p>
          <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

          <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
          </div>
          </p>
          <p>
          <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

          <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
          </div>
          </p>
          <p>
          <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

          <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
          </div>
          </p>
          <p>
          <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

          <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
          </div>
          </p>
          <p>
          <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

          <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
          </div>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="comments" data-aos="fade-in" data-aos-delay="7000">
    <div class="reply-form">
      <?php if (isset($_SESSION['id']) && isset($_SESSION['role'])) { ?>
        <h3 class="text-center my-3"><i class="bi bi-chat-dots-fill text-primary"></i> เขียนรีวิว</h3>
        <div class="container">
          <div class="d-flex align-items-center">
            <h5 class="me-3">ให้คะแนน</h5>
            <h4>
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
              <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
            </h4>
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <textarea name="user_review" id="user_review" class="form-control" placeholder="เขียนความคิดเห็นของคุณที่นี่*" rows="5"></textarea>
            <span id="message" class="form-text text-danger">

            </span>
          </div>
        </div>
        <input type="hidden" name="sender" id="sender" value="<?= $id ?>">
        <input type="hidden" name="post_ref" id="post_ref" value="<?= $row['id'] ?>">
        <div class="form-group text-center mt-4">
          <button type="button" class="btn btn-primary rounded-5" id="save_review">ยืนยัน</button>
        </div>

      <?php } else { ?>
        <div class="py-3">
          <h4 class="text-center"><i class="bi bi-exclamation-triangle-fill text-warning"></i> กรุณาเข้าสู่ระบบเพื่อแสดงความคิดเห็น!</h4>
          <div class="text-center mt-3">
            <a href="login" class="btn btn-primary rounded-pill shadow"><i class="bi bi-box-arrow-in-right"></i> เข้าสู่ระบบ</a>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="mt-5" id="review_content"></div>
    <?php $comments = fetchComment($conn, $row['id']); ?>
    <?php foreach ($comments as $comment) { ?>
      <div id="comment" class="comment border-bottom py-3">
        <div class="d-flex align-items-top justify-content-between">
          <div class="d-flex">
            <?php if ($comment['img_user'] == '') { ?>
              <div class="comment-img"><img src="img/user.png" class="rounded-circle" alt="User image"></div>
            <?php } else { ?>
              <div class="comment-img"><img src="img/user_img/<?= $comment['img_user']; ?>" class="rounded-circle" alt="<?= $comment['img_user']; ?>"></div>
            <?php } ?>
            <div>
              <h5>
                <?= $comment['fname'] ?> <?= $comment['lname']; ?>
                <span class="fw-normal">
                  <?php
                  for ($star = 1; $star <= 5; $star++) {
                    $html = '';
                    $class_name = '';

                    if ($comment['user_rating'] >= $star) {
                      $class_name = 'text-warning';
                    } else {
                      $class_name = 'star-light';
                    }

                    echo $html .= '<i class="fas fa-star ' . $class_name . ' fs-6 mr-1"></i>';
                  }
                  ?>
                </span>

              </h5>

              <time datetime="<?= $comment['comment_at'] ?>"><?= DateThaiTime($comment['comment_at']); ?></time>
              <div>

              </div>
              <p class="text-break">
                <?= $comment['comment'] ?>
              </p>
            </div>
          </div>
          <?php if (isset($id)) { ?>
            <?php if ($comment['comment_by'] == $id) { ?>
              <input type="hidden" name="commentRow" id="commentRow">
              <div>
                <button class="border-0 bg-transparent editReview" id="<?= $comment['comment_id'] ?>">
                  <i class="bi bi-gear-fill text-secondary"></i>
                </button>
                <button class="border-0 bg-transparent ms-1 deleteReview" id="<?= $comment['comment_id'] ?>" data-post="<?= $row['post_unid'] ?>" data-post-title="<?= $comment['comment'] ?>">
                  <i class="bi bi-x-circle-fill text-danger"></i>
                </button>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div><!-- End blog comments -->



  <script>
    $(document).ready(function() {

      var rating_data = 0;

      $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

          $('#submit_star_' + count).addClass('text-warning');

        }

      });

      function reset_background() {
        for (var count = 1; count <= 5; count++) {

          $('#submit_star_' + count).addClass('star-light');

          $('#submit_star_' + count).removeClass('text-warning');

        }
      }

      $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

          $('#submit_star_' + count).removeClass('star-light');

          $('#submit_star_' + count).addClass('text-warning');
        }

      });

      $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');

      });

      $('#save_review').click(function() {

        var sender = $('#sender').val();

        var user_review = $('#user_review').val();

        var post_ref = $('#post_ref').val();

        if (rating_data == '') {
          $("#message").html("* กรุณาให้คะแนน!");
          return false;
        } else if (user_review == '') {
          $("#message").html("* กรุณาเขียนความคิดเห็น!");
          $("#user_review").addClass("is-invalid");
          return false;
        } else {
          $.ajax({
            url: "php/submit_rating.php",
            method: "POST",
            data: {
              rating_data: rating_data,
              sender: sender,
              user_review: user_review,
              post_ref: post_ref
            },
            success: function(data) {
              $('#user_review').val("");
              reset_background();
              load_rating_data();

              Swal.fire({
                icon: "success",
                title: "Success!",
                text: data,
                showConfirmButton: false,
                timer: "2500",
              }).then((result) => {
                window.location.reload();
              });
            }
          })
        }
      });

      // update
      var new_rating_data = 0;

      $(document).on('mouseenter', '.star', function() {

        var new_rating = $(this).data('rating');

        new_reset_background();

        for (var new_count = 1; new_count <= new_rating; new_count++) {

          $('#star_' + new_count).addClass('text-warning');

        }

      });

      function new_reset_background() {
        for (var new_count = 1; new_count <= 5; new_count++) {

          $('#star_' + new_count).addClass('star-light');

          $('#star_' + new_count).removeClass('text-warning');

        }
      }

      $(document).on('mouseleave', '.star', function() {

        new_reset_background();

        for (var new_count = 1; new_count <= new_rating_data; new_count++) {

          $('#star_' + new_count).removeClass('star-light');

          $('#star_' + new_count).addClass('text-warning');
        }

      });

      $(document).on('click', '.star', function() {

        new_rating_data = $(this).data('rating');

      });

      $(document).on('click', '.editReview', function() {
        var edit_id = $(this).attr('id');
        $.ajax({
          url: "php/reviewEdit.php",
          type: "post",
          data: {
            edit_id: edit_id
          },
          success: function(data) {
            $("#infoReview").html(data);
            $("#editCommentModal").modal('show');
          }
        });
      });

      $(document).on('click', '#update', function() {
        var edit_row = $('#edit_row').val();
        var edit_userReview = $('#edit_userReview').val();

        if (new_rating_data == '') {
          $("#message").html("* กรุณาให้คะแนน!");
          return false;
        } else if (edit_userReview == '') {
          $("#message").html("* กรุณาเขียนความคิดเห็น!");
          $("#edit_userReview").addClass("is-invalid");
          return false;
        } else {
          $.ajax({
            url: "php/action.php",
            type: "post",
            data: {
              edit_row: edit_row,
              edit_userReview: edit_userReview,
              new_rating_data: new_rating_data
            },
            success: function(data) {
              $("#editCommentModal").modal('hide');
              load_rating_data();

              Swal.fire({
                icon: "success",
                title: "Success!",
                text: data,
                showConfirmButton: false,
                timer: "2500",
              }).then((result) => {
                window.location.reload();
              });
            }
          })
        }
      });

      load_rating_data();

      function load_rating_data() {
        var post_ref = $('#post_ref').val();
        $.ajax({
          url: "php/submit_rating.php",
          method: "POST",
          data: {
            action: 'load_data',
            post_ref: post_ref
          },
          dataType: "JSON",
          success: function(data) {
            $('#average_rating').text(data.average_rating);
            $('#total_review').text(data.total_review);

            var count_star = 0;

            $('.main_star').each(function() {
              count_star++;
              if (Math.ceil(data.average_rating) >= count_star) {
                $(this).addClass('text-warning');
                $(this).addClass('star-light');
              }
            });

            $('#total_five_star_review').text(data.five_star_review);

            $('#total_four_star_review').text(data.four_star_review);

            $('#total_three_star_review').text(data.three_star_review);

            $('#total_two_star_review').text(data.two_star_review);

            $('#total_one_star_review').text(data.one_star_review);

            $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

            $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

            $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

            $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

            $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');
          }
        })
      }




    });
  </script>
  <?php mysqli_free_result($comments); ?>
  <?php mysqli_free_result($catFaculty); ?>
  <?php mysqli_free_result($catProvinces); ?>
  <?php mysqli_free_result($post); ?>
<?php  } else {
  header("Location: ../index");
} ?>