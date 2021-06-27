const navToggle1 = document.querySelector("#navToggle1");
const navClosedIcon1 = document.querySelector("#navClosed1");
const navOpenIcon1 = document.querySelector("#navOpen1");
const navIcon1 = document.querySelectorAll(".navIcon1");
const nav1 = document.querySelectorAll(".nav1");

navToggle1.addEventListener("click", () => {
    nav1.classList.toggle("open");
    navIcon1.forEach((icon) => {
        icon.classList.toggle("hidden");
    });
});


window.addEventListener(
    "resize", () => {
        if (document.body.clientWidth > 720) {
            nav1.classList.remove("open");
            navIcon1.forEach((icon) => {
                icon.classList.remove("hidden");
            });
            navOpenIcon1.classList.add("hidden");
        }
    }, { passive: false }
);