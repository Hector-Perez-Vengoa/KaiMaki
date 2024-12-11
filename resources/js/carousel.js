function showSlide(i) {
    const carousel = document.getElementById('carousel');
    const items = document.querySelectorAll('.carousel-item');
    index += i;
    if (index < 0) index = items.length - 1;
    if (index >= items.length) index = 0;

    // Actualiza la posición del carrusel
    carousel.style.transform = `translateX(${-index * 100}%)`;

    // Maneja la visibilidad de la información
    items.forEach((item, idx) => {
        const info = item.querySelector('.carousel-info');
        if (idx === index) {
            info.style.opacity = '1';
            info.style.transform = 'translateY(0)';
        } else {
            info.style.opacity = '0';
            info.style.transform = 'translateY(100%)';
        }
    });
}
