<?= $this->include('common/dashboard/start.php'); ?>
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
                    <img src="<?= base_url('complements/styles/images/lines.jpg'); ?>" alt="Video">
                    <div class="video-controls">
                        <span>00: 13: 49: 12: 45: 02</span>
                    </div>
                </div>
            </div>
            <div class="overlay-right">
                <ul>
                    <li><a href="<?= base_url('home-animation'); ?>">Home</a></li>
                    <li><a href="#software">Network Scan</a></li>
                    <li><a href="<?= base_url('configuration'); ?>">Configuration</a></li>

                    <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>

                </ul>
            </div>
        </div>
    </div>



    <h1 class="dashboard-header title-animate">DASHBOARD</h1>



    <!-- JS for Menu Toggle -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbar = document.getElementById('navbar');
        var initialBgColor = 'transparent'; // Color de fondo inicial
        var scrollBgColor = '#151414'; // Color de fondo cuando se desplaza

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) { // Cambia el valor según el desplazamiento que desees
                navbar.style.backgroundColor = scrollBgColor;
            } else {
                navbar.style.backgroundColor = initialBgColor;
            }
        });

        // Toggle menu and close class
        document.getElementById('menuToggle').addEventListener('click', function() {
            this.classList.toggle('close');
            document.getElementById('overlayNav').classList.toggle('active');
        });
    })
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
</body>

</html>