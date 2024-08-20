<?= $this->include('common/home/start.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<title>NVS</title>


</head>


<body>

    <a href="#" class="scroll-to-top">
        <i class="fa fa-arrow-up"></i> <!-- Usa el ícono de flecha de FontAwesome -->
    </a>


    <nav id="navbar">
        <div class="logo"><a href="<?= base_url('/'); ?>">NVS</a></div>
        <div id="menuToggle" class="menu-icon">
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
            <span class="menu-icon-bar"></span>
        </div>
    </nav>

    <div id="overlayNav">
        <div class="overlay-content">
            <div class="overlay-left">
                <div class="overlay-video">
                    <img src="<?= base_url('complements/styles/images/lines.jpg'); ?>" alt="Video">
                    <div class="video-controls">
                        <span>00: 13: 49: 12: 45: 02</span>
                    </div>
                </div>
            </div>
            <div class="overlay-right">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#software">Software</a></li>
                    <li><a href="#about">About</a></li>
                    <?php if (session('user') && session('user')->id_user > 0 && session('user')->name) : ?>

                    <li><a href="<?= base_url('dashboard'); ?>"><?= session('user')->name; ?></a>
                    </li>

                    <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>


                    <?php else : ?>
                    <li><a href="<?= base_url('login'); ?>">Log In</a></li>
                    <li><a href="<?= base_url('register'); ?>">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
                <button class="cta-button">Download</button>
            </div>
        </div>
    </div>

    </div>




    <section class="home" id="home">


        <div class="intro">
            <div class="intro-text">
                <h1 class="title-animate">NETWORK VULNERABILITY SCAN</h1>
                <p class="intro-subtext hidden">We are a team of developers redefining the landscape of cybersecurity.
                    Our
                    mission is to make it easier than ever to protect yourself from cybercriminals. We combine
                    innovative strategies with cutting-edge technology to safeguard your digital world.</p>
            </div>
        </div>
    </section>

    <hr>

    <!-- Software Section -->
    <section id="software">
        <div class="section-header hidden">
            <h2>SOFTWARE</h2>
        </div>
        <div class="section-content">
            <div class="text-image-block hidden" id="what-is">
                <div class="text">
                    <h3>What is it?</h3>
                    <h4>SOFTWARE | VULNERABILITY | SCAN | NETWORKS</h4>
                    <p>It is a software designed to analyze available WiFi networks. Upon selecting a specific network,
                        the software can perform the following functions:</p>
                    <ul>
                        <li>Scan the network to detect <span>connected devices.</span></li>
                        <li>Identify the <span>operating system</span> of each device.</li>
                        <li>Assess the <span>vulnerabilities</span> of connected devices, if possible.</li>
                        <li>Use a <span>Raspberry Pi</span> for data collection.</li>
                    </ul>
                </div>

            </div>
            <div class="text-image-block hidden" id="who-for">

                <div class="text">
                    <h3>Who is it for?</h3>
                    <h4>INDIVIDUALS PASSIONATE ABOUT CYBERSECURITY</h4>
                    <p>It is for individuals who are <span>passionate</span> about <span>cybersecurity</span> and want
                        to add an extra layer of <span>security</span> to their networks by performing <span>daily
                            diagnostics</span> to enhance the <span>safety</span> of their WiFi.</p>
                </div>
            </div>
            <div class="text-image-block hidden" id="origin">
                <div class="text">
                    <h3>How did it start?</h3>
                    <h4>FROM AN IDEA TO A PROJECT</h4>
                    <p>It began as a <span>mere idea</span>, but after giving it some thought, we realized it would be a
                        <span>great project</span> for the thesis we needed to present. We conducted research until we
                        could <span>solidify this fantastic concept.</span> The more we studied the topic, the more
                        passionate we became about developing <span>this project for the community.</span>
                    </p>
                </div>

            </div>



        </div>
    </section>





    <hr>
    <section id="features">


        <div class="features-block hidden" id="security">
            <h3>FEATURES & SECURITY</h3>
            <div class="feature-item">
                <div class="feature-text hidden">
                    <h4>Highly Secure</h4>
                    <p>Passwords are hashed using Bcrypt.</p>
                </div>
            </div>
            <div class="feature-item">

                <div class="feature-text hidden">
                    <h4>Local Deployment</h4>
                    <p>Runs locally for enhanced security.</p>
                </div>
            </div>
            <div class="feature-item">

                <div class="feature-text hidden">
                    <h4>Downloadable Reports</h4>
                    <p>Delete and download scan history in PDF format.</p>
                </div>
            </div>
            <div class="feature-item">

                <div class="feature-text hidden">
                    <h4>Advanced Security Features</h4>
                    <p>Supports two-factor authentication, password recovery, and change password functionality.</p>
                </div>
            </div>
            <div class="feature-item">

                <div class="feature-text hidden">
                    <h4>Compatibility</h4>
                    <p>Compatible with Raspberry Pi 3 B+ and later versions.</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <hr>




    <!-- About Us Section -->
    <section class="about" id="about">
        <div class="section-header hidden">
            <h2>ABOUT US</h2>
        </div>




        <section class="comments-section hidden">
            <div class="text">
                <h2>WHAT OUR COLLEAGUES SAY ABOUT NVS</h2>
            </div>

            <div class="comments-carousel" id="comments">
                <!-- Las tarjetas se generarán dinámicamente aquí -->
            </div>
        </section>



        <hr>



        <section class="faq hidden" id="faq">
            <h2>FREQUENTLY ASKED QUESTIONS</h2>
            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>How do I perform a scan?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>To perform a scan, you just need to be logged into our software, go to your profile in the
                        Network
                        Scan section, and ensure your Raspberry Pi is properly configured.</p>
                </div>
            </div>

            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>Is it open source?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, our project is open source and community-oriented. If you'd like, you can fork our
                        repository
                        and help us improve this great tool.</p>
                </div>
            </div>

            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>If I don’t have a Raspberry Pi, can I still use the software?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>The software is optimized for use with a Raspberry Pi due to its portability, but there are no
                        issues
                        with using it on another device.</p>
                </div>
            </div>

            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>If I have no knowledge of configuring the Raspberry Pi, how can I use the software?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>You can contact us via email, and we will respond to your questions or concerns. Additionally, if
                        you
                        are in our area, we can visit you in person to help with the setup.</p>
                </div>
            </div>

            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>Does it run locally?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>Yes, the software is designed to run locally, enhancing user privacy and security by keeping
                        everything off the cloud.</p>
                </div>
            </div>

            <div class="faq-item hidden">
                <div class="faq-question">
                    <h3>Will there be a mobile version?</h3>
                    <span class="faq-icon">+</span>
                </div>
                <div class="faq-answer">
                    <p>We are considering developing a mobile app to make scanning easier without relying on a computer.
                    </p>
                </div>
            </div>


        </section>






        <!-- Footer Section -->
        <footer>
            <div class="footer-container hidden">
                <div class="footer-logo hidden">
                    <div class="logo"><a>NVS</a></div>
                </div>

                <div class="footer-columns">
                    <div class="footer-column hidden">
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
                    <div class="footer-column hidden">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="#">User Manual</a></li>
                            <li><a href="#">Download</a></li>

                        </ul>
                    </div>
                    <div class="footer-column hidden">
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
                <div class="footer-bottom hidden">
                    <p>ALL RIGHTS RESERVED © 2024</p>
                    <div class="social-icons hidden">
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-discord"></i></a>
                        <a href="#"><i class="fab fa-github"></i></a>

                    </div>
                </div>
            </div>
        </footer>





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
                        }, 10); // Añade un pequeño retraso antes de iniciar la animación
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
                            },
                            500
                        ); // Asegúrate de que coincida con la duración de la transición en el CSS
                    }
                });
            });
        });
        </script>


        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Manejo del dropdown
            document.querySelector('.dropdown-button').addEventListener('click', function() {
                var dropdownContent = document.querySelector('.dropdown-content');
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' :
                    'block';
            });

            // Manejo del clic en "Clonar Repositorio"
            document.querySelector('#clone-repo').addEventListener('click', function(e) {
                e.preventDefault(); // Evitar la acción por defecto del enlace

                const url = 'git clone https://github.com/tiagocomba/NVS.git';

                // Crear un elemento de texto oculto para copiar al portapapeles
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);

                // Reemplazar el texto original con el mensaje de copiado
                const originalText = this.querySelector('.original-text');
                const message = this.querySelector('.copied-message');

                // Ocultar el texto original y mostrar el mensaje
                originalText.style.display = 'none';
                message.style.display = 'inline';

                // Restaurar el texto original después de 2 segundos
                setTimeout(() => {
                    originalText.style.display = 'inline';
                    message.style.display = 'none';
                }, 2000);
            });
        });
        </script>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const commentsContainer = document.getElementById("comments");

            const usernames = ["schwgon", "Dr-Cristian", "LaureanoCarlos", "Craifran", "Randalfd",
                "TadeoBoglione",
                "Naahuuel"
            ];
            const comments = [
                "The NVS software has significantly enhanced my security by identifying network vulnerabilities. This has been particularly useful for protecting my extensive computer systems. ",
                "I find this product to be excellent in fulfilling its promises. Despite still being in development, it is even better than some paid programs with the same purpose. Thank you.",
                "A well-conceived idea from the initial design, it effectively meets its objectives and is free of defects. Its creators are visionary and proactive individuals.",
                "The website is very pleasant, easy to understand, and visually appealing. The interaction with it is logical and comprehensible. Regarding the software, it is a very interesting idea that is well implemented.",
                "Highly recommended for anyone in the industry.",
                "The tool appears to be very useful for addressing current security concerns and frequent attacks. With this device, vulnerabilities are mitigated, and its advanced technology effectively handles highly specific issues.",
                "This has changed the way we work, for the better."
            ];
            let allCommentsHTML = "";

            usernames.forEach((username, index) => {
                allCommentsHTML += generateCommentHTML(username, comments[index % comments.length]);
            });

            setTimeout(() => {
                commentsContainer.innerHTML = allCommentsHTML;
                initializeCardPositions();
            }, 500);

            function generateCommentHTML(username, comment) {
                return `
            <div class="comment-card">
                <div class="comment-content">
                    <p>${comment}</p>
                    <h3>@${username}</h3>
                </div>
            </div>
        `;
            }

            function initializeCardPositions() {
                const cards = document.querySelectorAll('.comment-card');

                const positions = [{
                        x: 400,
                        y: 420
                    },
                    {
                        x: 600,
                        y: 35
                    },
                    {
                        x: 10,
                        y: 400
                    },
                    {
                        x: 120,
                        y: 10
                    },
                    {
                        x: -260,
                        y: 100
                    },
                    {
                        x: -550,
                        y: 400
                    },
                    {
                        x: -600,
                        y: 10
                    }
                ];

                cards.forEach((card, index) => {
                    const position = positions[index % positions.length];
                    card.style.transform = `translate(${position.x}px, ${position.y}px)`;

                    card.dataset.initialX = position.x;
                    card.dataset.initialY = position.y;
                });

                commentsContainer.addEventListener('mousemove', function(event) {
                    const mouseX = event.clientX;
                    const mouseY = event.clientY;

                    cards.forEach(card => {
                        const initialX = parseFloat(card.dataset.initialX);
                        const initialY = parseFloat(card.dataset.initialY);

                        const deltaX = (mouseX - (initialX + card.clientWidth / 2)) * 0.02;
                        const deltaY = (mouseY - (initialY + card.clientHeight / 2)) * 0.02;

                        card.style.transform =
                            `translate(${initialX + deltaX}px, ${initialY + deltaY}px)`;
                    });
                });
            }
        });
        </script>




        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.hidden');

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            });

            elements.forEach(element => {
                observer.observe(element);
            });
        });
        </script>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('navbar');

            window.addEventListener('scroll', function() {
                if (window.scrollY >
                    50) { // Ajusta el valor según el punto donde quieres que cambie el color
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }
            });
        });
        </script>


        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const title = document.querySelector('.title-animate');

            const revealText = (element, finalText, speed = 100) => {
                let chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                let textArray = finalText.split('');
                let currentIndex = 0;

                let interval = setInterval(() => {
                    textArray = textArray.map((char, index) => {
                        if (index <= currentIndex) {
                            return finalText[index];
                        }
                        return chars[Math.floor(Math.random() * chars.length)];
                    });

                    element.textContent = textArray.join('');

                    if (currentIndex < textArray.length) {
                        currentIndex++;
                    } else {
                        clearInterval(interval);
                    }
                }, speed);
            };

            title.style.opacity = 1;
            revealText(title, 'NETWORK VULNERABILITY SCAN', 85);
        });
        </script>

        <script>
        document.querySelectorAll('.faq-question').forEach(item => {
            item.addEventListener('click', () => {
                const parent = item.parentElement;
                parent.classList.toggle('active');

                // Para cerrar las otras respuestas cuando se abre una nueva
                document.querySelectorAll('.faq-item').forEach(otherItem => {
                    if (otherItem !== parent) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        });
        </script>

        <script>
        document.addEventListener('scroll', function() {
            const scrollToTopBtn = document.querySelector('.scroll-to-top');
            if (window.scrollY > 100) { // Ajusta el valor según cuándo quieres que aparezca el botón
                scrollToTopBtn.style.opacity = '1';
                scrollToTopBtn.style.pointerEvents = 'auto';
            } else {
                scrollToTopBtn.style.opacity = '0';
                scrollToTopBtn.style.pointerEvents = 'none';
            }
        });
        </script>
</body>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');
    var initialBgColor = 'transparent'; // Color de fondo inicial
    var scrollBgColor = '#151414'; // Color de fondo cuando se desplaza

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) { // Cambia el valor según el desplazamiento que desees
            navbar.style.backgroundColor = scrollBgColor;
        } else {
            navbar.style.backgroundColor = initialBgColor;
        }
    });

    // Toggle menu and close class
    document.getElementById('menuToggle').addEventListener('click', function() {
        this.classList.toggle('close');
        document.getElementById('overlayNav').classList.toggle('active');
    });
})
</script>




</html>