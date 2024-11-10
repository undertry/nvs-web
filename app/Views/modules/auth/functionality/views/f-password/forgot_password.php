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
  <form method="post" action="<?= base_url('auth/sendemail'); ?>" class="form">
    <h3 class="intro">Forgot Password</h3>
    <p>Do you have a code? <a href="<?= base_url('auth/change_forgot'); ?>"> Reset Password</a></p>
    <div class="form-inputs">
      <div class="form-label">
        <input name="email" type="email" id="email" placeholder="name@example.com" required>
      </div>
      <input type="submit" value="Send Code">
  </form>
  <div class="links">
  <a href="<?= base_url('auth/login'); ?>">Go back to Log In</a>
  </div>
  </div>
</div>