var cart = document.getElementById("cart");
var a = document.getElementById("acart");

const produtos = [
    { nome: "fone", img: "", preco: 24.99 },
    { nome: "fone", img: "", preco: 24.99 },
];

a.addEventListener("mouseenter", function () {
    cart.classList.replace("bi-cart", "bi-cart-fill");
});

a.addEventListener("mouseleave", function () {
    cart.classList.replace("bi-cart-fill", "bi-cart");
});

let lastScrollY = window.scrollY;

window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    const subMenu = document.querySelector("#sub-menu");

    if (window.scrollY > lastScrollY) {
        header.classList.add("hidden");
        subMenu.classList.add("hidden2");
    } else {
        header.classList.remove("hidden");
        subMenu.classList.remove("hidden2");
    }

    lastScrollY = window.scrollY;
});

VanillaTilt.init(document.querySelectorAll(".produto"), {
    max: 25,
    speed: 400,
    glare: true,
    "max-glare": 0.1,
});


