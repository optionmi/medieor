document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", handleDeleteClick);

  var deleteBtn;
  var deleteRoute;

  function handleDeleteClick(event) {
    deleteBtn = event.target.closest("[data-delete-route]");
    if (!deleteBtn) return;
    event.preventDefault();
    deleteRoute = deleteBtn.dataset.deleteRoute;
  }

  document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
    deleteRow();
  });

  function deleteRow() {
    fetch(deleteRoute)
      .then((response) => response.json())
      .then((data) => {
        if (data.error == true) {
          toastr.error(data.message, "Admin Panel");
        } else {
          toastr.success(data.message, "Admin Panel");
        }
      });
    deleteBtn.parentElement.parentElement.parentElement.remove();
  }

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
    $("#loading").toggleClass("d-none");
    $("body").css("overflow", "hidden");
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
        $("#loading").toggleClass("d-none");
        $("body").css("overflow", "auto");
        if (data.error == true) {
          toastr.error(data.message, "Admin Panel");
        } else {
          toastr.success(data.message, "Admin Panel");
          if (form.parents(".modal").length > 0) {
            form[0].reset();
          }
          $(".modal").modal("hide");
          $(".dataTable").DataTable().draw();
        }
      },
      error: function (error) {
        $("#loading").toggleClass("d-none");
        $("body").css("overflow", "auto");
        console.error("Error:", error);
      },
    });
  });

  // Reset form on modal hidden
  $(".modal").on("hidden.coreui.modal", function () {
    $(this).find("form").trigger("reset");
  });

  // DataTable
  $("[data-table-route]").each(function (e) {
    const table = $(this);
    const route = table.attr("data-table-route");

    const columns = $(this)
      .find("th")
      .map(function (val, index) {
        return {
          data:
            $(this).text() === "#"
              ? "serial"
              : $(this).text() === "Category"
              ? "category.title"
              : $(this).text() === "Categories"
              ? "categories_names"
              : $(this).text().toLowerCase(),
          name: $(this).text(),
          searchable: $(this).text() !== "#" && $(this).text() !== "Actions",
          orderable: $(this).text() !== "Actions",
          defaultContent: "NA",
        };
      });

    $("[data-table-route]").DataTable({
      language: {
        zeroRecords: "No record(s) found.",
      },
      processing: true,
      serverSide: true,
      lengthChange: true,
      order: [0, "asc"],
      searchable: true,
      bStateSave: false,

      ajax: {
        url: route,
        data: function (d) {},
      },
      columns: columns,
    });
  });

  // Reset User's Password
  $(document).on("click", "[data-password-reset-route]", function (e) {
    const route = $(this).data("password-reset-route");
    fetch(route)
      .then((res) => res.json())
      .then((data) => {
        if (data.error == true) {
          toastr.error(data.message, "Admin Panel");
        } else {
          toastr.success(data.message, "Admin Panel");
        }
      });
  });

  // DOMContentLoaded
});
