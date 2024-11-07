import "./bootstrap";
import "flowbite";
// import { Modal } from "flowbite";
import $ from "jquery";
import toastr from "toastr";
import { Modal, Ripple, initTWE } from "tw-elements";
initTWE({ Modal, Ripple });

document.addEventListener("DOMContentLoaded", function () {
  // Delete
  document.addEventListener("click", handleDeleteClick);

  var deleteBtn;
  var deleteRoute;

  function handleDeleteClick(event) {
    deleteBtn = event.target.closest("[data-delete-route]");
    if (!deleteBtn) return;
    event.preventDefault();
    deleteRoute = deleteBtn.dataset.deleteRoute;
  }

  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
  if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener("click", () => {
      deleteRow(deleteBtn);
    });
  }

  function deleteRow(deleteBtn) {
    fetch(deleteRoute, {
      method: "delete",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.error == true) {
          toastr.error(data.message);
        } else {
          toastr.success(data.message);
          deleteBtn.closest("li").remove();
        }
      });
  }

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

  // Check All Checkboxes
  $("#checkAll").on("change", function () {
    $("input:checkbox").prop("checked", $(this).prop("checked"));
  });
  // Refresh Captcha
  $("#refresh-captcha").on("click", function () {
    fetch("/refresh-captcha")
      .then((response) => response.json())
      .then((data) => {
        console.log(data.captcha);
        document.querySelector("#captchaImg").innerHTML = data.captcha;
      });
  });

  $(".togglePassword").on("click", function () {
    $(this).find("i").toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).parent().find("input"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
  });
}); // DOMContentLoaded
