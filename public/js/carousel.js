let currentSlide = 0; // Índice del slide actual
const slides = document.querySelectorAll('.carousel-item'); // Todos los slides
const carousel = document.querySelector('.carousel'); // Contenedor del carrusel
const totalSlides = slides.length; // Total de slides visibles por el carrusel
const slidesPerPage = window.innerWidth < 768 ? 1 : 4; // Determina cuántos slides se muestran según el tamaño de la pantalla
let autoSlideInterval; // Variable para el intervalo automático

function showSlide(index) {
    // Calcula el ancho de cada slide
    const slideWidth = slides[0].offsetWidth;
    const maxIndex = totalSlides - slidesPerPage; // Índice máximo para evitar desbordamientos
    currentSlide = Math.min(Math.max(index, 0), maxIndex); // Asegura que el índice esté dentro del rango
    carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
}

function prevSlide() {
    showSlide(currentSlide - 1); // Muestra el slide anterior
}

function nextSlide() {
    showSlide(currentSlide + 1); // Muestra el siguiente slide
}

// Inicializa el carrusel
showSlide(currentSlide);

// Desplazamiento automático con límite seguro
function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        const maxIndex = totalSlides - slidesPerPage;
        if (currentSlide < maxIndex) {
            nextSlide();
        } else {
            currentSlide = 0; // Reinicia al primer slide cuando llega al final
            showSlide(currentSlide);
        }
    }, 4000); // Cada 4 segundos
}

// Detener el desplazamiento automático
function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Recalcula el carrusel cuando la ventana cambia de tamaño
window.addEventListener('resize', () => {
    showSlide(currentSlide);
});

// Inicia el desplazamiento automático
startAutoSlide();

// Detener el desplazamiento automático cuando el usuario interactúa
document.querySelector('.carousel-container').addEventListener('mouseover', stopAutoSlide);
document.querySelector('.carousel-container').addEventListener('mouseout', startAutoSlide);
