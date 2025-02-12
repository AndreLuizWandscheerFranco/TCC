const inputs = document.querySelectorAll('.input');
const button = document.querySelector('.login_button');

const limpar_inputs = () =>{
   inputs.forEach(input => input.value = '');
   button.setAttribute('disabled','')
}

window.addEventListener('pageshow',limpar_inputs);

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
   window.location = "../Site/site.html";
 };

const eventoinserir = () => {
   const [email,password] = inputs;

   if(validarEmail(email.value) && password.value.length >= 8 ) {
      button.removeAttribute('disabled');
      button.addEventListener('click',login_button);
   }else{
      button.setAttribute('disabled','');
   }
};

const validarEmail = (email) => {
   const regex = /^[^\s@]+@(gmail\.com|hotmail\.com|outlook\.com)$/i;
   return regex.test(email);
}

inputs.forEach( (input) => input.addEventListener('focus', eventofoco) );
inputs.forEach( (input) => input.addEventListener('focusout', eventofocoout) );
inputs.forEach( (input) => input.addEventListener('input', eventoinserir) );

