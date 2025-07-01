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

function abrirformcep() {
    const janela = document.getElementById("cepform");
    janela.classList.add("abrirformcep");
    document.body.classList.add("bloqueia-scroll");

    janela.addEventListener("click", (e) => {
        if (e.target.id == "fechar") {
            janela.classList.remove("abrirformcep");
            document.body.classList.remove("bloqueia-scroll");
        }
    });
}

const cepInput = document.querySelector('input[name="cep"]');
const estadoCidadeInput = document.querySelector('input[name="estado-cidade"]');

cepInput.addEventListener("blur", () => {
    const cep = cepInput.value.replace(/\D/g, "");

    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then((response) => response.json())
            .then((data) => {
                if (!data.erro) {
                    estadoCidadeInput.value = `${data.uf} - ${data.localidade}`;
                } else {
                    alert("CEP não encontrado!");
                    estadoCidadeInput.value = "";
                }
            })
            .catch(() => {
                alert("Erro ao buscar o CEP!");
            });
    }
});

const btnFechar = document.getElementById("fechar");
const formulario = document.querySelector(".formform");

btnFechar.addEventListener("click", function (e) {
    e.preventDefault();
    formulario.reset();
});

