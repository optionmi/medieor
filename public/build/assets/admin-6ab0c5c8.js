document.addEventListener("DOMContentLoaded",function(){document.addEventListener("click",d);var r,l;function d(e){r=e.target.closest("[data-delete-route]"),r&&(e.preventDefault(),l=r.dataset.deleteRoute)}document.getElementById("confirmDeleteBtn").addEventListener("click",()=>{c()});function c(){fetch(l).then(e=>e.json()).then(e=>{e.error==!0?toastr.error(e.message,"Admin Panel"):toastr.success(e.message,"Admin Panel")}),r.parentElement.parentElement.parentElement.remove()}document.addEventListener("click",function(e){const t=e.target.closest("[data-row-data]");if(!t)return;e.preventDefault();const o=t.dataset.updateRoute,n=JSON.parse(t.dataset.rowData);document.getElementById("updateDataForm").setAttribute("action",o),Array.from(document.querySelectorAll(".updateDataField")).forEach((a,i)=>{a.value=n[i]})}),$("form").submit(function(e){$("#loading").toggleClass("d-none"),$("body").css("overflow","hidden"),e.preventDefault();const t=$(this),o=t.attr("action"),n=t.attr("method"),s=new FormData(this);$.ajax({url:o,type:n,data:s,contentType:!1,processData:!1,success:function(a){$("#loading").toggleClass("d-none"),$("body").css("overflow","auto"),a.error==!0?toastr.error(a.message,"Admin Panel"):(toastr.success(a.message,"Admin Panel"),t.parents(".modal").length>0&&t[0].reset(),$(".modal").modal("hide"),$(".dataTable").DataTable().draw())},error:function(a){$("#loading").toggleClass("d-none"),$("body").css("overflow","auto"),console.error("Error:",a)}})}),$(".modal").on("hidden.coreui.modal",function(){$(this).find("form").trigger("reset")}),$("[data-table-route]").each(function(e){const o=$(this).attr("data-table-route"),n=$(this).find("th").map(function(s,a){return{data:$(this).text()==="#"?"serial":$(this).text().toLowerCase(),name:$(this).text(),searchable:$(this).text()!=="#"&&$(this).text()!=="Actions",orderable:$(this).text()!=="Actions",defaultContent:"NA"}});$("[data-table-route]").DataTable({language:{zeroRecords:"No record(s) found."},processing:!0,serverSide:!0,lengthChange:!0,order:[0,"asc"],searchable:!0,bStateSave:!1,ajax:{url:o,data:function(s){}},columns:n})})});
