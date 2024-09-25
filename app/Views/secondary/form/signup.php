<?= $this->include('modules/form/L-start.php'); ?>
<title>Sign Up</title>
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
    <!-- Formulario de Registro -->
    <div id="particles-js"></div> <!-- Contenedor de partículas -->
    <div class="box">
        <form id="registerForm" method="post" action="<?= base_url('register'); ?>" class="form">
            <h2><i class="fa-solid fa-user-plus"></i></h2>
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
            <div class="links">
                <a href="<?= base_url('login-animation'); ?>">Already have an account?</a>
            </div>
            <input type="submit" value="Continue">
        </form>
    </div>
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