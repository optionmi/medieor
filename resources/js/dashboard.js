document.addEventListener("DOMContentLoaded", function () {
  const quill1 = new Quill("#description", {
    theme: "snow",
  });

  const groupLogoPreview = document.getElementById("groupLogoPreview");

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
