<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/intro.css'); ?>">
    <title>Document</title>

</head>

<body>
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

        const squareSize = 100;
        const screenWidth = window.innerWidth;
        const screenHeight = window.innerHeight;
        const numCols = Math.ceil(screenWidth / squareSize);
        const numRows = Math.ceil(screenHeight / squareSize);
        const numSquares = numCols * numRows;

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
            duration: 0.4,
            ease: 'back.out(1.7)',
            delay: 2,
            onComplete: () => {
                gsap.to(counter, {
                    y: 100,
                    opacity: 0,
                    duration: 0.5,
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
</body>

</html>