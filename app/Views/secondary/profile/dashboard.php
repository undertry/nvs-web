<?= $this->include('modules/dashboard/start.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Dashboard</title>
</head>
<div id="particles-js"></div>
<div class="sidebar" id="sidebar">
  <a href="<?= base_url('home-animation');?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
  <nav>
    <a class="active" title="Dashboard">
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
    <a href="javascript:void(0);"  onclick="submitWifiForm()" title="Wifi">
      <i class="fa-solid fa-wifi"></i>
    </a>
  </div>
  
  <!-- Formulario Device -->
    <div class="sidebar-item">
    <form id="deviceForm" method="post" action="<?= base_url('startDeviceScan'); ?>"></form>
    <a href="javascript:void(0);"  onclick="submitDeviceForm()" title="Device">
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
   
  <!-- Formulario CSV -->
  <div class="sidebar-item">
    <form id="csvForm" method="post" action="<?= base_url('csv'); ?>"></form>
    <a href="javascript:void(0);" onclick="submitCsvForm()" title="CSV">
      <i class="fa-solid fa-file-csv"></i>
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
          <!-- Modal de Perfil de Usuario -->
    <div id="userModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
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
        <a href="<?= base_url('configuration') ?>" class="settings" title="Settings"><i class="fa-solid fa-gear"></i></a>
        <a href="<?= base_url('logout'); ?>" title="Logout">
        <i class="fa-solid fa-sign-out"></i>
        </a>

    </div>
</div>



<div class="main-content">
 
  <div class="content-wrapper">
    <!-- Sección de Redes WiFi -->
    <div class="wifi-section">
      <div class="section-header hidden">
        <h2><i class="fa-brands fa-uncharted"></i></h2>
      </div>
      <h2> Available WiFi Networks</h2>
      <button id="fetch-networks" class="btn btn-primary">Start Scan</button>
      <div id="loading-spinner" style="display: none; text-align: center;">
        <div class="spinner-border text-primary" role="status"></div>
        <p><i class="fa-solid fa-spinner"></i></p>
      </div>
      <ul id="wifi-list" class="list-group mt-3"></ul>
    </div>
    <div class="device-section">
  <div class="section-header hidden">
    <h2><i class="fa-brands fa-uncharted"></i></h2>
  </div>
  <h2>Available Devices</h2>
  <button id="fetch-devices" class="btn btn-primary">Start Scan</button>
  <div id="loading-spinner-device" style="display: none; text-align: center;">
    <div class="spinner-border text-primary" role="status"></div>
    <p><i class="fa-solid fa-spinner"></i></p>
  </div>
  <ul id="device-list" class="list-group mt-3"></ul>
</div>
</div>



</div>


  <div class="accordion-section">
    <div class="text">
      <h3>Menu</h3>
    </div>
    
    <!-- Información -->
    <div class="accordion-item">
      <h2 class="accordion-title">
        <i class="fa-solid fa-database icon"></i> Information
      </h2>
      <div id="info-content" class="accordion-content">
        <p><strong>Current IP:</strong> <?= session('ip'); ?></p>
        <p><strong>Chosen Mode:</strong> <?= session('mode'); ?></p>
      </div>
    </div>

    <!-- Red actual -->
    <div class="accordion-item">
      <h2 class="accordion-title">
        <i class="fa-solid fa-wifi icon"></i> Current Network
      </h2>
      <div id="last-network-content" class="accordion-content">
        <?php if (session()->has('current_network')): ?>
          <p><strong>Current Network Selected:</strong> <?= session('current_network')['essid']; ?></p>
          <p><strong>BSSID:</strong> <?= session('current_network')['bssid']; ?></p>
          <p><strong>Signal:</strong> <?= session('current_network')['signal']; ?></p>
          <p><strong>Channel:</strong> <?= session('current_network')['channel']; ?></p>
          <p><strong>Encryption:</strong> <?= session('current_network')['security']; ?></p>
        <?php else: ?>
          <p>No previous scan results were found.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Alertas -->
    <div class="accordion-item">
      <h2 class="accordion-title">
        <i class="fa-solid fa-bell icon"></i> Alerts
      </h2>
      <div id="scan-content" class="accordion-content">
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
  </div>





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
  
      // Mostrar el spinner y limpiar la lista de redes
      loadingSpinner.style.display = 'block';
      wifiList.innerHTML = '';
  
      fetch('fetchNetworks')
          .then(response => response.json())
          .then(data => {
              loadingSpinner.style.display = 'none'; // Ocultar el spinner
  
              if (!data.success) {
                  alert(data.message);
                  return;
              }
  
              // Mostrar redes en la lista si la respuesta es exitosa
              data.data.forEach(network => {
                  const listItem = document.createElement('li');
                  listItem.className = 'list-group-item';
                  listItem.textContent = network.ESSID;
  
                  const detailsDiv = document.createElement('div');
                  detailsDiv.className = 'network-details';
                  detailsDiv.innerHTML = `
                  <p><strong>BSSID:</strong> ${network.BSSID}</p>
                  <p><strong>Canal:</strong> ${network.Channel}</p>
                  <p><strong>Frecuencia:</strong> ${network.Signal}</p>
                     <p><strong>Encryption:</strong> ${network.Encryption}</p>
                  <button class="btn btn-primary select-network-btn">Seleccionar Red WiFi</button>
              `;
              
  
                  listItem.addEventListener('click', function() {
                      const isVisible = detailsDiv.style.display === 'block';
                      detailsDiv.style.display = isVisible ? 'none' : 'block';
                  });
  
                  detailsDiv.querySelector('.select-network-btn').addEventListener('click', function() {
                      selectNetwork(network);
                  });
  
                  listItem.appendChild(detailsDiv);
                  wifiList.appendChild(listItem);
              });
          })
          .catch(error => {
              loadingSpinner.style.display = 'none'; // Ocultar el spinner si ocurre un error
              console.error('Error al obtener las redes:', error);
              alert('Error al conectar con la API. Por favor, asegúrate de que está inicializada.');
          });
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
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
// Evento para el botón de dispositivos
document.getElementById('fetch-devices').addEventListener('click', function() {
    const deviceList = document.getElementById('device-list');
    const loadingSpinnerDevice = document.getElementById('loading-spinner-device');

    // Mostrar el spinner y limpiar la lista de dispositivos
    loadingSpinnerDevice.style.display = 'block';
    deviceList.innerHTML = '';

    fetch('fetchDevices')
        .then(response => response.json())
        .then(data => {
            loadingSpinnerDevice.style.display = 'none'; // Ocultar el spinner

            if (!data.success) {
                alert(data.message);
                return;
            }

            // Mostrar dispositivos en la lista si la respuesta es exitosa
            data.data.forEach(device => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
         

                const detailsDiv = document.createElement('div');
                detailsDiv.className = 'device-details';
                detailsDiv.innerHTML = `
                 <p><strong>MAC Address:</strong> ${device.mac_address}</p>
                    <p><strong>IP Address:</strong> ${device.ip_address}</p>
                `;

                // Mostrar/ocultar detalles al hacer clic en el elemento de la lista
                listItem.addEventListener('click', function() {
                    const isVisible = detailsDiv.style.display === 'block';
                    detailsDiv.style.display = isVisible ? 'none' : 'block';
                });

                listItem.appendChild(detailsDiv);
                deviceList.appendChild(listItem);
            });
        })
        .catch(error => {
            loadingSpinnerDevice.style.display = 'none'; // Ocultar el spinner si ocurre un error
            console.error('Error al obtener los dispositivos:', error);
            alert('Error al conectar con la API de dispositivos. Por favor, asegúrate de que está inicializada.');
        });
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
      value: 0.3,
      random: false,
    },
    size: {
      value: 3,
      random: true,
    },
    line_linked: {
      enable: true,
      distance: 150,
      color: "#222222", // Color inicial, será actualizado dinámicamente
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
