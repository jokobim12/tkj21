
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