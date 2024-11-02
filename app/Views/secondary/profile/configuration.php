<?= $this->include('modules/dashboard/configuration.php'); ?>
<title>Settings</title>
</head>
<body>
  <!-- Navbar Section -->
  <nav id="navbar">
    <div class="logo"><a href="<?= base_url('home-animation'); ?>">NVS</a></div>
    <div id="menuToggle" class="menu-icon">
      <span class="menu-icon-bar"></span>
      <span class="menu-icon-bar"></span>
      <span class="menu-icon-bar"></span>
    </div>
  </nav>
  <!-- Overlay Menu -->
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
          <li><a href="<?= base_url('home-animation'); ?>">Home</a></li>
          <?php if (session('user') && session('user')->id_user > 0 && session('user')->name) : ?>
          <li><a href="<?= base_url('dashboard-animation'); ?>"><?= session('user')->name; ?></a></li>
          <?php endif; ?>
        </ul>
        <button class="cta-button">Download</button>
      </div>
    </div>
  </div>

  <div class="settings-container">
  <h1>Settings</h1>
  <div class="under-development">
    <p>This section is under development.</p>
  </div>
  <div class="settings-sections">
    <!-- Datos Personales -->
    <div class="personal-info">
      <h2>Personal Information</h2>
      <div class="settings-info">
        <p><strong>Name:</strong> <?= session('user')->name; ?></p>
        <p><strong>Email:</strong> <?= session('user')->email; ?></p>
        <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
        <p><strong>Verification:</strong>
          <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?>
        </p>
      </div>
    </div>
    <!-- Funcionalidades -->
    <div class="functionalities">
      <h2>Functionalities</h2>
      <div class="card small">
        <h4>Credenciales Raspberry Pi</h4>
        <form method="post" action="<?= base_url('setCredentials'); ?>">
          <div class="form-inputs">
            <label for="raspberry_user">Usuario:</label>
            <input name="raspberry_user" type="text" id="raspberry_user" placeholder="Usuario de Raspberry" required>
            <label for="raspberry_password">Contraseña:</label>
            <input name="raspberry_password" type="password" id="raspberry_password" placeholder="Contraseña" required>
            <input type="submit" value="Guardar" class="btn-submit">
          </div>
        </form>
      </div>
      <div class="card small">
        <h4>Iniciar/Detener API</h4>
        <?php if (session()->getFlashdata('api_message')): ?>
      <div class="alert alert-info"><?= session()->getFlashdata('api_message') ?></div>
      <?php endif; ?>
        <form method="post" action="<?= base_url('startApi'); ?>" style="display: inline;">
          <input type="submit" value="Prender API" class="btn-submit">
        </form>
        <form method="post" action="<?= base_url('stopApi'); ?>" style="display: inline;">
          <input type="submit" value="Apagar API" class="btn-submit">
        </form>
        <h4>Monitor</h4>
        <?php if (session()->getFlashdata('monitor_message')): ?>
      <div class="alert alert-info"><?= session()->getFlashdata('monitor_message') ?></div>
      <?php endif; ?>
        <form method="post" action="<?= base_url('enableMonitor'); ?>" style="display: inline;">
          <input type="submit" value="Enable Monitor" class="btn-submit">
        </form>
        <form method="post" action="<?= base_url('desactiveMonitor'); ?>" style="display: inline;">
          <input type="submit" value="Desactive Monitor" class="btn-submit">
        </form>
      </div>
      <div class="settings-info">
        <button>
        <a href="<?= base_url('verification'); ?>">2 steps verification</a>
        </button>
        <button>
        <a href="<?= base_url('change_password'); ?>">Change password</a>
        </button>
      </div>
      <div class="card small">
        <h4>Cambiar IP de Interfaz</h4>
        <form method="post" action="<?= base_url('ipset'); ?>" class="form">
          <label for="ip">Última IP: <span id="lastIP"><?= esc($last_ip) ?: 'N/A' ?></span></label>
          <div class="form-inputs">
            <input name="ip" type="text" id="ip" placeholder="e.g. 192.168.2.170" required>
            <input type="submit" value="Enter" class="btn-submit">
          </div>
        </form>
      </div>
      <div class="quick-config">
        <!-- Card: Última Red Escaneada -->
        <div class="card small">
          <?php if (session()->getFlashdata('error')): ?>
          <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>
          <?php if (session()->getFlashdata('success')): ?>
          <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
          <?php endif; ?>
          <h4>Modo de escaneo:</h4>
          <form action="<?= site_url('setScanMode') ?>" method="post">
            <label for="mode">Modo de escaneo:</label>
            <select name="mode" id="mode" required>
              <option value="rapido">Rápido</option>
              <option value="intermedio">Intermedio</option>
              <option value="profundo">Profundo</option>
            </select>
            <button type="submit">Establecer Modo</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- JS for Menu Toggle -->
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
</body>
</html>
