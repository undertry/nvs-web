<div class="sidebar" id="sidebar">
  <a href="<?= base_url('home/animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
  <nav>
    <a href="<?= base_url('user/dashboard'); ?>" title="Dashboard">
    <i class="fa-solid fa-inbox"></i>
    </a>
    <a class="active" title="Scan Results">
    <i class="fa-solid fa-shield-virus"></i>
    </a>
    <a href="<?= base_url('user/history'); ?>" title="History">
    <i class="fa-solid fa-clock-rotate-left"></i>
    </a>
    <a href="#help" title="Help Center">
    <i class="fa-solid fa-circle-info"></i>
    </a>
  </nav>
  <div class="command-section">
    <div class="sidebar-item">
      <form id="wifiForm" method="post" action="<?= base_url('scan/startWifiScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitWifiForm()" title="Wifi">
      <i class="fa-solid fa-wifi"></i>
      </a>
    </div>
    <div class="sidebar-item">
      <form id="deviceForm" method="post" action="<?= base_url('scan/startDeviceScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitDeviceForm()" title="Device">
      <i class="fa-solid fa-tablet-alt"></i>
      </a>
    </div>
    <div class="sidebar-item">
      <form id="macForm" method="post" action="<?= base_url('scan/mac'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitMacForm()" title="MAC">
      <i class="fa-solid fa-microchip"></i>
      </a>
    </div>
    <div class="sidebar-item">
      <form id="nmapForm" method="post" action="<?= base_url('scan/startNmapScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitNmapForm()" title="Nmap">
      <i class="fa-solid fa-network-wired"></i>
      </a>
    </div>
  
  </div>
  <div class="profile-section">
    <a title="Profile"><i class="fa-solid fa-user-secret user" id="user-icon"></i></a>
    <a href="#" id="toggle-dark-mode" title="Mode"><i class="fa-solid fa-moon" id="mode-icon"></i></a>
    <div id="userModal" class="modal">
      <span class="close">&times;</span>
      <div class="modal-content">
        <h2><i class="fa-solid fa-user"></i> User Information</h2>
        <p><strong><i class="fa-solid fa-signature"></i> Name:</strong> <?= session('user')->name; ?></p>
        <p><strong><i class="fa-solid fa-envelope"></i> Email:</strong> <?= session('user')->email; ?></p>
        <p><strong><i class="fa-solid fa-clock"></i> Account created at:</strong> <?= session('user')->created_at; ?></p>
        <p><strong><i class="fa-solid fa-lock"></i> Verification:</strong>
          <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?>
        </p>
      </div>
    </div>
    <a href="<?= base_url('user/configuration') ?>" class="settings" title="Settings"><i class="fa-solid fa-gear"></i></a>
    <a href="<?= base_url('auth/logout'); ?>" title="Logout">
    <i class="fa-solid fa-sign-out"></i>
    </a>
  </div>
</div>

<div class="container">
<h1>Scan Results</h1>
    <div class="columns">
        <!-- Columna izquierda: Información de red y dispositivo -->
        <div class="left-column">
            <h2>Device Information</h2>
            <ul>
                <li><strong><i class="fa-solid fa-map-pin"></i> IP:</strong> <?= $nmap_ports_services['ip'] ?? 'N/A' ?></li>
                <li><strong><i class="fa-solid fa-tag"></i> MAC:</strong> <?= $nmap_ports_services['mac'] ?? 'N/A' ?></li>
                <li><strong><i class="fas fa-laptop"></i> Operating System:</strong> <?= $nmap_ports_services['os_info'] ?? 'N/A' ?></li>
            </ul>

            <h3>Port Information</h3>
            <?php if (!empty($nmap_ports_services['ports_services'])): ?>
                <ul>
                    <?php foreach ($nmap_ports_services['ports_services'] as $service): ?>
                        <li><strong><i class="fas fa-plug"></i> Port:</strong> <?= $service['port'] ?></li> 
                            <li><strong><i class="fas fa-circle-check"></i> Status:</strong> <?= $service['state'] ?></li> 
                            <li><strong><i class="fas fa-cogs"></i> Service:</strong> <?= $service['service'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No se encontraron servicios abiertos.</p>
            <?php endif; ?>
        </div>

        <!-- Columna derecha: Vulnerabilidades -->
        <div class="right-column">
            <h2>Vulnerability details</h2>
            <?php if (!empty($nmap_vulnerabilities['vulnerabilities'])): ?>
                <ul>
                    <?php foreach ($nmap_vulnerabilities['vulnerabilities'] as $vuln): ?>
                        <li><strong><i class="fas fa-code"></i> CVE:</strong> <?= $vuln['cve'] ?? 'No CVE disponible' ?> - <strong><?= $vuln['description'] ?></strong></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No se encontraron vulnerabilidades.</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- Botón para guardar resultados -->
<button id="save-results">Guardar Resultados</button>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    // Save results
    document.getElementById('save-results').addEventListener('click', function() {
        fetch('<?= site_url('scan/save-results') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Resultados guardados con éxito');
            } else {
                alert('Error al guardar los resultados');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al guardar los resultados');
        });
    });
});
</script>