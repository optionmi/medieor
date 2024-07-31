import { Modal, Ripple, initTWE } from "tw-elements";
initTWE({ Modal, Ripple });

document.addEventListener("DOMContentLoaded", function () {
  const quill1 = new Quill("#description", {
    theme: "snow",
  });

  const groupLogoPreview = document.getElementById("groupLogoPreview");

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
          toastr.error(data.message);
        } else {
          toastr.success(data.message);
        }
      });
    deleteBtn.parentElement.parentElement.remove();
  }

  // Update
  document.addEventListener("click", function (e) {
    const el = e.target.closest("[data-row-data]");
    if (!el) return;
    e.preventDefault();
    const updateRoute = el.dataset.updateRoute;
    const rowData = JSON.parse(el.dataset.rowData);
    const groupLogoImage = el.dataset.groupLogo;
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

    quill1.root.innerHTML = $("#hiddenDescription").val();
    quill1.on("text-change", function (delta, oldDelta, source) {
      $("#hiddenDescription").val(quill1.root.innerHTML);
    });

    groupLogoPreview.src = groupLogoImage;
  });
});
