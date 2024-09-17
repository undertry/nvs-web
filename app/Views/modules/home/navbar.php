<!-- navbar section starts here -->
<nav id="navbar">

    <ul class="nav-list">
        <li class="nav-item"><a class="logo"><i class="fa-solid fa-fingerprint"></i></a></li>
        <li class="nav-item active">
            <a href="#home">
                <i class="fa-solid fa-circle-notch"></i> Home
            </a>
        </li>

        <li class="nav-item"><a href="#software"><i class="fa-brands fa-uncharted"></i> Software</a></li>
        <li class="nav-item"><a href="#about"><i class="fa-solid fa-circle-info"></i> About</a></li>
        <li class="nav-item"><a href="#faq"><i class="fa-solid fa-comments"></i> Faq</a></li>
        <li class="nav-item"><a href="<?= base_url('login-animation'); ?>"><i class="fa-solid fa-user-secret"></i> Log In</a></li>
        <li class="nav-item signup"><a href="<?= base_url('signup-animation'); ?>" class="signup">Get Started <span class="arrow">↗</span></a></li>
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
    </div>
</nav>
<!-- navbar section ends here -->