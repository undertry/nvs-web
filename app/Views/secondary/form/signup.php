<?= $this->include('modules/form/L-start.php'); ?>
<title>Sign Up</title>
</head>
<!-- Implementacion de Aviso de Mayuscula -->
<div id="caps-lock-warning-password" class="caps-lock-warning signup">
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
    <!-- Formulario de Registro -->
    <div id="particles-js"></div> <!-- Contenedor de partículas -->
    <div class="box-signup">
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
            <form id="registerForm" method="post" action="<?= base_url('signup'); ?>" class="form">
                <h3 class="intro">Create an account</h3>
                <p>Already have an account? <a href="<?= base_url('login-animation'); ?>"> Log In</a></p>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="name" required type="text" id="name" placeholder="Your name"
                            value="<?= old('name'); ?>">
                    </div>
                    <div class="form-label">
                        <input name="email" required type="email" id="email" placeholder="Email"
                            value="<?= old('email'); ?>">
                    </div>
                    <div class="form-label">
                        <input name="password" required pattern=".{8,}" type="password" id="password"
                            placeholder="Password">
                        <div class="password-toggle">
                            <span toggle="#password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-label">
                        <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password"
                            placeholder="Confirm Password">
                        <div class="password-toggle">
                            <span toggle="#confirm_password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <!-- Implementacion de Aviso de Mayuscula -->
                        <div id="caps-lock-warning-confirm-password" class="caps-lock-warning">Caps Lock is on</div>
                    </div>
                </div>
                <!-- Checkbox de aceptación de términos y condiciones -->
                <div class="form-label">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I accept the <a href="<?= base_url('terms-and-conditions'); ?>" target="_blank">terms and conditions</a></label>
                </div>
                <input type="submit" value="Continue">
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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