document.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".card-body [data-delete-route]").forEach(function(t){t.addEventListener("click",function(o){var e=t.dataset.deleteRoute;const n=this;document.getElementById("confirmDeleteBtn").addEventListener("click",function(r){s(n,e)})})});const s=(t,o)=>{fetch(o).then(e=>e.json()).then(e=>{switch(e.type){case"success":toastr.success(e.message,"Admin Panel");break;case"error":toastr.error(e.message,"Admin Panel");break}}),console.log(t.parentElement.parentElement.remove())};document.addEventListener("click",function(t){const o=t.target.closest("[data-row-data]");if(!o)return;t.preventDefault();const e=o.dataset.updateRoute,n=JSON.parse(o.dataset.rowData);document.getElementById("updateDataForm").setAttribute("action",e),Array.from(document.querySelectorAll(".updateDataField")).forEach((a,c)=>{a.value=n[c]})}),$("form").submit(function(t){t.preventDefault();const o=$(this),e=o.attr("action"),n=o.attr("method"),r=new FormData(this);$.ajax({url:e,type:n,data:r,contentType:!1,processData:!1,success:function(a){a.error==!0?toastr.error(a.message,"Admin Panel"):(toastr.success(a.message,"Admin Panel"),$(".modal").modal("hide"),$(".dataTable").DataTable().draw())},error:function(a){console.error("Error:",a)}})})});
