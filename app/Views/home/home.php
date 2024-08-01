<?= $this->include('common/home/start.php'); ?>
<title>NVS</title>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const heading = document.querySelector('.intro-text h1');
        heading.addEventListener('animationend', function() {
            if (event.animationName === 'typing') {
                heading.classList.add('typing-finished');
            }
        });
    });
</script>

</head>

<body>
    <nav>
        <div class="logo"><a href="#home">NVS</a></div>
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
                    <li><a href="#creators">Developers</a></li>
                </ul>
            </li>
            <?php if (session('user') && session('user')->name) : ?>
                <li><a href="#menu"><?= session('user')->name; ?></a>

                    <ul class="dropdown">
                        <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>

                    <?php else : ?>

                        <li><a href="<?= base_url('login'); ?>">Log In</a></li>
                        <li><a href="<?= base_url('register'); ?>">Sign Up</a></li>
                    <?php endif; ?>

                    </ul>
                </li>
        </ul>
    </nav>


    <section class="home" id="home">
        <div class="intro">
            <div class="intro-text">
                <h1>Network Vulnerability Scan</h1>
                <p>This project focuses on analyzing WiFi network vulnerabilities among other aspects...</p>
                <div class="buttons">
                    <a href="https://github.com/tiagocomba/NVS/wiki" target="_blank" class="btn">More Information</a>
                    <a href="https://github.com/tiagocomba/NVS/" target="_blank" class="btn">View Repository</a>
                </div>
            </div>

        </div>
        <div class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>



    <!-- Software Section -->
    <section id="features">
        <div class="section-header">
            <h2>SOFTWARE</h2>
        </div>
        <div class="section-content">
            <div class="text-image-block" id="what-is">
                <div class="text">
                    <h3>What is it?</h3>
                    <h4>Software, Vulnerability, scan, networks</h4>
                    <p>It is a software designed to analyze available WiFi networks. Upon selecting a specific network, the software can perform the following functions:</p>
                    <ul>
                        <li>Scan the network to detect <span>connected devices.</span></li>
                        <li>Identify the <span>operating system</span> of each device.</li>
                        <li>Assess the <span>vulnerabilities</span> of connected devices, if possible.</li>
                        <li>Use a <span>Raspberry Pi</span> for data collection.</li>
                    </ul>
                </div>
                <div class="image">
                    <img src="<?php echo base_url('complements/styles/images/prueba.png'); ?>" alt="Description Image">
                </div>
            </div>
            <div class="text-image-block who-for" id="who-for">
                <div class="image">
                    <img src="<?php echo base_url('complements/styles/images/hacker.png'); ?>" alt="Description Image">
                </div>
                <div class="text">
                    <h3>Who is it for?</h3>
                    <h4>Individuals passionate about cybersecurity</h4>
                    <p>It is for individuals who are <span>passionate</span> about <span>cybersecurity</span> and want to add an extra layer of <span>security</span> to their networks by performing <span>daily diagnostics</span> to enhance the <span>safety</span> of their WiFi.</p>
                </div>
            </div>
            <div class="text-image-block" id="origin">
                <div class="text">
                    <h3>How did it start?</h3>
                    <h4>From an idea to a project</h4>
                    <p>It began as a <span>mere idea</span>, but after giving it some thought, we realized it would be a <span>great project</span> for the thesis we needed to present. We conducted research until we could <span>solidify this fantastic concept.</span> The more we studied the topic, the more passionate we became about developing <span>this project for the community.</span></p>
                </div>
                <div class="image">
                    <img src="<?php echo base_url('complements/styles/images/kalila.png'); ?>" alt="Description Image">
                </div>
            </div>
        </div>
    </section>
    <hr>
    <!-- About Us Section -->
    <section id="about">
        <div class="section-header">
            <h2>ABOUT US</h2>
        </div>
        <div class="section-content">
            <div class="text-image-block" id="creators">
                <div class="text">
                    <h4>Developers</h4>
                    <div id="profiles"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="<?php echo base_url('complements/styles/images/NVS.png'); ?>" alt="Logo">
            </div>

            <div class="footer-columns">
                <div class="footer-column">
                    <h4>Software</h4>
                    <ul>
                        <li><a href="#">Scan</a></li>
                        <li><a href="#">History</a></li>
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Security</a></li>
                        <li><a href="#">All Features</a></li>
                        <li><a href="#">Changelog</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Explore</h4>
                    <ul>
                        <li><a href="#">User Manual</a></li>
                        <li><a href="#">Download</a></li>

                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">How We Work</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>ALL RIGHTS RESERVED © 2024</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-discord"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>

                </div>
            </div>
        </div>
    </footer>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const usernames = ["tiagocomba", "EzequielMonteverde"]; // Reemplaza con los nombres de usuario de GitHub
            const profilesContainer = document.getElementById("profiles");

            usernames.forEach(username => {
                fetch(`https://api.github.com/users/${username}`)
                    .then(response => response.json())
                    .then(data => {
                        const profileDiv = document.createElement("div");
                        profileDiv.classList.add("profile");

                        const img = document.createElement("img");
                        img.src = data.avatar_url;
                        img.alt = `${data.login}'s Profile Image`;

                        const link = document.createElement("a");
                        link.href = data.html_url;
                        link.textContent = data.login;

                        const description = document.createElement("p");
                        description.textContent = data.bio ? data.bio : "No bio available";

                        const followers = document.createElement("p");
                        followers.classList.add("followers");
                        followers.textContent = `Followers: ${data.followers}`;

                        const achievements = document.createElement("div");
                        achievements.classList.add("achievements");

                        profileDiv.appendChild(img);
                        profileDiv.appendChild(link);
                        profileDiv.appendChild(description);
                        profileDiv.appendChild(followers);
                        profileDiv.appendChild(achievements);
                        profilesContainer.appendChild(profileDiv);
                    })
                    .catch(error => console.error("Error fetching GitHub profile:", error));
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.querySelectorAll("nav ul li");

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener("mouseenter", function() {
                    const menu = this.querySelector(".dropdown");
                    if (menu) {
                        menu.style.display = "block";
                        setTimeout(() => {
                            menu.style.opacity = "1";
                            menu.style.visibility = "visible";
                            menu.style.transform = "translateY(0)";
                        }, 100); // Añade un pequeño retraso antes de iniciar la animación
                    }
                });

                dropdown.addEventListener("mouseleave", function() {
                    const menu = this.querySelector(".dropdown");
                    if (menu) {
                        menu.style.opacity = "0";
                        menu.style.visibility = "hidden";
                        menu.style.transform = "translateY(10px)";
                        setTimeout(() => {
                            menu.style.display = "none";
                        }, 500); // Asegúrate de que coincida con la duración de la transición en el CSS
                    }
                });
            });
        });
    </script>


</body>

</html>