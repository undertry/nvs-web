<!-- navbar section starts here -->
<nav id="navbar">
    <div class="nav-left">
        <a href="<?= base_url('/'); ?>" class="logo"><i class="fa-solid fa-fingerprint"></i></a>
    </div>
    <ul class="nav-list">
        <li class="nav-item active">
            <a href="#home">
                <i class="fa-solid fa-circle-notch"></i> Home
            </a>
        </li>
        <li class="nav-item"><a href="#software"><i class="fa-brands fa-uncharted"></i> Software</a></li>
        <li class="nav-item"><a href="#about"><i class="fa-solid fa-circle-info"></i> About</a></li>
        <li class="nav-item"><a href="#faq"><i class="fa-solid fa-comments"></i> Faq</a></li>
    </ul>

    <div class="nav-right">
        <a href="#" id="toggle-dark-mode"><i class="fa-solid fa-moon"></i></a>
        <div class="dropdown">
            <a href="#" class="globe">
                <i class="fa-solid fa-globe"></i>
                <span class="language-label">EN</span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">English</a></li>
                <li><a href="#">Spanish</a></li>
            </ul>
        </div>

        <a href="<?= base_url('login-animation'); ?>" class="login-link">Log In</a>
        <a href="<?= base_url('signup-animation'); ?>" class="signup-link">Get Started <span class="arrow">↗</span></a>
    </div>

</nav>
<!-- navbar section ends here -->