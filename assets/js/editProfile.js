let imgInput = document.querySelector("#inputImage");
let previewImg = document.querySelector("#previewImg");

imgInput.onchange = (evt) => {
  const [file] = imgInput.files;
  if (file) {
    previewImg.src = URL.createObjectURL(file);
  }
};
$(function () {
  $.validator.setDefaults({});
  $("#postForm").validate({
    rules: {
      inputFname: {
        required: true,
      },
      inputLname: {
        required: true,
      },
      inputStdID: {
        required: true,
        number: true,
      },
      inputEmail: {
        required: true,
        email: true,
      },
      inputPassword: {
        minlength: 5,
      },
      inputStatus: {
        required: true,
      },
    },
    messages: {
      inputFname: {
        required: "กรุณากรอกชื่อจริง!",
      },
      inputLname: {
        required: "กรุณากรอกนามสกุล!",
      },
      inputStdID: {
        required: "กรุณาเลือกกรอกรหัสนักศึกษา!",
        number: "รหัสนักศึกษาต้องเป็นตัวเลขเท่านั้น!",
      },
      inputEmail: {
        required: "กรุณากรอกอีเมลล์!",
        email: "กรุณาตรวจสอบความถูกต้องของอีเมล์!",
      },
      inputPassword: {
        minlength: "รหัสผ่านต้องมีความยาวมากกว่า 5 ตัวอักษร!",
      },
      inputStatus: {
        required: "กรุณาเลือกสถานะ!",
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    },
  });
});
