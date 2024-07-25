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
            <?php if (session('user') && session('user')->name) : ?>
                <li><a href="#menu"><?= session('user')->name; ?></a>

                    <ul class="dropdown">
                        <li><a href="#console">Console</a></li>
                        <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>

                    <?php else : ?>
                        <li><a href="#menu">Menu</a>
                            <ul class="dropdown">
                                <li><a href="#console">Console</a></li>
                                <li><a href="<?= base_url('login'); ?>">Log In</a></li>
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
            <img src="<?php echo base_url('complements/styles/images/kali.png'); ?>" alt="Kali Linux Interface">
        </div>
    </div>
    <div class="scroll-down">
        <i class="fas fa-chevron-down"></i>
    </div>


    <!-- Software Section -->
    <section id="features">
        <div class="section-header">
            <h2>Software</h2>
        </div>
        <div class="section-content">
            <div class="text-image-block" id="what-is">
                <div class="text">
                    <h3>What is it?</h3>
                    <p>Description of what the software is about...</p>
                </div>
                <div class="image">
                    <img src="<?php echo base_url('complements/styles/images/kali.jpg'); ?>" alt="Description Image">
                </div>
            </div>
            <div class="text-image-block" id="who-for">
                <div class="image">
                    <img src="path/to/your/image2.jpg" alt="Description Image">
                </div>
                <div class="text">
                    <h3>Who is it for?</h3>
                    <p>Description of who the software is for...</p>
                </div>
            </div>
            <div class="text-image-block" id="origin">
                <div class="text">
                    <h3>How did it start?</h3>
                    <p>Description of how the software started...</p>
                </div>
                <div class="image">
                    <img src="path/to/your/image3.jpg" alt="Description Image">
                </div>
            </div>
        </div>
    </section>
    <hr>
    <!-- About Us Section -->
    <section id="about">
        <div class="section-header">
            <h2>About Us</h2>
        </div>
        <div class="section-content">
            <div class="text-image-block" id="creators">
                <div class="text">
                    <h3>The Creators</h3>
                    <p>Details about the creators...</p>
                </div>
                <div class="image">
                    <img src="path/to/your/profile-image.jpg" alt="Profile Image">
                </div>
            </div>
            <div class="text-image-block" id="purpose">
                <div class="image">
                    <img src="path/to/your/image4.jpg" alt="Description Image">
                </div>
                <div class="text">
                    <h3>Why did we make it?</h3>
                    <p>Explanation of why the project was made...</p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>