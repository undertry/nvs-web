<?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
  <?php endif; ?>
<div class="box-signup">
  <div class="box-content">
    <div class="image-container">
      <div id="sphere-js"></div>
      <h2 class="icon-top-left">
        <a>
        <i class="fa-solid fa-fingerprint"></i>
        </a>
      </h2>
      <div class="back-to-website">
        <a href="<?= base_url("home/animation"); ?>"><i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>
    <form id="registerForm" method="post" action="<?= base_url('auth/signup'); ?>" class="form">
      <h3 class="intro">Create an account</h3>
      <p>Already have an account? <a href="<?= base_url('auth/login'); ?>"> Log In</a></p>
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
            placeholder="Confirm Password">
          <div class="password-toggle">
            <span toggle="#confirm_password" class="field-icon toggle-password"><i
              class="fa-solid fa-eye-slash"></i></span>
          </div>
          <div id="caps-lock-warning-confirm-password" class="caps-lock-warning">Caps Lock is on</div>
        </div>
      </div>
      <div class="form-label">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">I accept the <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/legalcode.en" target="_blank">terms and conditions</a></label>
      </div>
      <input type="submit" value="Continue">
    </form>
  </div>
</div>
