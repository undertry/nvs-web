document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('modeToggle');
    const body = document.body;
    const imgElement = document.querySelector('#overlayNav .overlay-video img');
    const homeSection = document.querySelector('.home');
    const dashboardSection = document.querySelector('.dashboard');
    const loginImage = document.getElementById('loginImage'); // Seleccionar la imagen de la sección de login
    const registerImage = document.getElementById('registerImage');
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
            if (dashboardSection) {
                dashboardSection.classList.add('light-mode');
            }
            if (loginImage) {
                loginImage.src = loginLightImage; // Cambiar la imagen de login en modo claro
            }
            if (registerImage) {
                registerImage.src = registerLightImage; // Cambiar la imagen de login en modo claro
            }
        } else {
            body.classList.add('dark-mode');
            body.classList.remove('light-mode');
            toggleButton.textContent = 'Light';
            imgElement.src = darkImage;
            if (homeSection) {
                homeSection.classList.remove('light-mode');
            }
            if (dashboardSection) {
                dashboardSection.classList.remove('light-mode');
            }
            if (loginImage) {
                loginImage.src = loginDarkImage; // Cambiar la imagen de login en modo oscuro
            }
            if (registerImage) {
                registerImage.src = registerDarkImage; // Cambiar la imagen de login en modo claro
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
