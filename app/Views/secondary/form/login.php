<?= $this->include('modules/form/L-start.php'); ?>
<title>Log In</title>
</head>
<!-- Implementacion de Aviso de Mayuscula -->
<div id="caps-lock-warning-password" class="caps-lock-warning login">
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
    <div id="particles-js"></div>
    <div class="box">
        <div class="box-content">
            <div class="image-container">
                <h2 class="icon-top-left">
                    <a>
                        <i class="fa-solid fa-fingerprint"></i>
                    </a>
                </h2>

                <div class="back-to-website">
                    <a href="<?= base_url("home-animation"); ?>"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
                <img src="<?php echo base_url("complements/styles/images/blocks.jpg"); ?>" alt="Imagen de Login">
            </div>
            <form method="post" action="<?= base_url('login'); ?>" class="form">
                <h3 class="intro">Welcome Back!</h3>
                <p>New here? <a href="<?= base_url('signup-animation'); ?>"> Create your account</a></p>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="email" type="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-label">
                        <input name="password" type="password" id="password" placeholder="Password" required>
                        <div class="password-toggle">
                            <span toggle="#password" class="field-icon toggle-password">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="links">

                    <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
                </div>
                <input type="submit" value="Enter">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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