<?= $this->include('modules/user/start.php'); ?>
<title>Sign Up</title>
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
        <!-- GIF Ocupando un tercio del lado izquierdo -->
        <div class="left-section">
            <img id="registerGif" alt="Gif Descripción" class="gif-rectangular">
        </div>



        <!-- Formulario de Registro -->
        <div class="right-section">

            <form id="registerForm" method="post" action="<?= base_url('register'); ?>" class="form">
                <h2>Sign Up</h2>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="name" required type="text" id="name" placeholder="Your name"
                            value="<?= old('name'); ?>">
                    </div>
                    <div class="form-label">
                        <input name="email" required type="email" id="email" placeholder="name@example.com"
                            value="<?= old('email'); ?>">
                    </div>
                    <div class="form-label password-container">
                        <input name="password" required pattern=".{8,}" type="password" id="password"
                            placeholder="Password">
                        <div class="password-toggle">
                            <span toggle="#password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-label password-container">
                        <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password"
                            placeholder="Confirm Password">
                        <div class="password-toggle">
                            <span toggle="#confirm_password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <!-- Implementación de Aviso de Mayúscula -->
                        <div id="caps-lock-warning-confirm-password" class="caps-lock-warning">Caps Lock is on</div>
                    </div>
                </div>
                <div class="links">
                    <a href="<?= base_url('login-animation'); ?>">Already have an account?</a>
                </div>
                <button type="submit" class="submit-button">
                    Enter
                </button>
            </form>
        </div>

    </div>
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



    <?= $this->include('modules/user/end.php'); ?>
</body>