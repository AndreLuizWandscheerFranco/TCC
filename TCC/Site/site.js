const imageList = document.querySelector('.image-list');
const items = document.querySelectorAll('.item');
let indiceAutal = 0;

function mudarSlides() {
    indiceAutal = (indiceAutal + 1) % items.length; 
    const offset = -indiceAutal * 100; 
    imageList.style.transform = `translateX(${offset}%)`; 
}

setInterval(mudarSlides, 10000);
