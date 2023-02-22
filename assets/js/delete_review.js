const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn bg-success rounded-pill mx-3 text-white',
    cancelButton: 'btn bg-danger rounded-pill mx-3 text-white',
  },
  buttonsStyling: false
})

$(document).on("click", ".deleteReview", function () {
  var id = $(this).attr("id");
  var postTitle = $(this).attr("data-post-title");
  var data_post = $(this).attr("data-post");

  swalWithBootstrapButtons.fire({
      title: "ยืนยันการลบรายการนี้ใช่หรือไม่?",
      html: "<h6>รายการ : " + postTitle + "</h6>",
      footer: "<b>ลบรายการแล้วจะไม่สามารถกู้คืนได้อีก</b>",
      icon: "warning",
      type: "warning",
      position: "center",
      showCancelButton: true,
      confirmButtonText: "ใช่, ยืนยันการลบ!",
      cancelButtonText: "ยกเลิก",
      reverseButtons: true,
    }).then((result) => {
      if (result.value) {
        window.location.href = "php/action.php?deleteReview=" + id + "&post_data=" + data_post;
      }
    });
});
