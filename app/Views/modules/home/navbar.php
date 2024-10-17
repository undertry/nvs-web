<nav id="navbar">
    <ul class="nav-list">
        <li class="nav-item"><a class="logo"><i class="fa-solid fa-fingerprint"></i></a></li>
        <li class="nav-item">
            <a href="#home" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title">Home</span>
                        <span class="link-title2 title">Home</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#software" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title">Software</span>
                        <span class="link-title2 title">Software</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#about" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title">About</span>
                        <span class="link-title2 title">About</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#faq" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title">Faq</span>
                        <span class="link-title2 title">Faq</span>
                    </div>
                </span>
            </a>
        </li>
        <?php if (session('user') && session('user')->id_user > 0 && session('user')->name) : ?>
            <li class="nav-item">
                <a href="<?= base_url('dashboard-animation'); ?>" class="login link">
                    <?= session('user')->name; ?>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('logout'); ?>" class="signup link">Log Out</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a href="<?= base_url('login-animation'); ?>" class="login link">Log In</a>
            </li>
            <li class="nav-item signup">
                <a href="<?= base_url('signup-animation'); ?>" class="signup link">Sign Up <span class="arrow">↗</span></a>
            </li>
        <?php endif; ?>
    </ul>
    <div class="nav-right">
        <a href="#" id="toggle-dark-mode"><i class="fa-solid fa-moon" id="mode-icon"></i></a>
    </div>
</nav>