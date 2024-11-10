<div class="dashboard-wrapper">
<div class="sidebar" id="sidebar">
  <a href="<?= base_url('home/animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
  <nav>
    <a href="<?= base_url('user/dashboard'); ?>" title="Dashboard">
    <i class="fa-solid fa-inbox"></i>
    </a>
    <a href="<?= base_url('scan/network'); ?>" title="Scan Results">
    <i class="fa-solid fa-shield-virus"></i>
    </a>
    <a href="<?= base_url('user/history'); ?>"  title="History">
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
    <a  class="settings active" title="Settings" ><i class="fa-solid fa-gear"></i></a>
    <a href="<?= base_url('auth/logout'); ?>" title="Logout">
    <i class="fa-solid fa-sign-out"></i>
    </a>
  </div>
</div>
  </div>

  <div class="main-content">
    <div class="dashboard-grid">
      <!-- Information Panel -->
      <div class="panel info-panel">
        <h2 class="panel-title">Information</h2>
        
        <div class="info-section">
          <h3>Your Configuration</h3>
          <div class="info-item">
          <span> <i class="fas fa-map-pin"></i>
           Current IP:</span> <?= session('ip'); ?>
          </div>
          <div class="info-item">
          <span> <i class="fas fa-sliders-h"></i>
           Chosen Mode:</span> <?= session('mode'); ?>
          </div>
        </div>

        <div class="info-section">
          <h3>Current Network</h3>
          <?php if (session()->has('current_network')): ?>
          <div class="info-item">
          <span><i class="fas fa-wifi"></i> 
            ESSID:</span> <?= session('current_network')['essid']; ?>
          </div>
          <div class="info-item">
          <span> <i class="fas fa-tag"></i>
           BSSID:</span> <?= session('current_network')['bssid']; ?>
          </div>
          <div class="info-item">
          <span> <i class="fas fa-signal"></i>
         Signal:</span> <?= session('current_network')['signal']; ?>
          </div>
          <div class="info-item">
          <span><i class="fas fa-list"></i>
         Channel:</span> <?= session('current_network')['channel']; ?>
          </div>
          <div class="info-item">
          <span> <i class="fas fa-lock"></i>
           Encryption:</span> <?= session('current_network')['security']; ?>
          </div>
          <?php endif; ?>
        </div>

        <div class="info-section">
          <h3>Alerts</h3>
          <div id="alerts-container">
          <?php
$success = session()->getFlashdata('success');
$error = session()->getFlashdata('error');
$alert = session()->getFlashdata('alert');

if ($success): 
?>
  <div class="alert alert-success">
    <?= $success ?>
  </div>
<?php endif; 

if ($error): 
?>
  <div class="alert alert-danger">
    <?= $error ?>
  </div>
<?php endif;

if ($alert && is_array($alert) && isset($alert['type']) && isset($alert['message'])): 
  $alertClass = ($alert['type'] === 'error') ? 'alert-danger' : 'alert-' . $alert['type'];
?>
  <div class="alert <?= $alertClass ?>">
    <?= $alert['message'] ?>
  </div>
<?php endif; ?>
</div>
        </div>
      </div>

      <!-- Functionalities Panel -->
      <div class="panel func-panel">
        <h2 class="panel-title">Functionalities</h2>
        
        <div class="func-section">
          <h3>Credentials</h3>
          <form action="<?= base_url('user/setCredentials'); ?>" method="post">
            <input type="text" name="raspberry_user" placeholder="Raspberry User" required>
            <input type="password" name="raspberry_password" placeholder="Password" required>
            <button type="submit">Save Credentials</button>
          </form>
        </div>

        <div class="func-section">
          <h3>API</h3>
          <div class="button-group">
            <form action="<?= base_url('user/startApi'); ?>" method="post" class="inline-form">
              <button type="submit">Start API</button>
            </form>
            <form action="<?= base_url('user/stopApi'); ?>" method="post" class="inline-form">
              <button type="submit">Stop API</button>
            </form>
          </div>
        </div>

        <div class="func-section">
          <h3>Monitor</h3>
          <div class="button-group">
            <form action="<?= base_url('user/enableMonitor'); ?>" method="post" class="inline-form">
              <button type="submit">Enable Monitor</button>
            </form>
            <form action="<?= base_url('user/desactiveMonitor'); ?>" method="post" class="inline-form">
              <button type="submit">Disable Monitor</button>
            </form>
          </div>
        </div>

        <div class="func-section">
          <h3>IP</h3>
          <form action="<?= base_url('scan/ipset'); ?>" method="post">
            <div class="input-group">
              <input type="text" name="ip" placeholder="e.g. 192.168.2.170" required>
              <button type="submit">Set IP</button>
            </div>
          </form>
        </div>

        <div class="func-section">
  <h3>Scan Mode</h3>
  <form action="<?= site_url('scan/setScanMode') ?>" method="post">
    <div class="radio-group">
      <label class="radio-button">
        <input type="radio" name="mode" value="quick" required>
        <span class="radio-label">Quick</span>
      </label>
      <label class="radio-button">
        <input type="radio" name="mode" value="intermediate" required>
        <span class="radio-label">Intermediate</span>
      </label>
      <label class="radio-button">
        <input type="radio" name="mode" value="deep" required>
        <span class="radio-label">Deep</span>
      </label>
    </div>
    <button type="submit">Set Scan Mode</button>
  </form>
</div>

        <div class="func-section">
          <h3>Password</h3>
          <button onclick="window.location.href='<?= base_url('user/change_password'); ?>'">
            Change Password
          </button>
        </div>

        <div class="func-section">
          <h3>Verification</h3>
          <button onclick="window.location.href='<?= base_url('user/verification'); ?>'">
            Verification
          </button>
        </div>
      </div>
    </div>
  </div>
</div>