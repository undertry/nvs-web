<!-- section login starts here -->
<div class="login-container">
    <div class="left-section">
        <img id="loginImage" alt="Login GIF">
    </div>
    <div class="right-section">
        <form method="post" action="<?= base_url('login'); ?>" class="form">
            <h2>Log In</h2>
            <div class="form-inputs">
                <div class="form-label">
                    <input name="email" type="email" id="email" placeholder="Email" required>
                </div>
                <div class="form-label password-container">
                    <input name="password" type="password" id="password" placeholder="Password" required>
                    <span toggle="#password" class="field-icon toggle-password">
                        <i class="fa-solid fa-eye-slash"></i>
                    </span>
                </div>
            </div>
            <div class="links">
                <a href="<?= base_url('signup-animation'); ?>">Sign up</a>
                <a href="<?= base_url('forgot_password'); ?>">Forgot password?</a>
            </div>
            <button type="submit" class="submit-button">Enter</button>
        </form>
    </div>
</div>
<!-- section login ends here -->