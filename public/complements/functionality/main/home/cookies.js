document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('modeToggle');
    const body = document.body;
    const imgElement = document.querySelector('#overlayNav .overlay-video img');
    const homeSection = document.querySelector('.home');

    // Verificar si hay un modo guardado en cookies
    const savedMode = getCookie('mode') || 'dark'; // Predeterminado en modo oscuro

    // Aplicar el modo guardado
    applyMode(savedMode);

    toggleButton.addEventListener('click', function() {
        const currentMode = body.classList.contains('light-mode') ? 'dark' : 'light';
        applyMode(currentMode);
        setCookie('mode', currentMode, 7); // Guardar el modo en cookies por 7 días
    });

    function applyMode(mode) {
        if (mode === 'light') {
            body.classList.add('light-mode');
            body.classList.remove('dark-mode');
            toggleButton.textContent = 'Dark';
            imgElement.src = lightImage;
            if (homeSection) {
                homeSection.classList.add('light-mode');
            }
        } else {
            body.classList.add('dark-mode');
            body.classList.remove('light-mode');
            toggleButton.textContent = 'Light';
            imgElement.src = darkImage;
            if (homeSection) {
                homeSection.classList.remove('light-mode');
            }
        }
    }

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = name + '=' + encodeURIComponent(value) + '; expires=' + expires + '; path=/';
    }

    function getCookie(name) {
        return document.cookie.split('; ').find(row => row.startsWith(name + '='))?.split('=')[1];
    }
});
