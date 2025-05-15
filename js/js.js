
// navbar
const navSlide = () =>{
    const burger = document.querySelector(".burger")
    const navLists = document.querySelector("nav")
    burger.addEventListener("click",() => {
        navLists.classList.toggle("nav-active")
        burger.classList.toggle("toogle-burger")
    });
};

navSlide();

// informasi
document.querySelectorAll("details").forEach((detail) => {
    detail.addEventListener("toggle", function () {
      let content = this.querySelector("p"); // Ambil elemen <p> di dalam <details>
  
      if (this.open) {
        let height = content.scrollHeight; // Dapatkan tinggi asli elemen
        content.style.maxHeight = height + "px"; // Set max-height agar smooth saat dibuka
        content.style.opacity = "1";
      } else {
        content.style.maxHeight = "0"; // Set max-height 0 agar smooth saat ditutup
        content.style.opacity = "0";
      }
    });
  });

  // Tambahkan modal image viewer saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    const images = document.querySelectorAll(".view-image");

    images.forEach(function (imgBtn) {
        imgBtn.addEventListener("click", function () {
            const imagePath = imgBtn.getAttribute("data-image-path");

            // Buat modal
            const modal = document.createElement("div");
            modal.classList.add("modal");
            modal.id = "imageModal";

            const closeBtn = document.createElement("span");
            closeBtn.classList.add("modal-close");
            closeBtn.innerHTML = "&times;";

            const modalImg = document.createElement("img");
            modalImg.classList.add("modal-content");
            modalImg.src = imagePath;

            const downloadBtn = document.createElement("a");
            downloadBtn.href = imagePath;
            downloadBtn.download = imagePath.split('/').pop();
            downloadBtn.classList.add("modal-download");
            downloadBtn.innerText = "⬇ Download";

            // Tambahkan elemen ke body
            modal.appendChild(closeBtn);
            modal.appendChild(modalImg);
            //  modal.appendChild(downloadBtn);
            document.body.appendChild(modal);

            // Tampilkan modal
            modal.style.display = "block";

            // Fungsi close modal
            closeBtn.onclick = function () {
                modal.remove();
            };

            // Klik di luar gambar juga menutup modal
            modal.onclick = function (event) {
                if (event.target === modal) {
                    modal.remove();
                }
            };
        });
    });
});


