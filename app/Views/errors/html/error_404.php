<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('Errors.pageNotFound') ?></title>

    <style>
        :root {
            --color-main: #d60b0b;
            --color-secondary: #bb0f0f;
            --color-tertiary: #0046FE;
            --color-quaternary: #3b6ff2;
            --color-black: #151414;
            --color-semiblack: #202020;
            --color-dark: #0c0b0b;
            --color-light: #fcfcfc;
            --color-white: #f3f2f2;
            --color-light-grey: #cfcfcf;
            --color-semigrey: #565555;
            --color-grey: #535151;
        }

        @font-face {
            font-family: "neue";
            src: url("complements/styles/fonts/neue/NeueMontreal-Regular.otf") format("truetype");
        }

        body {
            height: 100%;
            background-color: var(--color-dark);
            font-family: "neue", Helvetica, Arial, sans-serif;
            color: #fff;
            font-weight: 300;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .wrap {
            top: 0;
            left: 0;
            transform: translate(0, 50%);
            max-width: 700px;
            padding: 40px;
            background: var(--color-semiblack);
            text-align: center;
            border-radius: 15px;
            border: 1px solid var(--color-grey);
            z-index: 100;
            user-select: none;
        }

        .light-mode .wrap {
            background: var(--color-light);
            color: var(--color-black);
        }

        h1 {
            font-family: "neue";
            font-weight: lighter;
            font-size: 5rem;
            margin-bottom: 20px;
            color: var(--color-main);
            user-select: none;
            user-select: none;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .light-mode p {
            color: var(--color-black);
        }

        .back-btn {
            display: inline-block;
            padding: 15px 30px;
            font-size: 1rem;
            color: #fff;
            background-color: var(--color-black);
            border: 1px solid var(--color-grey);
            border-radius: 15px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .light-mode .back-btn {
            background-color: var(--color-white);
            color: var(--color-black);
        }

        .back-btn:hover {
            background-color: var(--color-secondary);
            color: var(--color-white);
            border: 1px solid var(--color-light-grey);
        }

        .light-mode .back-btn:hover {
            border: 1px solid var(--color-dark);
        }


        .footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: #ddd;
        }

        #particles-js {
            position: absolute;
            width: 100%;
            z-index: -1;
            top: 0;
            left: 0;
            background: var(--color-dark);
            pointer-events: none;
            transition: background 0.3s ease;
        }

        .light-mode #particles-js {
            background: var(--color-white);
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <div class="wrap">
        <h1>404</h1>
        <p>
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                <?= lang('Errors.sorryCannotFind') ?>
            <?php endif; ?>
        </p>
        <a href="<?= base_url('home-animation'); ?>" class="back-btn">Volver al Inicio</a>
        <div class="footer">
            <p>&copy; <?= date('Y') ?> Network Vulnerability Scanner. Todos los derechos reservados.</p>
        </div>
    </div>
    <script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        // Función optimizada para actualizar los colores sin reiniciar las partículas
        function updateParticlesColor(mode) {
            const particlesColor = mode === "light" ? "#000000" : "#ffffff";
            const lineLinkedColor = mode === "light" ? "#000000" : "#ffffff";

            // Acceder directamente al objeto global de particles.js para cambiar los colores
            const particles = window.pJSDom[0].pJS.particles;

            // Cambiar color de las partículas y las líneas
            particles.color.value = particlesColor;
            particles.line_linked.color = lineLinkedColor;

            // Aplicar los cambios visuales inmediatamente
            window.pJSDom[0].pJS.fn.particlesRefresh();
        }

        // Inicializa las partículas
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 100,
                },
                color: {
                    value: "#555555", // Color inicial, será actualizado dinámicamente
                },
                shape: {
                    type: "circle",
                },
                opacity: {
                    value: 0.5,
                    random: false,
                },
                size: {
                    value: 3,
                    random: true,
                },
                line_linked: {
                    enable: true,
                    distance: 0,
                    color: "#ffffff", // Color inicial, será actualizado dinámicamente
                    opacity: 0.4,
                    width: 1,
                },
                move: {
                    speed: 1,
                    random: true,
                    direction: "none",
                    out_mode: "out",
                },
            },
            interactivity: {
                events: {
                    onhover: {
                        enable: true,
                        mode: "grab",
                    },
                    onclick: {
                        enable: true,
                        mode: "push",
                    },
                },
            },
            retina_detect: true,
        });
    </script>
</body>

</html>