import{l,a as m,H as s}from"./tw-elements.es.min-563fcd5f.js";l({Modal:m,Ripple:s});document.addEventListener("DOMContentLoaded",function(){const a=document.getElementById("videoModal"),e=document.getElementById("modalVideo");a.addEventListener("show.twe.modal",d=>{const t=d.relatedTarget.dataset.videoUrl;e.src=t,e.load(),e.play()}),a.addEventListener("hide.twe.modal",d=>{e.src=""});const o=document.getElementById("imageModal"),n=document.getElementById("modalImage");o.addEventListener("show.twe.modal",d=>{const t=d.relatedTarget.dataset.imageUrl;n.src=t})});
