<?= $this->include('modules/dashboard/start.php'); ?>
<title>Dashboard</title>
</head>

<body>
    <!-- Navbar Section -->
    <nav id="navbar">
        <div class="logo"><a href="<?= base_url('home-animation'); ?>">NVS</a></div>
        <div id="menuToggle" class="menu-icon">
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
        </div>
    </nav>

    <!-- Menu Section -->
    <div id="overlayNav">
        <div class="overlay-content">
            <div class="overlay-left">
                <div class="overlay-video">
                    <img id="modeImage" alt="Video">
                    <div class="video-controls">
                        <span>00: 13: 49: 12: 45: 02</span>
                    </div>
                </div>
            </div>
            <div class="overlay-right">
                <ul>
                    <li><a href="<?= base_url('home-animation'); ?>">Home</a></li>
                    <li><a href="<?= base_url('network-animation'); ?>">Network Scan</a></li>
                    <li><a href="<?= base_url('history-animation'); ?>">History</a></li>
                    <li><a href="<?= base_url('configuration'); ?>">Configuration</a></li>

                    <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>
                    <hr class="line">
                    <ul>
                        <li><a id="modeToggle" href="javascript:void(0);">Dark</a></li>
                    </ul>
                </ul>

            </div>
        </div>
    </div>


    <section class="dashboard" id="dashboard">
        <h1 class="dashboard-header title-animate">DASHBOARD</h1>

    </section>

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



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const title = document.querySelector('.title-animate');
            const header = document.querySelector('.dashboard-header');

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

            title.style.opacity = 1;
            revealText(title, 'DASHBOARD', 85);

            // Aplicar la clase activa después de que el texto haya sido revelado
            setTimeout(() => {
                header.classList.add('active');
            }, 1000); // Ajusta el tiempo según sea necesario
        });
    </script>
    <script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>
    <script src="<?php echo base_url('complements/functionality/main/home/navbar.js'); ?>"></script>

    <script>
        const lightImage = "<?= base_url('complements/styles/images/polygon.jpg'); ?>";
        const darkImage = "<?= base_url('complements/styles/images/lines.jpg'); ?>";
    </script>
</body>

</html>