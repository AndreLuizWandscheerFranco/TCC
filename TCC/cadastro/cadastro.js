const inputs = document.querySelectorAll('.input');
const button = document.querySelector('.login_button');
const form = document.querySelector('.login_form');

const eventofoco = ({target}) => {
   const span = target.previousElementSibling;
   span.classList.add('span-ativo');
}

const eventofocoout = ({target}) => {
    if(target.value === ''){
    const span = target.previousElementSibling;
    span.classList.remove('span-ativo');
 }
}

const login_button = (event) => {
    event.preventDefault();
   window.location = "../Site/site.html";
 };

const eventoinserir = () => {
   const [nome,email, password] = inputs;

   if(nome.value && email.value && password.value.length >= 8 ) {
      button.removeAttribute('disabled');
      button.addEventListener('click',login_button);
   }else{
      button.setAttribute('disabled','');
   }
};

inputs.forEach( (input) => input.addEventListener('focus', eventofoco) );
inputs.forEach( (input) => input.addEventListener('focusout', eventofocoout) );
inputs.forEach( (input) => input.addEventListener('input', eventoinserir) );
form.addEventListener('submit', formsubmit);
