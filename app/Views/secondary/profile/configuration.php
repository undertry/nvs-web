<link rel="stylesheet" href="<?php echo base_url('complements/styles/secondary/profile/configuration.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Settings</title>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <a href="<?= base_url('home-animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
    <nav>
      <a href="<?= base_url('dashboard'); ?>" title="Dashboard">
      <i class="fa-solid fa-inbox"></i>
      </a>
      <a href="<?= base_url('nmap-animation'); ?>" title="Scan Results">
      <i class="fa-solid fa-shield-virus"></i>
      </a>
      <a href="<?= base_url('history-animation'); ?>" title="History">
      <i class="fa-solid fa-clock-rotate-left"></i>
      </a>
      <a href="#help" title="Help Center">
      <i class="fa-solid fa-circle-info"></i>
      </a>
    </nav>
    <div class="command-section">
      <!-- Formulario wifi -->
      <div class="sidebar-item">
        <form id="wifiForm" method="post" action="<?= base_url('startWifiScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitWifiForm()" title="Wifi">
        <i class="fa-solid fa-wifi"></i>
        </a>
      </div>
      <!-- Formulario Device -->
      <div class="sidebar-item">
        <form id="deviceForm" method="post" action="<?= base_url('startDeviceScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitDeviceForm()" title="Device">
        <i class="fa-solid fa-tablet-alt"></i>
        </a>
      </div>
      <!-- Formulario NMAP -->
      <div class="sidebar-item">
        <form id="nmapForm" method="post" action="<?= base_url('startNmapScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitNmapForm()" title="Nmap">
        <i class="fa-solid fa-network-wired"></i>
        </a>
      </div>
      <!-- Formulario MAC -->
      <div class="sidebar-item">
        <form id="macForm" method="post" action="<?= base_url('mac'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitMacForm()" title="MAC">
        <i class="fa-solid fa-microchip"></i>
        </a>
      </div>
    </div>
    <div class="profile-section">
      <a title="Profile"><i class="fa-solid fa-user-secret user" id="user-icon"></i></a>
      <a href="#" id="toggle-dark-mode" title="Mode"><i class="fa-solid fa-moon" id="mode-icon"></i></a>
      <!-- Modal de Perfil de Usuario -->
      <div id="userModal" class="modal">
        <span class="close">&times;</span>
        <div class="modal-content">
          <h2>User Information</h2>
          <p><strong>Name:</strong> <?= session('user')->name; ?></p>
          <p><strong>Email:</strong> <?= session('user')->email; ?></p>
          <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
          <p><strong>Verification:</strong>
            <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?>
          </p>
          <!-- Puedes agregar más datos del usuario aquí -->
        </div>
      </div>
      <a href="<?= base_url('configuration') ?>" class="active settings" title="Settings"><i class="fa-solid fa-gear"></i></a>
      <a href="<?= base_url('logout'); ?>" title="Logout">
      <i class="fa-solid fa-sign-out"></i>
      </a>
    </div>
  </div>
  <div class="dashboard">
    <!-- Tarjeta grande a la derecha -->
    <!-- Tarjeta grande a la derecha -->
    <div class="card-large">
      <div class="text-network">Functionalities</div>
      <div class="credentials-section">
        <h2 class="network toggle-title">
          Credentials
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
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
      </div>
      <div class="api-section">
        <h2 class="network">API
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <?php if (session()->getFlashdata('api_message')): ?>
        <div class="alert alert-info"><?= session()->getFlashdata('api_message') ?></div>
        <?php endif; ?>
        <div class="content">
          <form method="post" action="<?= base_url('startApi'); ?>" style="display: inline;">
            <input type="submit" value="Prender API" class="btn-submit">
          </form>
          <form method="post" action="<?= base_url('stopApi'); ?>" style="display: inline;">
            <input type="submit" value="Apagar API" class="btn-submit">
          </form>
        </div>
      </div>
      <div class="monitor-section">
        <h2 class="network">Monitor
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <?php if (session()->getFlashdata('monitor_message')): ?>
        <div class="alert alert-info"><?= session()->getFlashdata('monitor_message') ?></div>
        <?php endif; ?>
        <div class="content">
          <form method="post" action="<?= base_url('enableMonitor'); ?>" style="display: inline;">
            <input type="submit" value="Enable Monitor" class="btn-submit">
          </form>
          <form method="post" action="<?= base_url('desactiveMonitor'); ?>" style="display: inline;">
            <input type="submit" value="Desactive Monitor" class="btn-submit">
          </form>
        </div>
      </div>

      <div class="ip-section">
        <h2 class="network ">IP
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <form method="post" action="<?= base_url('ipset'); ?>" class="form">
            <label for="ip">Última IP: <span id="lastIP"><?= esc($last_ip) ?: 'N/A' ?></span></label>
            <div class="form-inputs">
              <input name="ip" type="text" id="ip" placeholder="e.g. 192.168.2.170" required>
              <input type="submit" value="Enter" class="btn-submit">
            </div>
          </form>
        </div>
      </div>
      <div class="scan-section">
        <h2 class="network">Scan Mode
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
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
    <!-- Tarjetas pequeñas a la izquierda -->
    <div class="card-small card-top">
      <div class="text">Cybersecurity in real-time</div>
      <div class="hr"></div>
      <div class="subtext"></div>
    </div>

    <div class="card-small card-top-right">
    <div class="text-information">Information</div>
    <div class="password-section">
        <h2 class="network">Password
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <button>
          <a href="<?= base_url('change_password'); ?>">Change password</a>
          </button>
        </div>
        </div>
        <div class="password-section">
        <h2 class="network">verification
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <button>
          <a href="<?= base_url('verification'); ?>">verification</a>
          </button>
        </div>
        </div>
    </div>
    <div class="card-small card-bottom-right">
      <div class="text-information">Information</div>
      <div class="section-container">
        <div class="left-column">
          <div class="configuration">
            <h3 class="information">Your Configuration</h3>
            <p><strong><i class="fa-solid fa-map-pin"></i> Current IP:</strong> <?= session('ip'); ?></p>
            <p><strong><i class="fas fa-sliders-h"></i> Chosen Mode:</strong> <?= session('mode'); ?></p>
          </div>
          <div class="alerts">
            <h3 class="information">Alerts</h3>
            <!-- Mensaje de alerta para WiFi -->
            <?php if (session()->getFlashdata('wifi_message')): ?>
            <div class="alert <?= strpos(session()->getFlashdata('wifi_message'), 'Error') !== false ? 'alert-error' : 'alert-success' ?>">
              <?= session()->getFlashdata('wifi_message') ?>
            </div>
            <?php endif; ?>
            <!-- Mensaje de alerta para Device -->
            <?php if (session()->getFlashdata('device_message')): ?>
            <div class="alert <?= strpos(session()->getFlashdata('device_message'), 'Error') !== false ? 'alert-error' : 'alert-success' ?>">
              <?= session()->getFlashdata('device_message') ?>
            </div>
            <?php endif; ?>
            <!-- Mensaje de alerta para Nmap -->
            <?php if (session()->getFlashdata('nmap_message')): ?>
            <div class="alert <?= strpos(session()->getFlashdata('nmap_message'), 'Error') !== false ? 'alert-error' : 'alert-success' ?>">
              <?= session()->getFlashdata('nmap_message') ?>
            </div>
            <?php endif; ?>
            <!-- Mensaje de alerta para CSV -->
            <?php if (session()->getFlashdata('csv_message')): ?>
            <div class="alert <?= strpos(session()->getFlashdata('csv_message'), 'Error') !== false ? 'alert-error' : 'alert-success' ?>">
              <?= session()->getFlashdata('csv_message') ?>
            </div>
            <?php endif; ?>
            <!-- Mensaje de alerta para MAC -->
            <?php if (session()->getFlashdata('mac_message')): ?>
            <div class="alert <?= strpos(session()->getFlashdata('mac_message'), 'Error') !== false ? 'alert-error' : 'alert-success' ?>">
              <?= session()->getFlashdata('mac_message') ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="last-network">
          <h3 class="information">Current Network</h3>
          <?php if (session()->has('current_network')): ?>
          <p><strong><i class="fa-solid fa-wifi"></i> ESSID:</strong> <?= session('current_network')['essid']; ?></p>
          <p><strong><i class="fa-solid fa-tag"></i> BSSID:</strong> <?= session('current_network')['bssid']; ?></p>
          <p><strong><i class="fa-solid fa-signal"></i> Signal:</strong> <?= session('current_network')['signal']; ?></p>
          <p><strong><i class="fa-solid fa-list"></i> Channel:</strong> <?= session('current_network')['channel']; ?></p>
          <p><strong><i class="fa-solid fa-lock"></i> Encryption:</strong> <?= session('current_network')['security']; ?></p>
          <?php else: ?>
          <p>No previous scan results were found.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url('complements/functionality/main/home/cursor.js'); ?>"></script>
  <script src="<?php echo base_url('complements/functionality/main/home/cookies.js'); ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
document.addEventListener("DOMContentLoaded", function() {
  // Seleccionar todas las flechas de toggle
  const toggleTitles = document.querySelectorAll(".toggle-title");

  toggleTitles.forEach((title) => {
    title.addEventListener("click", function(event) {
      // Evita que el evento afecte otros elementos
      event.stopPropagation();

      // Obtener la sección asociada a la flecha clickeada
      const section = this.parentElement;

      // Cerrar todas las demás secciones antes de abrir la seleccionada
      document.querySelectorAll(".expanded").forEach(expandedSection => {
        if (expandedSection !== section) {
          expandedSection.classList.remove("expanded");
          expandedSection.querySelector(".arrow-icon").classList.remove("rotate");
        }
      });

      // Alternar la expansión de la sección actual
      section.classList.toggle("expanded");
      this.querySelector(".arrow-icon").classList.toggle("rotate");
    });
  });
});
</script>

  <script>
    function submitWifiForm() {
      document.getElementById("wifiForm").submit();
    }
    
    function submitDeviceForm() {
      document.getElementById("deviceForm").submit();
    }
    
    function submitNmapForm() {
      document.getElementById("nmapForm").submit();
    }
    
    function submitCsvForm() {
      document.getElementById("csvForm").submit();
    }
    
    function submitMacForm() {
      document.getElementById("macForm").submit();
    }
  </script>
  <script>
    document.getElementById('user-icon').onclick = function() {
      // Muestra el modal
      document.getElementById('userModal').style.display = "block";
    }
    
    document.querySelector('.close').onclick = function() {
      // Oculta el modal
      document.getElementById('userModal').style.display = "none";
    }
    
    // Cierra el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
      if (event.target == document.getElementById('userModal')) {
        document.getElementById('userModal').style.display = "none";
      }
    }
  </script>
  <script>
    document.getElementById('fetch-networks').addEventListener('click', function() {
      const wifiList = document.getElementById('wifi-list');
      const loadingSpinner = document.getElementById('loading-spinner');
      const arrowIcon = this.querySelector('.arrow-icon');
    
      // Mostrar u ocultar la lista de redes y rotar la flecha
      if (wifiList.style.display === 'none') {
        wifiList.style.display = 'block';
        arrowIcon.classList.add('rotate');
        loadingSpinner.style.display = 'block';
        wifiList.innerHTML = '';
    
        fetch('fetchNetworks')
          .then(response => response.json())
          .then(data => {
            loadingSpinner.style.display = 'none';
    
            if (!data.success) {
              alert(data.message);
              return;
            }
    
            data.data.forEach(network => {
              const listItem = document.createElement('li');
              listItem.className = 'list-group-item';
    
              const detailsDiv = document.createElement('div');
              detailsDiv.className = 'network-details';
              detailsDiv.innerHTML = `
                      <p><strong><i class="fa-solid fa-wifi"></i> ESSID:</strong> ${network.ESSID}</p>
                      <p><strong><i class="fa-solid fa-tag"></i> BSSID:</strong> ${network.BSSID}</p>
                      <p><strong><i class="fa-solid fa-list"></i> Canal:</strong> ${network.Channel}</p>
                      <p><strong><i class="fa-solid fa-signal"></i> Frecuencia:</strong> ${network.Signal}</p>
                      <p><strong><i class="fa-solid fa-lock"></i> Encryption:</strong> ${network.Encryption}</p>
                      <button class="btn btn-primary select-network-btn">Seleccionar Red WiFi</button>
                    `;
    
              detailsDiv.querySelector('.select-network-btn').addEventListener('click', function() {
                selectNetwork(network);
              });
    
              listItem.appendChild(detailsDiv);
              wifiList.appendChild(listItem);
            });
          })
          .catch(error => {
            loadingSpinner.style.display = 'none';
            console.error('Error al obtener las redes:', error);
            alert('Error al conectar con la API. Por favor, asegúrate de que está inicializada.');
          });
      } else {
        wifiList.style.display = 'none';
        arrowIcon.classList.remove('rotate');
      }
    });
    
    
    // Función para enviar la red seleccionada al controlador
    function selectNetwork(network) {
      fetch('select-network', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            essid: network.ESSID,
            bssid: network.BSSID,
            signal: network.Signal,
            channel: network.Channel,
            encryption: network.Encryption
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Red WiFi seleccionada con éxito');
          } else {
            alert('Error al seleccionar la red WiFi');
          }
        })
        .catch(error => console.error('Error al seleccionar la red:', error));
    }
  </script>
  <script>
    // Función para alternar la visualización de la lista de dispositivos y la rotación de la flecha
    document.getElementById('fetch-devices').addEventListener('click', function() {
      const deviceList = document.getElementById('device-list');
      const loadingSpinnerDevice = document.getElementById('loading-spinner-device');
      const arrowIcon = this.querySelector('.arrow-icon');
    
      // Mostrar u ocultar la lista de dispositivos y rotar la flecha
      if (deviceList.style.display === 'none') {
        deviceList.style.display = 'block';
        arrowIcon.classList.add('rotate');
        loadingSpinnerDevice.style.display = 'block';
        deviceList.innerHTML = '';
    
        fetch('fetchDevices')
          .then(response => response.json())
          .then(data => {
            loadingSpinnerDevice.style.display = 'none';
    
            if (!data.success) {
              alert(data.message);
              return;
            }
    
            data.data.forEach(device => {
              const listItem = document.createElement('li');
              listItem.className = 'list-group-item';
    
              const detailsDiv = document.createElement('div');
              detailsDiv.className = 'device-details';
              detailsDiv.innerHTML = `
                      <p><strong><i class="fa-solid fa-tag"></i> MAC Address:</strong> ${device.mac_address}</p>
                      <p><strong><i class="fa-solid fa-map-pin"></i> IP Address:</strong> ${device.ip_address}</p>
                    `;
              listItem.appendChild(detailsDiv);
              deviceList.appendChild(listItem);
            });
          })
          .catch(error => {
            loadingSpinnerDevice.style.display = 'none';
            console.error('Error al obtener los dispositivos:', error);
            alert('Error al conectar con la API de dispositivos. Por favor, asegúrate de que está inicializada.');
          });
      } else {
        deviceList.style.display = 'none';
        arrowIcon.classList.remove('rotate');
      }
    });
  </script>
</body>
</html>
