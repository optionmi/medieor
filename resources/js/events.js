import { Modal, Ripple, initTWE } from "tw-elements";
initTWE({ Modal, Ripple });

document.addEventListener("DOMContentLoaded", function () {
  const videoModal = document.getElementById("videoModal");
  const modalVideo = document.getElementById("modalVideo");
  videoModal.addEventListener("show.twe.modal", (e) => {
    const videoUrl = e.relatedTarget.dataset.videoUrl;
    modalVideo.src = videoUrl;
    modalVideo.load();
    modalVideo.play();
  });

  videoModal.addEventListener("hide.twe.modal", (e) => {
    modalVideo.src = "";
  });
});
