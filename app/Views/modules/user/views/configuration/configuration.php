  <div class="sidebar" id="sidebar">
    <a href="<?= base_url('home/animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
    <nav>
      <a href="<?= base_url('user/dashboard'); ?>" title="Dashboard">
      <i class="fa-solid fa-inbox"></i>
      </a>
      <a href="<?= base_url('scan/nmap-results'); ?>" title="Scan Results">
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
      <!-- Formulario wifi -->
      <div class="sidebar-item">
        <form id="wifiForm" method="post" action="<?= base_url('scan/startWifiScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitWifiForm()" title="Wifi">
        <i class="fa-solid fa-wifi"></i>
        </a>
      </div>
      <!-- Formulario Device -->
      <div class="sidebar-item">
        <form id="deviceForm" method="post" action="<?= base_url('scan/startDeviceScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitDeviceForm()" title="Device">
        <i class="fa-solid fa-tablet-alt"></i>
        </a>
      </div>
      <!-- Formulario NMAP -->
      <div class="sidebar-item">
        <form id="nmapForm" method="post" action="<?= base_url('scan/startNmapScan'); ?>"></form>
        <a href="javascript:void(0);" onclick="submitNmapForm()" title="Nmap">
        <i class="fa-solid fa-network-wired"></i>
        </a>
      </div>
      <!-- Formulario MAC -->
      <div class="sidebar-item">
        <form id="macForm" method="post" action="<?= base_url('scan/mac'); ?>"></form>
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
        </div>
      </div>
      <a class="active settings" title="Settings"><i class="fa-solid fa-gear"></i></a>
      <a href="<?= base_url('auth/logout'); ?>" title="Logout">
      <i class="fa-solid fa-sign-out"></i>
      </a>
    </div>
  </div>
  <div class="dashboard">
    <div class="card-large">
      <div class="text-network">Functionalities</div>
      <div class="credentials-section">
        <h2 class="network toggle-title">
          Credentials
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <form method="post" action="<?= base_url('user/setCredentials'); ?>">
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
          <form method="post" action="<?= base_url('user/startApi'); ?>" style="display: inline;">
            <input type="submit" value="Prender API" class="btn-submit">
          </form>
          <form method="post" action="<?= base_url('user/stopApi'); ?>" style="display: inline;">
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
          <form method="post" action="<?= base_url('user/enableMonitor'); ?>" style="display: inline;">
            <input type="submit" value="Enable Monitor" class="btn-submit">
          </form>
          <form method="post" action="<?= base_url('scan/desactiveMonitor'); ?>" style="display: inline;">
            <input type="submit" value="Desactive Monitor" class="btn-submit">
          </form>
        </div>
      </div>

      <div class="ip-section">
        <h2 class="network ">IP
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <form method="post" action="<?= base_url('scan/ipset'); ?>" class="form">
            <label for="ip">Current IP: <span id="lastIP"><?= esc($last_ip) ?: 'N/A' ?></span></label>
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
          <form action="<?= site_url('scan/setScanMode') ?>" method="post">
            <label for="mode">Scan Mode:</label>
            <select name="mode" id="mode" required>
              <option value="quick">Quick</option>
              <option value="intermediate">Intermediate</option>
              <option value="deep">Deep</option>
            </select>
            <button type="submit">Set Scan Mode</button>
          </form>
        </div>
      </div>
    </div>
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
          <a href="<?= base_url('user/change_password'); ?>">Change password</a>
          </button>
        </div>
        </div>
        <div class="password-section">
        <h2 class="network">verification
        </h2>
        <span class="toggle-title"><i class="fa-solid fa-chevron-up arrow-icon"></i></span>
        <div class="content">
          <button>
          <a href="<?= base_url('user/verification'); ?>">verification</a>
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
