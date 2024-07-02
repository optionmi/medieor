import "./bootstrap";
import "flowbite";
// import { Modal } from "flowbite";
import $ from "jquery";
import toastr from "toastr";

document.addEventListener("DOMContentLoaded", function () {
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
          if (data.reload) {
            location.reload();
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

  const showDonationSubmitModalBtn = document.querySelector(
    "#showDonationSubmitModalBtn"
  );

  if (showDonationSubmitModalBtn) {
    const donationSubmitModalElement = document.getElementById(
      "donationSubmitModal"
    );
    // const donationSubmitModal = new Modal(donationSubmitModalElement);

    showDonationSubmitModalBtn.addEventListener("click", (e) => {
      e.preventDefault();
      const action = document.getElementById("action").value.trim();
      const errorElement = document.getElementById("error-action");

      errorElement.classList.toggle("hidden", action !== "");

      if (action) {
        // donationSubmitModal.show();
        window.FlowbiteInstances.getInstance(
          "Modal",
          "donationSubmitModal"
        )?.show();

        const actionHidden = document.getElementById("actionHidden");
        actionHidden.value = action;

        const whetherRegisterSelect = document.getElementById("register");
        whetherRegisterSelect.addEventListener("change", (e) => {
          const whetherRegister = e.target.value;
          const passwordElement = document.querySelector("#password");
          passwordElement.classList.toggle("flex", whetherRegister === "yes");
          passwordElement.classList.toggle("hidden", whetherRegister === "no");
        });
      }
    });
  }
}); // DOMContentLoaded
