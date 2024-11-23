console.log('carousel.js loaded'); // Para verificar si el archivo se está ejecutando.

let index = 0;

function showSlide(i) {
    const carousel = document.getElementById('carousel');
    const items = document.querySelectorAll('.carousel-item');
    index += i;
    if (index < 0) index = items.length - 1;
    if (index >= items.length) index = 0;
    carousel.style.transform = `translateX(${-index * 100}%)`;
}

function nextSlide() {
    showSlide(1);
}

function prevSlide() {
    showSlide(-1);
}
