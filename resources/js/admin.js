// jQuery
// $(function () {
//   // DataTable
//   $(".dataTable").DataTable();
//   // End DataTable
// });

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll(".card-body [data-delete-route]")
    .forEach(function (el) {
      el.addEventListener("click", function (e) {
        var deleteRoute = el.dataset.deleteRoute;
        const deleteBtn = this;
        document
          .getElementById("confirmDeleteBtn")
          .addEventListener("click", function (e) {
            deleteRow(deleteBtn, deleteRoute);
          });
      });
    });

  const deleteRow = (deleteBtn, deleteRoute) => {
    fetch(deleteRoute)
      .then((res) => res.json())
      .then((data) => {
        // console.log(data.type);
        switch (data.type) {
          case "success":
            toastr.success(data.message, "Admin Panel");
            break;
          case "error":
            toastr.error(data.message, "Admin Panel");
            break;
        }
      });
    console.log(deleteBtn.parentElement.parentElement.remove());
    return;
  };

  // Update
  document.addEventListener("click", function (e) {
    const el = e.target.closest("[data-row-data]");
    if (!el) return;
    e.preventDefault();
    const updateRoute = el.dataset.updateRoute;
    // console.log(updateRoute);
    const rowData = JSON.parse(el.dataset.rowData);
    // console.log(rowData[0]);
    const form = document.getElementById("updateDataForm");
    form.setAttribute("action", updateRoute);
    //   // console.log(JSON.parse(this.dataset.rowData)[1]);
    Array.from(document.querySelectorAll(".updateDataField")).forEach(
      (el, index) => {
        //   console.log((el.value = rowData[index]));
        el.value = rowData[index];
        // handle different types of input fields
        // console.log(rowData[index]);
        //   if (rowData[index][0] == "text") {
        //     el.value = rowData[index][1].replace(/=/g, " ");
        //   }
        //   if (rowData[index][0] == "select") {
        //     // update value for select input
        //     el.value = rowData[index][1];
        //     }
      }
    );
  });

  $("form").submit(function (e) {
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
        if (data.error == true) {
          toastr.error(data.message, "Admin Panel");
        } else {
          toastr.success(data.message, "Admin Panel");
          $(".modal").modal("hide");
          $(".dataTable").DataTable().draw();
        }
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  });

  // DOMContentLoaded
});
