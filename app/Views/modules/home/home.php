<div id="scroll-container">
    <section class="home" id="home">
        <div id="particles-js"></div>
        <div class="intro" id="intro">
            <div class="intro-text hidden">
                <h1 class="title-animate" data-i18n="home.title">NETWORK VULNERABILITY SCAN</h1>
                <h3 class="intro-subtext" data-i18n="home.subtext">
                    For <span id="dynamic-word" class="word-slide hidden" data-i18n="home.dynamicWord">passionate</span> people.
                </h3>
            </div>
        </div>
    </section>


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
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 100
                },
                color: {
                    value: '#ffffff' // Color inicial, será actualizado dinámicamente
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.5,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#ffffff', // Color inicial, será actualizado dinámicamente
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    speed: 1,
                    random: true,
                    direction: 'none',
                    out_mode: 'out',
                }
            },
            interactivity: {
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                }
            },
            retina_detect: true
        });
    </script>