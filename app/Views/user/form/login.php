<?= $this->include('common/user/start.php'); ?>
<title>Log In</title>
</head>

<body>
    <!-- Implementacion de Aviso de Mayuscula -->
    <div id="caps-lock-warning-password" class="caps-lock-warning">
        <i class="fas fa-lock"></i> Caps Lock is on
    </div>

    <!-- Mensaje de sesiones -->
    <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <div class="login-container">
        <!-- Sección de la izquierda con GIF -->
        <div class="left-section">
            <img src="<?= base_url('complements/styles/images/walk.gif'); ?>" alt="Login GIF">
            <div class="logo-nvs"><a href="<?= base_url('home'); ?>">NVS</a></div>
        </div>

        <!-- Sección de la derecha con el formulario -->
        <div class="right-section">
            <form method="post" action="<?= base_url('login'); ?>" class="form">
                <h2>Log In</h2>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="email" type="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-label password-container">
                        <input name="password" type="password" id="password" placeholder="Password" required>
                        <span toggle="#password" class="field-icon toggle-password"><i
                                class="fa-solid fa-eye-slash"></i></span>
                    </div>
                </div>
                <div class="links">
                    <a href="<?= base_url('register'); ?>">Sign up</a>
                    <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
                </div>
                <button type="submit" class="submit-button">
                    Enter
                </button>
            </form>
        </div>
    </div>

    <?= $this->include('common/user/end.php'); ?>
</body>

</html>