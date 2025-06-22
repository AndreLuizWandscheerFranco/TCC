const inputs = document.querySelectorAll(".input");
const button = document.querySelector(".login_button");
const erro_input = document.querySelector(".erro_input");
const erro_input_senha = document.querySelector(".erro_input_senha");
const erro_input_nome = document.querySelector(".erro_input_nome");

let timeoutId;

const limpar_inputs = () => {
    inputs.forEach((input) => {
        input.value = "";
        input.classList.remove("valido", "invalido");
        erro_input.style.display = "none";
        erro_input_senha.style.display = "none";
    });
    button.setAttribute("disabled", "");
};

window.addEventListener("pageshow", limpar_inputs);

const digitado = {
    nome: false,
    email: false,
    senha: false,
};

const eventofoco = ({ target }) => {
    const span = target.previousElementSibling;
    span.classList.add("span-ativo");
};

const eventofocoout = ({ target }) => {
    if (target.value === "") {
        const span = target.previousElementSibling;
        span.classList.remove("span-ativo");
    }

    digitado[target.name] = true;
    eventoinserir();
};

const login_button = (event) => {
    event.preventDefault();
    window.location = "../Site/index.html";
};

const eventoinserir = () => {
    const [nome, email, senha] = inputs;

    if (digitado.nome) {
        if (nome.value.trim() !== "") {
            nome.classList.add("valido");
            nome.classList.remove("invalido");
            erro_input_nome.style.display = "none";
        } else {
            nome.classList.add("invalido");
            nome.classList.remove("valido");
            erro_input_nome.style.display = "block";
        }
    }

    if (validarEmail(email.value)) {
        email.classList.add("valido");
        email.classList.remove("invalido");
        erro_input.style.display = "none";
    } else if (email.value !== "") {
        email.classList.add("invalido");
        email.classList.remove("valido");
        erro_input.style.display = "block";
    } else {
        erro_input.style.display = "none";
        email.classList.remove("invalido");
        email.classList.remove("valido");
    }

    if (senha.value.length >= 8 && validarSenha(senha.value)) {
        senha.classList.add("valido");
        senha.classList.remove("invalido");
        erro_input_senha.style.display = "none";
    } else if (senha.value !== "") {
        senha.classList.add("invalido");
        senha.classList.remove("valido");
        erro_input_senha.style.display = "block";
    } else {
        erro_input_senha.style.display = "none";
        senha.classList.remove("invalido");
        senha.classList.remove("valido");
    }

    if (
        nome.value &&
        validarEmail(email.value) &&
        senha.value.length >= 8 &&
        validarSenha(senha.value)
    ) {
        button.removeAttribute("disabled");
        button.addEventListener("click", login_button);
    } else {
        button.setAttribute("disabled", "");
    }
};

const eventoInput = (e) => {
    digitado[e.target.name] = true;

    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        eventoinserir();
    }, 1000);
};

const validarEmail = (email) => {
    const regex = /^[^\s@]+@(gmail\.com|hotmail\.com|outlook\.com)$/i;
    return regex.test(email);
};

const validarSenha = (senha) => {
    const regex = /^[a-zA-Z0-9]+$/;
    return regex.test(senha);
};

function mostrarsenha() {
    var inputPass = document.getElementById("pass");
    var BtnShowPass = document.getElementById("btn-senha");

    if (inputPass.type === "password") {
        inputPass.setAttribute("type", "text");
        BtnShowPass.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        inputPass.setAttribute("type", "password");
        BtnShowPass.classList.replace("bi-eye-slash", "bi-eye");
    }
}

inputs.forEach((input) => input.addEventListener("input", eventoInput));
inputs.forEach((input) => input.addEventListener("focus", eventofoco));
inputs.forEach((input) => input.addEventListener("focusout", eventofocoout));
