<div class="sidebar" id="sidebar">
  <a href="<?= base_url('home/animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
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
    <div class="sidebar-item">
      <form id="wifiForm" method="post" action="<?= base_url('startWifiScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitWifiForm()" title="Wifi">
      <i class="fa-solid fa-wifi"></i>
      </a>
    </div>
    <div class="sidebar-item">
      <form id="deviceForm" method="post" action="<?= base_url('startDeviceScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitDeviceForm()" title="Device">
      <i class="fa-solid fa-tablet-alt"></i>
      </a>
    </div>
    <div class="sidebar-item">
      <form id="nmapForm" method="post" action="<?= base_url('startNmapScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitNmapForm()" title="Nmap">
      <i class="fa-solid fa-network-wired"></i>
      </a>
    </div>
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
<div class="dashboard">
  <div class="card-large">
    <div class="text-network">Network Dashboard</div>
    <div class="wifi-section">
      <h2 class="network">Available WiFi Networks</h2>
      <div id="loading-spinner" style="display: none; text-align: center;">
        <div class="spinner-border text-primary" role="status"></div>
        <p><i class="fa-solid fa-spinner"></i></p>
      </div>
      <ul id="wifi-list" class="list-group mt-3" style="display: none;"></ul>
      <button id="fetch-networks" class="btn btn-primary toggle-btn">
      <i class="fa-solid fa-chevron-down arrow-icon"></i>
      </button>
    </div>
    <div class="device-section">
      <h2 class="network">Connected Devices</h2>
      <div id="loading-spinner-device" style="display: none; text-align: center;">
        <div class="spinner-border text-primary" role="status"></div>
        <p><i class="fa-solid fa-spinner"></i></p>
      </div>
      <ul id="device-list" class="list-group2 mt-3" style="display: none;"></ul>
      <button id="fetch-devices" class="btn btn-secondary toggle-btn">
      <i class="fa-solid fa-chevron-down arrow-icon"></i>
      </button>
    </div>
  </div>
  <div class="card-small card-top">
    <div class="text">Cybersecurity in real-time: <br> Monitor - detect - respond</div>
    <div class="hr"></div>
    <div class="subtext">
      <p>Access a comprehensive set of tools to ensure your data's security. Scan your network for vulnerabilities, download detailed reports, and stay informed about potential threats. If you have any questions, click the help icon <i class="fa-solid fa-circle-info"></i> for more information and support . </p>
    </div>
  </div>
  <div class="card-small card-bottom-left">
    <div class="wallpaper">
      <img src="<?= base_url('complements/styles/images/dots.png'); ?>" alt="">
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
