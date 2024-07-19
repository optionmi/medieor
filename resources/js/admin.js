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
    fetch(deleteRoute, {
      method: "delete",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    })
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
    const rowData = JSON.parse(el.dataset.rowData);
    let selectOptionsData;
    if (el.dataset.selectOptions) {
      selectOptionsData = JSON.parse(el.dataset.selectOptions);
    }
    const form = document.getElementById("updateDataForm");
    form.setAttribute("action", updateRoute);
    //   // console.log(JSON.parse(this.dataset.rowData)[1]);
    Array.from(document.querySelectorAll(".updateDataField")).forEach(
      (el, index) => {
        el.value = rowData[index];
      }
    );
    Array.from(document.querySelectorAll(".selectOptions")).forEach(
      (el, index) => {
        // Remove existing options
        while (el.firstChild) {
          el.removeChild(el.firstChild);
        }
        // Add new options
        if (selectOptionsData[index].length > 0) {
          selectOptionsData[index].forEach((option) => {
            const optionElement = document.createElement("option");
            optionElement.value = option.id;
            optionElement.textContent = option.name;
            el.appendChild(optionElement);
          });
        } else {
          const optionElement = document.createElement("option");
          optionElement.value = "";
          optionElement.textContent = "No topics found for this category!";
          el.appendChild(optionElement);
        }
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
        toastr.error("Something went wrong!", "Admin Panel");
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
              ? "category_title"
              : $(this).text() === "Group"
              ? "group_title"
              : $(this).text() === "Topic"
              ? "topic_name"
              : $(this).text() === "Categories"
              ? "categories_names"
              : $(this).text() === "Media"
              ? "media_file"
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
  $(document).on("click", "[data-btn-route]", function (e) {
    const route = $(this).data("btn-route");
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

  // Category Topics Options
  $("#categoryPostCategory").on("change", function () {
    // Get selected option element
    const selected = $(this).find("option:selected");
    const url = selected.data("topics-route");
    const el = document.getElementById("categoryPostTopic");
    // Remove existing options
    while (el.firstChild) {
      el.removeChild(el.firstChild);
    }
    fetch(url)
      .then((res) => res.json())
      .then((data) => {
        // Add new options
        if (data.length > 0) {
          data.forEach((option) => {
            const optionElement = document.createElement("option");
            optionElement.value = option.id;
            optionElement.textContent = option.name;
            el.appendChild(optionElement);
          });
        } else {
          const optionElement = document.createElement("option");
          optionElement.value = "";
          optionElement.textContent = "No topics found for this category!";
          el.appendChild(optionElement);
        }
      });
  });

  // DOMContentLoaded
});
