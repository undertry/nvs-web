function toggleDetails(element) {
    const details = element.nextElementSibling;
    const isVisible = details.classList.contains('visible');

    if (isVisible) {
        details.style.height = `${details.scrollHeight}px`;
        requestAnimationFrame(() => {
            details.style.height = '0px';
            details.classList.remove('visible');
        });
    } else {
        details.style.height = '0px';
        details.classList.add('visible');
        requestAnimationFrame(() => {
            details.style.height = `${details.scrollHeight}px`;
        });
    }

    details.addEventListener('transitionend', () => {
        if (!isVisible) {
            details.style.height = 'auto';
        } else {
            details.style.height = '0px';
        }
    }, {
        once: true
    });
}