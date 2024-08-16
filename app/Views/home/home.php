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
            <li><a href="#software">Software</a>
                <ul class="dropdown">
                    <li><a href="#what-is">What is it?</a></li>
                    <li><a href="#who-for">Who is it for?</a></li>
                    <li><a href="#origin">How did it start?</a></li>
                    <li><a href="#security">Features & Security</a></li>
                    <li><a href="#comparison">Software Comparison</a></li>
                </ul>
            </li>
            <li><a href="#about">About Us</a>
                <ul class="dropdown">
                    <li><a href="#faq">Faq</a></li>
                </ul>
            </li>

           
           
            <a class="button" href="#download">Download</a>


    


            <?php if (session('user') && session('user')->id_user > 1 && session('user')->name) : ?>

                <li><a href="#menu"><?= session('user')->name; ?></a>

                    <ul class="dropdown">
                        <li><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('logout'); ?>">Log Out</a></li>
                    </ul>
                <?php else : ?>
                <li><a href="<?= base_url('login'); ?>">Log In</a></li>
                <li><a href="<?= base_url('register'); ?>">Sign Up</a></li>


            <?php endif; ?>




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
    <section id="software">
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
    </section>

    <hr>
    <section id="features">


        <div class="features-block" id="security">
            <h3>Features & Security</h3>
            <div class="feature-item">
                <div class="icon"><i class="fas fa-lock"></i></div>
                <div class="feature-text">
                    <h4>Highly Secure</h4>
                    <p>Passwords are hashed using Bcrypt.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
                <div class="feature-text">
                    <h4>Local Deployment</h4>
                    <p>Runs locally for enhanced security.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon"><i class="fas fa-file-download"></i></div>
                <div class="feature-text">
                    <h4>Downloadable Reports</h4>
                    <p>Delete and download scan history in PDF format.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon"><i class="fas fa-key"></i></div>
                <div class="feature-text">
                    <h4>Advanced Security Features</h4>
                    <p>Supports two-factor authentication, password recovery, and change password functionality.</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="icon"><i class="fa-solid fa-satellite-dish"></i></div>
                <div class="feature-text">
                    <h4>Compatibility</h4>
                    <p>Compatible with Raspberry Pi 3 B+ and later versions.</p>
                </div>
            </div>
        </div>
        </div>
    </section>

    <hr>
    <section id="comparison" class="comparison-section">
        <h2>Software Comparison</h2>
        <table class="comparison-table">
            <thead>
                <tr>
                    <th>Features</th>
                    <th>NVS</th>
                    <th>Nessus</th>
                    <th>OpenVAS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Open Source</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Easy to Use</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                </tr>
                <tr>
                    <td>Intuitive</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                </tr>
                <tr>
                    <td>Performance</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                    <td class="no">&#10007;</td>
                </tr>
                <tr>
                    <td>Network Scanning</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Vulnerability Analysis</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Identification of SO</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Scan History</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Use of Raspberry Pi</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                </tr>
                <tr>
                    <td>Safety Measures</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                </tr>
                <tr>
                    <td>Updates and Improvements</td>
                    <td class="yes">&#10003;</td>
                    <td class="yes">&#10003;</td>
                    <td class="no">&#10007;</td>
                </tr>
            </tbody>
        </table>
    </section>




    <hr>

    <!-- About Us Section -->
    <section class="about" id="about">
        <div class="section-header">
            <h2>ABOUT US</h2>
        </div>




        <section class="comments-section">
            <h2>What our colleagues say about NVS</h2>
            <div class="comments-carousel" id="comments">
                <!-- Las tarjetas se generarán dinámicamente aquí -->
            </div>
        </section>



        <div class="section-content">
            <div class="text-image-block" id="creators">
                <div class="text">
                    <h4>Developers</h4>
                    <div id="profiles"></div>
                </div>

            </div>
        </div>
    </section>

    <hr>



    <section id="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 1?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed, accusamus nostrum, commodi dolorum ipsum ratione dolore inventore, voluptatum voluptas modi excepturi! Ad iste voluptates culpa aperiam officia omnis et cupiditate.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 2?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum culpa possimus autem ducimus explicabo earum architecto, delectus quia pariatur rem aperiam voluptate et cumque quibusdam dolor, quas mollitia nam.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 3?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum culpa possimus autem ducimus explicabo earum architecto, delectus quia pariatur rem aperiam voluptate et cumque quibusdam dolor, quas mollitia nam.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 4?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum culpa possimus autem ducimus explicabo earum architecto, delectus quia pariatur rem aperiam voluptate et cumque quibusdam dolor, quas mollitia nam.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 5?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum culpa possimus autem ducimus explicabo earum architecto, delectus quia pariatur rem aperiam voluptate et cumque quibusdam dolor, quas mollitia nam.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Pregunta 6?</h3>
                <span class="faq-icon">+</span>
            </div>
            <div class="faq-answer">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus nostrum culpa possimus autem ducimus explicabo earum architecto, delectus quia pariatur rem aperiam voluptate et cumque quibusdam dolor, quas mollitia nam.</p>
            </div>
        </div>

        <!-- Añadir más preguntas aquí -->

    </section>

    <hr>





    <section id="download">
        <div class="section-header-download">
            <h2>Download NVS</h2>
        </div>
        <div class="section-content">
            <div class="download-buttons">
                <button class="main-button">Join the Mobile waitlist</button>
                <div class="dropdown">
                    <button class="dropdown-button"> <i class="fas fa-chevron-down"></i></button>
                    <div class="dropdown-content">
                        <a href="#" id="clone-repo">
                            <span class="original-text">Clone repository</span>
                            <span class="copied-message">Copied</span>
                        </a>
                        <a href="https://github.com/tiagocomba/NVS/archive/refs/heads/main.zip" target="_blank">Download .zip</a>
                    </div>
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
                // Intenta obtener datos del localStorage
                const storedProfile = localStorage.getItem(`profile_${username}`);

                if (storedProfile) {
                    // Si hay datos almacenados, úsalos directamente
                    displayProfile(JSON.parse(storedProfile));
                } else {
                    // Si no hay datos en localStorage, realiza la petición a la API
                    fetch(`https://api.github.com/users/${username}`)
                        .then(response => response.json())
                        .then(data => {
                            // Guarda la respuesta en localStorage
                            localStorage.setItem(`profile_${username}`, JSON.stringify(data));
                            displayProfile(data);
                        })
                        .catch(error => {
                            console.error("Error fetching GitHub profile:", error);
                        });
                }
            });

            function displayProfile(data) {
                const profileDiv = document.createElement("div");
                profileDiv.classList.add("profile");

                // Verificación de la URL del avatar
                const img = document.createElement("img");
                if (data.avatar_url) {
                    img.src = data.avatar_url;
                    img.alt = `${data.login}'s Profile Image`;
                } else {
                    img.src = "ruta/a/una/imagen/por/defecto.png"; // Imagen por defecto
                    img.alt = "Imagen por defecto";
                }

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
            }
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
                        }, 500); // Asegúrate de que coincida con la duración de la transición en el CSS
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
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
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
            const usernames = ["schwgon", "Dr-Cristian", "LaureanoCarlos", "Craifran", "Randalfd", "TadeoBoglione", "Naahuuel"]; // Agrega aquí los nombres de usuario de GitHub
            const commentsContainer = document.getElementById("comments");

            // Variable para almacenar todas las tarjetas antes de duplicarlas
            let allCommentsHTML = "";

            usernames.forEach(username => {
                const storedProfile = localStorage.getItem(`profile_${username}`);

                if (storedProfile) {
                    allCommentsHTML += generateCommentHTML(JSON.parse(storedProfile));
                } else {
                    fetch(`https://api.github.com/users/${username}`)
                        .then(response => response.json())
                        .then(data => {
                            localStorage.setItem(`profile_${username}`, JSON.stringify(data));
                            allCommentsHTML += generateCommentHTML(data);
                        })
                        .catch(error => {
                            console.error("Error fetching GitHub profile:", error);
                        });
                }
            });

            // Función para generar el HTML de cada tarjeta
            function generateCommentHTML(data) {
                return `
            <div class="comment-card">
                <img src="${data.avatar_url}" alt="${data.login}'s Profile Image">
                <div class="comment-content">
                    <h3>${data.name ? data.name : data.login}</h3>
                    <p>Este es un comentario de ejemplo sobre tu software.</p>
                </div>
            </div>
        `;
            }

            // Espera un breve tiempo para asegurarse de que todo el HTML se ha generado antes de duplicar
            setTimeout(() => {
                commentsContainer.innerHTML = allCommentsHTML + allCommentsHTML; // Duplicamos todo el contenido al final
            }, 500);

            // Configuración del carrusel continuo
            let scrollAmount = 0;
            const scrollStep = 1; // Ajusta esta velocidad para que sea más lenta o más rápida

            function scrollCarousel() {
                scrollAmount -= scrollStep;
                commentsContainer.style.transform = `translateX(${scrollAmount}px)`;

                if (Math.abs(scrollAmount) >= commentsContainer.scrollWidth / 2) {
                    scrollAmount = 0;
                }
                requestAnimationFrame(scrollCarousel);
            }

            scrollCarousel(); // Iniciar el scroll continuo
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


</body>

</html>