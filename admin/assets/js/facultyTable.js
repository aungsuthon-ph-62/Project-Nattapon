const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: "btn bg-gradient-success rounded-pill mx-3",
    cancelButton: "btn bg-gradient-danger rounded-pill mx-3",
  },
  buttonsStyling: false,
});
$(document).on("click", ".deletefaculty", function () {
  var id = $(this).attr("id");
  var postTitle = $(this).attr("data-post-title");

  swalWithBootstrapButtons
    .fire({
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
