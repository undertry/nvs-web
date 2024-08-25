<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available WiFi Networks</title>

    <link rel="stylesheet" href="<?php echo base_url('complements/styles/tertiary/network.css'); ?>">
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

            </div>
        </div>
    </div>




    <div class="container">
        <h1>Available WiFi NetworksR</h1>
        <?php if (!empty($networks)): ?>
        <ul>
            <?php foreach ($networks as $network): ?>
            <li>
                <strong>ESSID:</strong> <?= esc($network['essid']) ?><br>
                <strong>BSSID:</strong> <?= esc($network['bssid']) ?><br>
                <strong>Signal:</strong> <?= esc($network['signal']) ?><br>
                <strong>Channel:</strong> <?= esc($network['channel']) ?><br>
                <strong>Encryption:</strong> <?= esc($network['encryption']) ?><br>
                <hr>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No WiFi networks found.</p>
        <?php endif; ?>
    </div>
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