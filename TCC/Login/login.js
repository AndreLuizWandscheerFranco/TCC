const inputs = document.querySelectorAll('.input');
const button = document.querySelector('.login_button');

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

const eventoinserir = () => {
   const [username, password] = inputs;

   if(username.value && password.value.length >= 8 ) {
      button.removeAttribute('disabled')
   }else{
      button.setAttribute('disabled','')
   }
}

inputs.forEach( (input) => input.addEventListener('focus', eventofoco) );
inputs.forEach( (input) => input.addEventListener('focusout', eventofocoout) );
inputs.forEach( (input) => input.addEventListener('input', eventoinserir) );