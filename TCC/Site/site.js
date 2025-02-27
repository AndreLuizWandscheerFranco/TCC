var cart = document.getElementById("cart");
var a = document.getElementById("acart");

const produtos = [
    {nome:"fone", img:"", preco: 24.99},
    {nome:"fone", img:"", preco: 24.99},
]

a.addEventListener("mouseenter", function () {
    cart.classList.replace("bi-cart", "bi-cart-fill");
});

a.addEventListener("mouseleave", function () {
    cart.classList.replace("bi-cart-fill", "bi-cart");
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

VanillaTilt.init(document.querySelectorAll(".produto"), {
    max: 25,
    speed: 400,
    glare: true,
});
