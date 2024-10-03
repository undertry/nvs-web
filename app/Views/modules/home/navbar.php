<!-- navbar section starts here -->
<nav id="navbar">

    <ul class="nav-list">
        <li class="nav-item"><a class="logo"><i class="fa-solid fa-fingerprint"></i></a></li>
        <li class="nav-item">
            <a href="#home" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title" data-i18n="navbar.home.link">Home</span>
                        <span class="link-title2 title" data-i18n="navbar.home.link">Home</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#software" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title" data-i18n="navbar.software.link">Software</span>
                        <span class="link-title2 title" data-i18n="navbar.software.link">Software</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#about" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title" data-i18n="navbar.about.link">About</span>
                        <span class="link-title2 title" data-i18n="navbar.about.link">About</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#faq" class="link">
                <span class="mask">
                    <div class="link-container">
                        <span class="link-title1 title" data-i18n="navbar.faq.link">Faq</span>
                        <span class="link-title2 title" data-i18n="navbar.faq.link">Faq</span>
                    </div>
                </span>
            </a>
        </li>
        <li class="nav-item"><a href="<?= base_url('login-animation'); ?>" class="login link" data-i18n="navbar.login.link"> Log
                In</a></li>
        <li class="nav-item signup"><a href="<?= base_url('signup-animation'); ?>" class="signup link" data-i18n="navbar.signup.link">Get Started <span
                    class="arrow">↗</span></a></li>
    </ul>


    <div class="nav-right">
        <a href="#" id="toggle-dark-mode"><i class="fa-solid fa-moon" id="mode-icon"></i></a>
        <div class="dropdown">
            <a href="#" class="globe">
                <i class="fa-solid fa-globe"></i>
                <span class="language-label">EN</span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#" data-lang="en" data-i18n="navbar.languageDropdown.options.en">English</a></li>
                <li><a href="#" data-lang="es" data-i18n="navbar.languageDropdown.options.es">Spanish</a></li>
            </ul>
        </div>
    </div>


</nav>
<!-- navbar section ends here -->