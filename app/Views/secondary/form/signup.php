<?= $this->include('modules/form/L-start.php'); ?>
<title>Sign Up</title>
</head>
<!-- Implementacion de Aviso de Mayuscula -->
<div id="caps-lock-warning-password" class="caps-lock-warning signup">
    <i class="fas fa-lock"></i> Caps Lock is on
</div>

<body>
    <!-- Mensaje de sesiones -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="message error signup"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="message success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <!-- Formulario de Registro -->
    <div id="particles-js"></div> <!-- Contenedor de partículas -->
    <div class="box-signup">
        <div class="box-content">
            <div class="image-container">
                <div id="sphere-js"></div>
                <h2 class="icon-top-left">
                    <a>
                        <i class="fa-solid fa-fingerprint"></i>
                    </a>
                </h2>

                <div class="back-to-website">
                    <a href="<?= base_url("home-animation"); ?>"><i class="fa-solid fa-arrow-left"></i></a>
                </div>

            </div>
            <form id="registerForm" method="post" action="<?= base_url('signup'); ?>" class="form">
                <h3 class="intro">Create an account</h3>
                <p>Already have an account? <a href="<?= base_url('login-animation'); ?>"> Log In</a></p>
                <div class="form-inputs">
                    <div class="form-label">
                        <input name="name" required type="text" id="name" placeholder="Your name"
                            value="<?= old('name'); ?>">
                    </div>
                    <div class="form-label">
                        <input name="email" required type="email" id="email" placeholder="Email"
                            value="<?= old('email'); ?>">
                    </div>
                    <div class="form-label">
                        <input name="password" required pattern=".{8,}" type="password" id="password"
                            placeholder="Password">
                        <div class="password-toggle">
                            <span toggle="#password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <!-- Popup de validación de contraseña -->
                        <div id="password-requirements" class="password-popup">
                            <p>Your password must contain:</p>
                            <ul>
                                <li id="length">At least 8 characters</li>
                                <li id="uppercase">1 uppercase letter</li>
                                <li id="special">1 special character (!@#$&*)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-label">
                        <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password"
                            placeholder="Confirm Password">
                        <div class="password-toggle">
                            <span toggle="#confirm_password" class="field-icon toggle-password"><i
                                    class="fa-solid fa-eye-slash"></i></span>
                        </div>
                        <!-- Implementacion de Aviso de Mayuscula -->
                        <div id="caps-lock-warning-confirm-password" class="caps-lock-warning">Caps Lock is on</div>
                    </div>
                </div>
                <!-- Checkbox de aceptación de términos y condiciones -->
                <div class="form-label">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">I accept the <a href="<?= base_url('terms-and-conditions'); ?>" target="_blank">terms and conditions</a></label>
                </div>
                <input type="submit" value="Continue">
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const lengthRequirement = document.getElementById('length');
            const uppercaseRequirement = document.getElementById('uppercase');
            const specialRequirement = document.getElementById('special');

            // Verificar longitud mínima
            if (password.length >= 8) {
                lengthRequirement.classList.add('valid');
                lengthRequirement.classList.remove('invalid');
            } else {
                lengthRequirement.classList.add('invalid');
                lengthRequirement.classList.remove('valid');
            }

            // Verificar una letra mayúscula
            if (/[A-Z]/.test(password)) {
                uppercaseRequirement.classList.add('valid');
                uppercaseRequirement.classList.remove('invalid');
            } else {
                uppercaseRequirement.classList.add('invalid');
                uppercaseRequirement.classList.remove('valid');
            }

            // Verificar un carácter especial
            if (/[!@#$&*]/.test(password)) {
                specialRequirement.classList.add('valid');
                specialRequirement.classList.remove('invalid');
            } else {
                specialRequirement.classList.add('invalid');
                specialRequirement.classList.remove('valid');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.0.0/tsparticles.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        // Configuramos la escena, la cámara y el renderizador
        let scene = new THREE.Scene();
        let camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        let renderer = new THREE.WebGLRenderer({
            alpha: true
        }); // Hacemos el fondo transparente para combinar con el diseño
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.getElementById('sphere-js').appendChild(renderer.domElement);

        // Configuramos el color de fondo desde CSS
        renderer.setClearColor(0x000000, 0); // Transparente

        // Cargamos la textura circular para los puntos
        let loader = new THREE.TextureLoader();
        let circleTexture = loader.load('https://threejs.org/examples/textures/sprites/disc.png');

        // Creamos una geometría de icosaedro para los nodos y conexiones
        let geometry = new THREE.IcosahedronGeometry(2, 1);
        let material = new THREE.PointsMaterial({
            color: 0xffffff, // Color blanco para los puntos
            size: 0.1, // Ajusta el tamaño de los puntos
            map: circleTexture, // Aplica la textura circular cargada
            alphaTest: 0.5 // Para evitar problemas de transparencia en los bordes
        });

        // Creamos la geometría de líneas conectando los puntos
        let wireframeMaterial = new THREE.LineBasicMaterial({
            color: 0x555555 // Color gris tenue para las conexiones
        });
        let wireframe = new THREE.WireframeGeometry(geometry);

        // Creamos los puntos y las conexiones
        let points = new THREE.Points(geometry, material);
        let line = new THREE.LineSegments(wireframe, wireframeMaterial);

        // Añadimos ambos a la escena
        scene.add(points);
        scene.add(line);

        // Posicionamos la cámara
        camera.position.z = 10;

        // Rotación automática
        let autoRotateSpeed = 0.002;

        // Animación
        function animate() {
            requestAnimationFrame(animate);

            // Rotación automática
            points.rotation.y += autoRotateSpeed;
            line.rotation.y += autoRotateSpeed;

            renderer.render(scene, camera);
        }
        animate();

        // Ajuste de la ventana
        window.addEventListener('resize', () => {
            let width = window.innerWidth;
            let height = window.innerHeight;
            renderer.setSize(width, height);
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
        });
    </script>

    <script>
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 120
                },
                color: {
                    value: '#ffffff'
                },
                shape: {
                    type: 'circle'
                },
                opacity: {
                    value: 0.1,
                    random: false
                },
                size: {
                    value: 3,
                    random: true
                },
                line_linked: {
                    enable: true,
                    distance: 0,
                    color: '#ffffff',
                    opacity: 0.4,
                    width: 1
                },
                move: {
                    speed: 1,
                    random: true,
                    direction: 'none',
                    out_mode: 'out',
                }
            },
            interactivity: {
                events: {
                    onhover: {
                        enable: false,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: false,
                        mode: 'push'
                    },
                }
            },
            retina_detect: true
        });
    </script>
    <?= $this->include('modules/form/L-end.php'); ?>