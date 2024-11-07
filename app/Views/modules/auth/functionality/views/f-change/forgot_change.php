<?php if (session()->getFlashdata("error")): ?>
        <div class="message error"><?= session()->getFlashdata("error") ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata("success")): ?>
        <div class="message success"><?= session()->getFlashdata("success") ?></div>
<?php endif; ?>
<?php if (
        session()->getFlashdata("error") === "The passwords do not match."): ?>
<?php endif; ?>
    <div class="box">
        <div class="box-content">
            <div class="image-container">
                <div id="sphere-js"></div>
                <h2 class="icon-top-left">
                    <a>
                        <i class="fa-solid fa-fingerprint"></i>
                    </a>
                </h2>
                <div class="back-to-website">
                    <a href="<?= base_url("home/animation") ?>"><i class="fa-solid fa-arrow-left"></i></a>
                </div>
            </div>
            <form method="post" action="<?= base_url("auth/password_change_forgot") ?>" class="form">
                <h3 class="intro">Change Password</h3>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="password" required pattern=".{8,}" type="password" id="password"
                            placeholder="password">
                        <div class="password-toggle">
                            <span toggle="#password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <div id="password-requirements" class="password-popup">
                            <p>Your password must contain:</p>
                            <ul>
                                <li id="length">At least 8 characters</li>
                                <li id="uppercase">1 uppercase letter</li>
                                <li id="special">1 special character (!@#$&*)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-label">
                        <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password"
                            placeholder="confirm password">
                        <div class="password-toggle">
                            <span toggle="#confirm_password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                    </div>
                    <div class="form-label">
                        <input name="code" required type="text" id="code" placeholder="verification code">
                    </div>
                </div>
                <input type="submit" value="Change Password">
            </form>
        </div>
    </div>
