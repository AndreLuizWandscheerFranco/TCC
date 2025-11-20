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
const estadoCidadeInput = document.querySelector('input[name="estado_cidade"]');

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

function adicionar(elemento) {
    fetch("verifica_login.php")
        .then((response) => response.json())
        .then((data) => {
            if (!data.logado) {
                window.location.href = "../carrinho/carrinho.html";
                return;
            }
        });

    const produto = elemento.closest(".produto");

    const nome = produto.querySelector("h1").innerText;
    const preco = produto.querySelector(".preco").innerText;
    const img = produto.querySelector("img").getAttribute("src");
    const descricao = produto.querySelector(".descricao").innerText;

    const item = {
        nome: nome,
        preco: preco,
        img: img,
        descricao: descricao,
        quantidade: 1,
    };

    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    let existente = carrinho.find((i) => i.nome === item.nome);

    if (existente) {
        existente.quantidade += 1;
    } else {
        carrinho.push(item);
    }

    localStorage.setItem("carrinho", JSON.stringify(carrinho));

    window.location.href = "../carrinho/destino2.html";
}

fetch("./produtos.php")
    .then((response) => response.json())
    .then((produtos) => {
        const container = document.getElementById("produtos-container");
        container.innerHTML = "";

        produtos.forEach((produto) => {
            const avaliacao = Math.round(produto.avaliacao);
            let estrelas = "";
            for (let i = 0; i < 5; i++) {
                estrelas +=
                    i < avaliacao
                        ? '<i class="bi bi-star-fill"></i>'
                        : '<i class="bi bi-star"></i>';
            }

            container.innerHTML += `
                <div class="produto">
                    <h1>${produto.nome}</h1>
                    <img class="teste" src="../imagens_produtos/${produto.imagem}" alt="img">
                    <div class="infos">
                        <p>${estrelas}</p>
                        <p class="descricao">${produto.descricao}</p>
                        <span class="preco">R$${produto.valor}</span>
                    </div>
                    <div class="btn-info-compra">
                        <span class="add-cart" onclick="adicionar(this)">
                            <i class="bi bi-cart"></i>
                        </span>
                    <button class="btn-compra" type="button">
                        <a href="../compra/index.html?id=${produto.id}">Comprar</a>
                    </button>
                    </div>
                </div>
            `;
        });
    });

function comprarProduto(id) {
    fetch("./produtos.php")
        .then((response) => response.json())
        .then((produtos) => {
            const produto = produtos.find((p) => p.id == id);
            if (produto) {
                localStorage.setItem(
                    "produtoSelecionado",
                    JSON.stringify(produto)
                );
                window.location.href = "../compra/index.html";
            } else {
                alert("Produto não encontrado.");
            }
        });
}

document.addEventListener("DOMContentLoaded", () => {
    const inputBusca = document.querySelector(".input-buscar input");
    const container = document.getElementById("produtos-container");

    inputBusca.addEventListener("input", () => {
        const termo = inputBusca.value.toLowerCase();
        const produtos = container.querySelectorAll(".produto");

        produtos.forEach((produto) => {
            const nome = produto.querySelector("h1").innerText.toLowerCase();

            if (nome.includes(termo)) {
                produto.style.display = "block";
            } else {
                produto.style.display = "none";
            }
        });
    });
});


