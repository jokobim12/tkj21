const navSlide = () =>{
    const burger = document.querySelector(".burger")
    const navLists = document.querySelector("nav")
    burger.addEventListener("click",() => {
        navLists.classList.toggle("nav-active")
        burger.classList.toggle("toogle-burger")
    });
};

navSlide();