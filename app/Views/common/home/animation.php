<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/intro.css'); ?>">
    <title>Document</title>
</head>

<body>
    <div id="square-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.0/gsap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
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

        triggerSquaresAnimation(); // Ejecutar la animación directamente
    });
    </script>
</body>

</html>