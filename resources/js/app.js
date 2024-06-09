import "./bootstrap";
import "flowbite";

$(".smoothSubmit").submit(function (e) {
  $("#loading").toggleClass("hidden").toggleClass("flex");
  $("body").toggleClass("overflow-hidden");
  e.preventDefault();
  const form = $(this);
  const submitUrl = form.attr("action");
  const method = form.attr("method");
  const formData = new FormData(this);
  $.ajax({
    url: submitUrl,
    type: method,
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#loading").toggleClass("hidden").toggleClass("flex");
      $("body").toggleClass("overflow-hidden");
      $(".error").text(""); // Clear previous errors
      if (data.errors == true) {
        toastr.error(data.message, "Medieor");
      } else {
        toastr.success(data.message, "Medieor");
        if (form.parents(".modal").length > 0) {
          form[0].reset();
        }
        // $(".modal").modal("hide");
        // $(".dataTable").DataTable().draw();
      }
    },
    error: function (response) {
      $("#loading").toggleClass("hidden").toggleClass("flex");
      $("body").toggleClass("overflow-hidden");
      if (response.status === 422) {
        $(".error").text(""); // Clear previous errors
        $.each(response.responseJSON.errors, function (key, value) {
          $("#error-" + key).text(value[0]);
        });
      }
    },
    // error: function (error) {
    //   console.error("Error:", error);
    // },
  });
});
