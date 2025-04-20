var cart = document.getElementById("cart");
var arrowL = document.querySelector(".bi-caret-left");
var arrowR = document.querySelector(".bi-caret-right");
var a = document.getElementById("acart");
var navright = document.querySelector(".nav-right");
var adm = document.getElementById("adm-add-produto");

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

const slides = document.querySelectorAll(".slide");
const prevBtn = document.querySelector(".nav.prev");
const nextBtn = document.querySelector(".nav.next");
let current = 0;

function showSlide(index) {
    slides[current].classList.remove("active");
    current = (index + slides.length) % slides.length;
    slides[current].classList.add("active");
}

nextBtn.addEventListener("click", () => {
    showSlide(current + 1);
});

prevBtn.addEventListener("click", () => {
    showSlide(current - 1);
});

setInterval(() => {
    showSlide(current + 1);
}, 10000);

arrowL.addEventListener("mouseenter", function () {
    arrowL.classList.replace("bi-caret-left", "bi-caret-left-fill");
});

arrowL.addEventListener("mouseleave", function () {
    arrowL.classList.replace("bi-caret-left-fill", "bi-caret-left");
});

arrowR.addEventListener("mouseenter", function () {
    arrowR.classList.replace("bi-caret-right", "bi-caret-right-fill");
});

arrowR.addEventListener("mouseleave", function () {
    arrowR.classList.replace("bi-caret-right-fill", "bi-caret-right");
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

function administrador() {
    navright.style.width = "400px";
    adm.style.display = "block";
}

const precos = document.querySelectorAll('.preco');

precos.forEach(span => {
  if (!span.textContent.includes('R$')) {
    span.textContent = 'R$ ' + span.textContent;
  }
});