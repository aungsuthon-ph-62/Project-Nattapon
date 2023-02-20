$(document).ready(function () {
  $("#commentForm").on("submit", function (event) {
    event.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: "php/comments.php",
      method: "POST",
      data: formData,
      dataType: "JSON",
      success: function (response) {
        if (!response.error) {
          $("#commentForm")[0].reset();
          $("#commentId").val("0");
          Swal.fire({
            icon: "success",
            title: "Success!",
            text: response.message,
            showConfirmButton: false,
            timer: "1200",
          }).then((result) => {
            window.location.reload();
          });
        } else if (response.error) {
          $("#commentId").val("0");
          $("#message").html(response.message);
        }
      },
    });
  });
  $(document).on("click", ".reply", function () {
    var commentId = $(this).attr("id");
    var replyName = $(this).attr("reply-name");
    $("#commentId").val(commentId);
    $("#replying").html(replyName);
    $("#comment").focus();
  });
});
