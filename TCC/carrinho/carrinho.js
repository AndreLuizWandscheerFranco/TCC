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

function carregarCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    const container = document.getElementById("carrinho-container");
    const totalElement = document.getElementById("total");

    container.innerHTML = "";

    if (carrinho.length === 0) {
        container.innerHTML = "<p>Seu carrinho está vazio.</p>";
        if (totalElement) totalElement.innerText = "Total: R$ 0,00";
        return;
    }

    let soma = 0;
    let quantidadeTotal = 0;

    carrinho.forEach((produto, index) => {
        let precoNum = parseFloat(
            produto.preco.replace("R$", "").replace(".", "").replace(",", ".")
        );
        soma += precoNum * produto.quantidade;
        quantidadeTotal += produto.quantidade;

        let precoFormatado = precoNum.toFixed(2).replace(".", ",");

        container.innerHTML += `
            <div class="part">
                <div class="img-p-car">
                    <img src="${produto.img}" alt="produto">
                </div>
                <div class="desc">
                    <h3>${produto.nome}</h3>
                    <p style="color: green;">Em estoque</p>
                    <p id="preco">R$ ${precoFormatado}</p>
                     <p><strong>Descrição:</strong> ${produto.descricao}</p> 

                    <div class="contador">
                        <button class="btnsprod" onclick="diminuir(${index})">-</button>
                        <span>${produto.quantidade}</span>
                        <button class="btnsprod" onclick="aumentar(${index})">+</button>
                    </div>

                    <button id="rmvcar" onclick="remover(${index})"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        `;
    });

    let somaFormatada = soma.toFixed(2).replace(".", ",");
    totalElement.innerText = `Total (${quantidadeTotal} produtos): R$ ${somaFormatada}`;

    atualizarTotalPagamento();
}

function remover(index) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

    carrinho.splice(index, 1);

    localStorage.setItem("carrinho", JSON.stringify(carrinho));

    carregarCarrinho();
    atualizarTotalPagamento();
}

function removetudo() {
    localStorage.removeItem("carrinho");
    carregarCarrinho();
    atualizarTotalPagamento();
}

function atualizarTotalPagamento() {
    const carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    const totalElement = document.getElementById("total-pag");

    if (!totalElement) return;

    if (carrinho.length === 0) {
        totalElement.innerText = "Total: R$ 0,00";
        return;
    }

    let soma = 0;
    let quantidadeTotal = 0;

    carrinho.forEach((produto) => {
        let precoNum = parseFloat(
            String(produto.preco)
                .replace("R$", "")
                .replace(".", "")
                .replace(",", ".")
                .trim()
        );
        soma += precoNum * produto.quantidade;
        quantidadeTotal += produto.quantidade;
    });

    let somaFormatada = soma.toFixed(2).replace(".", ",");

    totalElement.innerText = `Total (${quantidadeTotal} produtos): R$ ${somaFormatada}`;
}

function aumentar(index) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    carrinho[index].quantidade += 1;
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    carregarCarrinho();
    atualizarTotalPagamento();
}

function diminuir(index) {
    let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];
    if (carrinho[index].quantidade > 1) {
        carrinho[index].quantidade -= 1;
    } else {
        carrinho.splice(index, 1);
    }
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    carregarCarrinho();
    atualizarTotalPagamento();
}

window.onload = function () {
    carregarCarrinho();
    atualizarTotalPagamento();
};
