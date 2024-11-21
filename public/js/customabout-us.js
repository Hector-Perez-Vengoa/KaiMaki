document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;
        const icon = button.querySelector('.faq-icon');

        if (answer.classList.contains('open')) {
            answer.classList.remove('open');
            icon.classList.remove('open');
        } else {
            document.querySelectorAll('.faq-answer').forEach(answer => answer.classList.remove('open'));
            document.querySelectorAll('.faq-icon').forEach(icon => icon.classList.remove('open'));

            answer.classList.add('open');
            icon.classList.add('open');
        }
    });
});
