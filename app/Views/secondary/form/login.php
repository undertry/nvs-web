<?= $this->include('modules/form/L-start.php'); ?>
<title>Log In</title>
</head>
<!-- Implementacion de Aviso de Mayuscula -->
<div id="caps-lock-warning-password" class="caps-lock-warning">
    <i class="fas fa-lock"></i> Caps Lock is on
</div>

<body>
    <!-- Mensaje de sesiones -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <!-- Formulario de Inicio de Sesion -->
    <div id="particles-js"></div> <!-- Contenedor de partículas -->
    <div class="box">
        <form method="post" action="<?= base_url('login'); ?>" class="form">
            <h2><a href="<?= base_url("home-animation"); ?>"><i class="fa-solid fa-fingerprint"></i></a></h2>
            <div class="form-inputs">
                <div class="form-label">
                    <input name="email" type="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-label">
                    <input name="password" type="password" id="password" placeholder="Password" required>
                    <div class="password-toggle">
                        <span toggle="#password" class="field-icon toggle-password"><i
                                class="fa-solid fa-eye-slash"></i></span>
                    </div>
                </div>
            </div>
            <div class="links">
                <a href="<?= base_url('signup-animation'); ?>">Sign up</a>
                <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
            </div>
            <input type="submit" value="Enter">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.0.0/tsparticles.bundle.min.js"></script>

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
    <?= $this->include('modules/form/L-end.php'); ?>