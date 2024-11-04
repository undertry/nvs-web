<?= $this->include('modules/dashboard/start.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<title>Dashboard</title>
</head>

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


<div class="dashboard">
  <!-- Tarjeta grande a la derecha -->
  <div class="card-large">
  <h2>View your Wifi Networks</h2>
  <div id="loading-spinner" style="display: none; text-align: center;">
    <div class="spinner-border text-primary" role="status"></div>
    <p><i class="fa-solid fa-spinner"></i></p>
  </div>
  <ul id="wifi-list" class="list-group mt-3"></ul>
  <button id="fetch-networks" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
  <hr class="hr">
  <div class="extra-section">
    <!-- Aquí puedes añadir el contenido adicional debajo de la lista de redes -->
    <p>Información adicional o una sección extra.</p>
  </div>
</div>


  <!-- Tarjetas pequeñas a la izquierda -->
  <div class="card-small card-top"><div class="text">Cybersecurity in real-time: Monitor - detect - respond</div>
  <div class="hr"></div>
<div class="subtext">Access a comprehensive set of tools to ensure your data's security. Scan your network for vulnerabilities, download detailed reports, and stay informed about potential threats. If you have any questions, click the help icon  <i class="fa-solid fa-circle-info"></i> for more information and support .</div></div>
  <div class="card-small card-bottom-left">Contenido de la tarjeta inferior izquierda 1</div>
  <div class="card-small card-bottom-right">Contenido de la tarjeta inferior izquierda 2</div>
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
