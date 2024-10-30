<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/form/start.css'); ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('complements/styles/main/home/navbar.css'); ?>">
  <title>Cambiar Contraseña</title>

</head>

<body>
  <!-- Implementation of Mayus Warning -->
  <div id="caps-lock-warning-password" class="caps-lock-warning login">
    <i class="fas fa-lock"></i> Caps Lock is on
  </div>
  <!-- Mensaje de sesiones -->
  <?php if (session()->getFlashdata('error')) : ?>
    <div class="message error"><?= session()->getFlashdata('error'); ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('success')) : ?>
    <div class="message success"><?= session()->getFlashdata('success'); ?></div>
  <?php endif; ?>
  <?php if (session()->getFlashdata('error') === 'The passwords do not match.') : ?>
  <?php endif; ?>
  <a href="#" id="toggle-dark-mode"><i class="fa-solid fa-moon" id="mode-icon"></i></a>



  <div id="particles-js"></div>
  <div class="box">
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

      <?php if (session('user')) : ?>
        <form method="post" action="<?= base_url('password_change'); ?>" class="form" onsubmit="return validatePassword()">
          <h3 class="intro">Change Password</h3>
          <div class="form-inputs">

            <div class="form-label">
              <input name="current_password" required pattern=".{8,}" type="password" id="current_password" placeholder="Enter your current password">

            </div>

            <div class="form-label">
              <input name="password" required pattern=".{8,}" type="password" id="password" placeholder="Enter your new password">
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
              <input name="confirm_password" required pattern=".{8,}" type="password" id="confirm_password" placeholder="Confirm your new password">
              <div class="password-toggle">
                <span toggle="#confirm_password" class="field-icon toggle-password"><i
                    class="fa-solid fa-eye-slash"></i></span>
              </div>

            </div>
            <div class="form-label">
              <input type="submit" value="Change Password">
            </div>
        </form>

      <?php else : ?>
        <p><a href="<?= base_url('login'); ?>">Log In</a></p>
      <?php endif; ?>
    </div>
  </div>

  <script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>
  <script src="<?php echo base_url('complements/functionality/main/home/navbar.js'); ?>"></script>
  <script src="<?php echo base_url('complements/functionality/main/home/cursor.js'); ?>"></script>
  <script src="<?php echo base_url('complements/functionality/secondary/form/password.js'); ?>"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.0.0/tsparticles.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
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
  <script>
    // Función para actualizar los colores de la esfera según el modo
    function updateSphereColor(mode) {
      const pointColor = mode === "light" ? 0x151414 : 0xcfcfcf; // Negro para modo claro, blanco para modo oscuro
      const lineColor = mode === "light" ? 0xcfcfcf : 0x535151; // Negro para modo claro, gris para modo oscuro

      // Cambiamos el color de los puntos
      points.material.color.set(pointColor);

      // Cambiamos el color de las líneas
      line.material.color.set(lineColor);
    }

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
      color: 0xffffff, // Color blanco inicial para los puntos
      size: 0.1, // Ajusta el tamaño de los puntos
      map: circleTexture, // Aplica la textura circular cargada
      alphaTest: 0.5 // Para evitar problemas de transparencia en los bordes
    });

    // Creamos la geometría de líneas conectando los puntos
    let wireframeMaterial = new THREE.LineBasicMaterial({
      color: 0x555555 // Color gris tenue inicial para las conexiones
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

    // Detecta el tema del sistema operativo (claro/oscuro) automáticamente
    function detectColorScheme() {
      if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        // Modo oscuro
        updateSphereColor('dark');
      } else {
        // Modo claro
        updateSphereColor('light');
      }
    }

    // Llama a la función inicialmente
    detectColorScheme();

    // Escucha los cambios en el tema del sistema operativo
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      const newColorScheme = e.matches ? "dark" : "light";
      updateSphereColor(newColorScheme);
    });
  </script>

  <script>
    // Función optimizada para actualizar los colores sin reiniciar las partículas
    function updateParticlesColor(mode) {
      const particlesColor = mode === "light" ? "#000000" : "#ffffff";
      const lineLinkedColor = mode === "light" ? "#000000" : "#ffffff";

      // Acceder directamente al objeto global de particles.js para cambiar los colores
      const particles = window.pJSDom[0].pJS.particles;

      // Cambiar color de las partículas y las líneas
      particles.color.value = particlesColor;
      particles.line_linked.color = lineLinkedColor;

      // Aplicar los cambios visuales inmediatamente
      window.pJSDom[0].pJS.fn.particlesRefresh();
    }

    // Inicializa las partículas
    particlesJS("particles-js", {
      particles: {
        number: {
          value: 100,
        },
        color: {
          value: "#ffffff", // Color inicial, será actualizado dinámicamente
        },
        shape: {
          type: "circle",
        },
        opacity: {
          value: 0.5,
          random: false,
        },
        size: {
          value: 3,
          random: true,
        },
        line_linked: {
          enable: true,
          distance: 0,
          color: "#ffffff", // Color inicial, será actualizado dinámicamente
          opacity: 0.4,
          width: 1,
        },
        move: {
          speed: 1,
          random: true,
          direction: "none",
          out_mode: "out",
        },
      },
      interactivity: {
        events: {
          onhover: {
            enable: true,
            mode: "grab",
          },
          onclick: {
            enable: true,
            mode: "push",
          },
        },
      },
      retina_detect: true,
    });
  </script>
</body>

</html>