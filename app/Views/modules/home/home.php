<section class="home" id="home">
    <div id="particles-js"></div> <!-- Contenedor de partículas -->
    <div class="intro">
        <div class="intro-text hidden">
            <h1 class="title-animate">NETWORK VULNERABILITY SCAN</h1>
            <h3 class="intro-subtext">
                For <span id="dynamic-word" class="word-slide hidden">passionate</span> people.
            </h3>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 100
            },
            color: {
                value: '#ffffff'
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
                color: '#ffffff',
                opacity: 0.4,
                width: 1
            },
            move: {
                speed: 2,
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