const inputs = document.querySelectorAll(".input");
const button = document.querySelector(".login_button");
const erro_input = document.querySelector(".erro_input");
const erro_input_senha = document.querySelector(".erro_input_senha");
const erro_input_nome = document.querySelector(".erro_input_nome");

let timeoutId;

const digitado = { nome: false, email: false };

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

// const login_button = (event) => {
//     window.location = "../Site/index.html";
// };

const eventoinserir = () => {
    const [email, password] = inputs;

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

    if (password.value.length >= 8 && validarSenha(password.value)) {
        password.classList.add("valido");
        password.classList.remove("invalido");
        erro_input_senha.style.display = "none";
    } else if (password.value !== "") {
        password.classList.add("invalido");
        password.classList.remove("valido");
        erro_input_senha.style.display = "block";
    } else {
        erro_input_senha.style.display = "none";
        password.classList.remove("invalido");
        password.classList.remove("valido");
    }

    if (
        validarEmail(email.value) &&
        password.value.length >= 8 &&
        validarSenha(password.value)
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

const validarSenha = (password) => {
    const regex = /^[a-zA-Z0-9]+$/;
    return regex.test(password);
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
