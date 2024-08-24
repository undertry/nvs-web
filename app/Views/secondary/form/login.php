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
            <div class="logo-nvs"><a href="<?= base_url('home-animation'); ?>">NVS</a></div>
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
                    <a href="<?= base_url('signup-animation'); ?>">Sign up</a>
                    <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
                </div>
                <button type="submit" class="submit-button">
                    Enter
                </button>
            </form>
        </div>
    </div>

    <?= $this->include('common/user/end.php'); ?>
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
</body>

</html>