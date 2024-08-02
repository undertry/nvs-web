<?= $this->include('common/home/start.php'); ?>
<title>NVS</title>
</head>

<body>
    <nav>
        <div class="logo">NVS</div>
        <ul>
            <li><a href="#features">Software</a>
                <ul class="dropdown">
                    <li><a href="#what-is">What is it?</a></li>
                    <li><a href="#who-for">Who is it for?</a></li>
                    <li><a href="#origin">How did it start?</a></li>
                </ul>
            </li>
            <li><a href="#about">About Us</a>
                <ul class="dropdown">
                    <li><a href="#creators">The Creators</a></li>
                    <li><a href="#purpose">Why did we make it?</a></li>
                </ul>
            </li>
            <?php if (session('user') && session('user')->id_user > 1 && session('user')->name) : ?>
                <li><a href="#menu"><?= session('user')->name; ?></a>

                    <ul class="dropdown">
                        <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>

                    <?php else : ?>
                        <li><a href="#menu">Menu</a>
                            <ul class="dropdown">
                                <li><a href="<?= base_url('login'); ?>">Log In</a></li>
                                <li><a href="<?= base_url('register'); ?>">Register</a></li>

                            <?php endif; ?>

                            </ul>
                        </li>
                    </ul>
    </nav>
    <div class="intro">
        <div class="intro-text">
            <h1>Network Vulnerability Scan</h1>
            <p>This project focuses on analyzing WiFi network vulnerabilities among other aspects...</p>
            <div class="buttons">
                <a href="#" class="btn">More Information</a>
                <a href="#" class="btn">View Repository</a>
            </div>
        </div>
        <div class="intro-image">
            <img src="<?php echo base_url('complements/styles/images/kali.jpg'); ?>" alt="Kali Linux Interface">
        </div>
    </div>
</body>

</html>