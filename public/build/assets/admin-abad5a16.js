document.addEventListener("DOMContentLoaded",function(){document.addEventListener("click",c);var n,s;function c(e){n=e.target.closest("[data-delete-route]"),n&&(e.preventDefault(),s=n.dataset.deleteRoute)}document.getElementById("confirmDeleteBtn").addEventListener("click",()=>{l()});function l(){fetch(s).then(e=>e.json()).then(e=>{e.error==!0?toastr.error(e.message,"Admin Panel"):toastr.success(e.message,"Admin Panel")}),n.parentElement.parentElement.parentElement.remove()}document.addEventListener("click",function(e){const t=e.target.closest("[data-row-data]");if(!t)return;e.preventDefault();const a=t.dataset.updateRoute,o=JSON.parse(t.dataset.rowData);document.getElementById("updateDataForm").setAttribute("action",a),Array.from(document.querySelectorAll(".updateDataField")).forEach((r,u)=>{r.value=o[u]})}),$("form").submit(function(e){e.preventDefault();const t=$(this),a=t.attr("action"),o=t.attr("method"),d=new FormData(this);$.ajax({url:a,type:o,data:d,contentType:!1,processData:!1,success:function(r){r.error==!0?toastr.error(r.message,"Admin Panel"):(toastr.success(r.message,"Admin Panel"),t[0].reset(),$(".modal").modal("hide"),$(".dataTable").DataTable().draw())},error:function(r){console.error("Error:",r)}})}),$(".modal").on("hidden.coreui.modal",function(){$(this).find("form").trigger("reset")})});
