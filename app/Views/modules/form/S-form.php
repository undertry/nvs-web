<!-- sign up section starts here -->
<div class="login-container">
    <div class="left-section">
        <img id="registerImage" alt="Gif Descripción" class="gif-rectangular">
    </div>
    <div class="right-section">
        <form id="registerForm" method="post" action="<?= base_url('register'); ?>" class="form">
            <h2>Sign Up</h2>
            <div class="form-inputs">
                <div class="form-label">
                    <input name="name" required type="text" id="name" placeholder="Your name" value="<?= old('name'); ?>">
                </div>
                <div class="form-label">
                    <input name="email" required type="email" id="email" placeholder="name@example.com" value="<?= old('email'); ?>">
                </div>
                <div class="form-label password-container">
                    <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="Password">
                    <div class="password-toggle">
                        <span toggle="#password" class="field-icon toggle-password"><i class="fa-solid fa-eye-slash"></i></span>
                    </div>
                </div>
                <div class="form-label password-container">
                    <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="Confirm Password">
                    <div class="password-toggle">
                        <span toggle="#confirm_password" class="field-icon toggle-password"><i class="fa-solid fa-eye-slash"></i></span>
                    </div>
                </div>
            </div>
            <div class="links">
                <a href="<?= base_url('login-animation'); ?>">Already have an account?</a>
            </div>
            <button type="submit" class="submit-button">Enter</button>
        </form>
        <!-- sign up section ends here -->