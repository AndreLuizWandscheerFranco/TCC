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

var msgCookies = document.getElementById("cookies-msg");

function aceito() {
    localStorage.lgpd = "sim";
    msgCookies.classList.remove("mostrar");
}

if (localStorage.lgpd == "sim") {
    msgCookies.classList.remove("mostrar");
} else {
    msgCookies.classList.add("mostrar");
}

const precos = document.querySelectorAll(".preco");

precos.forEach((span) => {
    if (!span.textContent.includes("R$")) {
        span.textContent = "R$ " + span.textContent;
    }
});
