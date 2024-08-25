<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/animations/intro.css'); ?>">
    <link rel="website icon" type="png" href="<?php echo base_url('complements/styles/images/NVS.png'); ?>">
    <title>| NVS |</title>

</head>

<body>
    <!-- cursor -->
    <div class="cursor"></div>
    <div id="intro-container">
        <h1 id="title">NVS</h1>
        <div id="counter">3</div>
    </div>
    <div id="square-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const title = document.getElementById('title');
        const counter = document.getElementById('counter');
        const squareContainer = document.getElementById('square-container');

        const squareSize = 100; // Tamaño de los cuadrados
        const numSquares = Math.ceil((window.innerWidth / squareSize) * (window.innerHeight / squareSize));

        // Crear los cuadrados
        for (let i = 0; i < numSquares; i++) {
            const square = document.createElement('div');
            square.classList.add('square');
            squareContainer.appendChild(square);
        }

        const squares = document.querySelectorAll('.square');

        // Animación del título (h1) desde abajo hacia arriba
        gsap.fromTo(title, {
            y: 50,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: 1.5,
            ease: 'power4.out',
            stagger: 0.1
        });

        // Animación del contador tipo ruleta
        gsap.fromTo(counter, {
            y: -100,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: 0.2,
            ease: 'back.out(1.7)',
            delay: 1,
            onComplete: () => {
                gsap.to(counter, {
                    y: 100,
                    opacity: 0,
                    duration: 0.2,
                    ease: 'back.in(1.7)',
                    repeat: 2,
                    yoyo: true,
                    delay: 1,
                    onRepeat: function() {
                        let currentNumber = parseInt(counter.textContent);
                        counter.textContent = currentNumber - 1;
                    },
                    onComplete: triggerSquaresAnimation
                });
            }
        });

        // Animación de los cuadrados tipo fuego
        function triggerSquaresAnimation() {
            gsap.to(squares, {
                opacity: 1,
                duration: 0.1,
                stagger: {
                    each: 0.005,
                    from: "random"
                },
                onComplete: () => {
                    window.location.href = "<?php echo site_url('home'); ?>";
                }
            });
        }
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const cursor = document.querySelector(".cursor");

        let targetX = 0;
        let targetY = 0;

        document.addEventListener("mousemove", function(e) {
            targetX = e.pageX - cursor.offsetWidth / 2;
            targetY = e.pageY - cursor.offsetHeight / 2;
        });

        function updateCursor() {
            const currentX = parseFloat(cursor.style.left || 0);
            const currentY = parseFloat(cursor.style.top || 0);

            const dx = targetX - currentX;
            const dy = targetY - currentY;

            cursor.style.left = `${currentX + dx * 0.1}px`; // Ajusta el factor de suavidad aquí
            cursor.style.top = `${currentY + dy * 0.1}px`; // Ajusta el factor de suavidad aquí

            requestAnimationFrame(updateCursor);
        }

        updateCursor();
    });
    </script>
</body>

</html>