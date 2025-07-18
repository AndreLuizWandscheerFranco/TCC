const inputs = document.querySelectorAll(".input");
const button = document.querySelector(".login_button");
const erro_input = document.querySelector(".erro_input");
const erro_input_senha = document.querySelector(".erro_input_senha");
const erro_input_nome = document.querySelector(".erro_input_nome");
const erro_input_cpf = document.querySelector(".erro_input_cpf");
const inputCPF = document.getElementById("cpf");

let timeoutId;

const limpar_inputs = () => {
    inputs.forEach((input) => {
        input.value = "";
        input.classList.remove("valido", "invalido");
        erro_input.style.display = "none";
        erro_input_senha.style.display = "none";
        erro_input_nome.style.display = "none";
        erro_input_cpf.style.display = "none";
    });
    button.setAttribute("disabled", "");
};

window.addEventListener("pageshow", limpar_inputs);

const digitado = {
    nome: false,
    email: false,
    senha: false,
    cpf: false,
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

const eventoinserir = () => {
    const nome = document.querySelector('input[name="nome_de_usuario"]');
    const email = document.querySelector('input[name="email"]');
    const senha = document.querySelector('input[name="senha"]');
    const cpf = document.querySelector('input[name="cpf"]');

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

    if (digitado.cpf) {
        if (validarCPF(cpf.value)) {
            cpf.classList.add("valido");
            cpf.classList.remove("invalido");
            erro_input_cpf.style.display = "none";
        } else {
            cpf.classList.add("invalido");
            cpf.classList.remove("valido");
            erro_input_cpf.style.display = "block";
        }
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
        validarCPF(cpf.value) &&
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

const validarCPF = (cpf) => {
    cpf = cpf.replace(/[^\d]+/g, "");
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    let soma = 0;
    for (let i = 0; i < 9; i++) soma += parseInt(cpf.charAt(i)) * (10 - i);
    let resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;

    soma = 0;
    for (let i = 0; i < 10; i++) soma += parseInt(cpf.charAt(i)) * (11 - i);
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.charAt(10));
};

inputCPF.addEventListener("input", () => {
    let value = inputCPF.value.replace(/\D/g, "");
    if (value.length > 11) value = value.slice(0, 11);
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    inputCPF.value = value;
});

inputs.forEach((input) => input.addEventListener("input", eventoInput));
inputs.forEach((input) => input.addEventListener("focus", eventofoco));
inputs.forEach((input) => input.addEventListener("focusout", eventofocoout));

const botaoAdmin = document.getElementById("mostrarAdmin");
const campoTipo = document.getElementById("tipoUsuario");

botaoAdmin.addEventListener("click", () => {
    const ativado = campoTipo.value === "admin";
    if (ativado) {
        campoTipo.value = "cliente";
        botaoAdmin.textContent = "Cadastrar como administrador";
        botaoAdmin.classList.remove("ativo");
    } else {
        campoTipo.value = "admin";
        botaoAdmin.textContent = "Modo administrador ativado";
        botaoAdmin.classList.add("ativo");
    }
});
