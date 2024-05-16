const inputs = document.querySelectorAll('.input');

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
inputs.forEach( (input) => input.addEventListener('focus', eventofoco) );
inputs.forEach( (input) => input.addEventListener('focusout', eventofocoout) );