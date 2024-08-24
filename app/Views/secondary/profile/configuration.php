<?= $this->include('common/dashboard/configuration.php'); ?>
<title>Settings</title>
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

    <!-- Overlay Menu -->
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
                    <?php if (session('user') && session('user')->id_user > 0 && session('user')->name) : ?>
                    <li><a href="<?= base_url('dashboard-animation'); ?>"><?= session('user')->name; ?></a></li>
                    <?php endif; ?>
                </ul>
                <button class="cta-button">Download</button>
            </div>
        </div>
    </div>



    <div class="settings-container">
        <h1>Settings</h1>
        <div class="under-development">
            <p>This section is under development.</p>
        </div>
        <div class="settings-info">
            <p><strong>Name:</strong> <?= session('user')->name; ?></p>
            <p><strong>Email:</strong> <?= session('user')->email; ?></p>
            <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
            <p><strong>Verification:</strong> <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?></p>
            <button>
                <a href="<?= base_url('verification'); ?>">2 steps verification</a>
            </button>
            <button>
                <a href="<?= base_url('change_password'); ?>">Change password</a>
            </button>
        </div>
    </div>

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

</body>

</html>