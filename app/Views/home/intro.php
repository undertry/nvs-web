<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    :root {
        --color-main: #d60b0b;
        --color-black: #151414;
        --color-dark: #0c0b0b;
        --color-white: #f3f2f2;
        --color-grey: #333;
    }

    #loading-screen {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--color-black);
        color: #575757;
        display: flex;
        justify-content: flex-end;
        /* Alinea el contenido a la derecha */
        align-items: flex-end;
        /* Alinea el contenido a la parte inferior */
        padding: 1rem;
        /* Ajusta el espacio alrededor del texto */
        z-index: 9999;
        font-family: 'Neue', sans-serif;
        transition: opacity 0.5s ease;
    }

    #loading-text {
        font-size: 5rem;
        /* Tamaño grande para el texto desencriptado */
        font-weight: bold;
        transition: opacity 1s ease;
    }

    /* Encoje el texto cuando termina la carga */
    .loading-done #loading-text {
        transform: scale(0);
        opacity: 0;
    }


    @font-face {
        font-family: "schabo";
        src: url("./fonts/schabo/SCHABO-Condensed.otf") format("truetype");
    }

    @font-face {
        font-family: "neue";
        src: url("./fonts/neue/NeueMontreal-Regular.otf") format("truetype");
    }
    </style>
</head>


<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div id="loading-text" class="title-animate"></div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', () => {
        let textElement = document.getElementById('loading-text');
        let loadingScreen = document.getElementById('loading-screen');

        const revealText = (element, finalText, speed = 100) => {
            let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            let textArray = finalText.split('');
            let currentIndex = 0;

            let interval = setInterval(() => {
                textArray = textArray.map((char, index) => {
                    if (index <= currentIndex) {
                        return finalText[index];
                    }
                    return chars[Math.floor(Math.random() * chars.length)];
                });

                element.textContent = textArray.join('');

                if (currentIndex < textArray.length) {
                    currentIndex++;
                } else {
                    clearInterval(interval);
                }
            }, speed);
        };

        // Función para redirigir a otra vista
        function redirectToAnotherView() {
            // Obtiene la URL absoluta utilizando PHP y redirige a la vista "inicio"
            var absoluteUrl = "<?php echo site_url('home'); ?>";
            window.location.href = absoluteUrl;
        }

        // Inicia la animación de desencriptado
        revealText(textElement, 'NVS/24', 85);

        // Después de que termine la animación, redirige
        setTimeout(() => {
            loadingScreen.classList.add('loading-done');
            setTimeout(() => {
                redirectToAnotherView();
            }, 500); // Espera medio segundo para completar la animación de encogimiento
        }, 2000); // Espera 2 segundos para mostrar el texto desencriptado antes de redirigir
    });
    </script>



</body>

</html>