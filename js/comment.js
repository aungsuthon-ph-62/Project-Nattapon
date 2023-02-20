$(document).ready(function() {
  showComments();
  $("#commentForm").on("submit", function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
          url: "php/comments.php",
          method: "POST",
          data: formData,
          dataType: "JSON",
          success: function(response) {
              if (!response.error) {
                  $("#commentForm")[0].reset();
                  $("#commentId").val("0");
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: response.message,
                      showConfirmButton: true,
                      timer: '5000'
                  })
                  showComments();
              } else if (response.error) {
                  $("#commentId").val("0");
                  $("#message").html(response.message);
              }
          },
      });
  });
  $(document).on("click", ".reply", function() {
      var commentId = $(this).attr("id");
      var replyName = $(this).attr("reply-name");
      $("#commentId").val(commentId);
      $("#replying").html(replyName);
      $("#comment").focus();
  });
});
// function to show comments
function showComments() {
  $.ajax({
      url: "php/show_comments.php",
      method: "POST",
      success: function(response) {
          $("#showComments").html(response);
      },
  });
}