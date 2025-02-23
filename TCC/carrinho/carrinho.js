var cart = document.getElementById("cart");
var a = document.getElementById("acart");

a.addEventListener("mouseenter", function () {
    cart.classList.replace("bi-cart-fill", "bi-cart");
});

a.addEventListener("mouseleave", function () {
    cart.classList.replace("bi-cart", "bi-cart-fill");
});

let lastScrollY = window.scrollY;

window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    if (window.scrollY > lastScrollY) {
        header.classList.add("hidden");
    } else {
        header.classList.remove("hidden");
    }
    lastScrollY = window.scrollY;
});
