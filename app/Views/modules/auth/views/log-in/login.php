<?php if (session()->getFlashdata('error')) : ?>
<div class="message error"><?= session()->getFlashdata('error'); ?></div>
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
        <a href="<?= base_url("home/animation"); ?>"><i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>
    <form method="post" action="<?= base_url('auth/login'); ?>" class="form">
      <h3 class="intro">Welcome Back!</h3>
      <p>New here? <a href="<?= base_url('auth/signup'); ?>"> Create your account</a></p>
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
        <a href="<?= base_url('auth/forgot_password'); ?>">Forgot password?</a>
      </div>
      <input type="submit" value="Enter">
    </form>
  </div>
</div>
