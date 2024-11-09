<div class="sidebar" id="sidebar">
  <a href="<?= base_url('home/animation'); ?>" class="sidebar-icon" title="Home"><i class="fa-solid fa-fingerprint"></i></a>
  <nav>
    <a href="<?= base_url('user/dashboard'); ?>" title="Dashboard">
    <i class="fa-solid fa-inbox"></i>
    </a>
    <a href="<?= base_url('scan/nmap-results'); ?>" title="Scan Results">
    <i class="fa-solid fa-shield-virus"></i>
    </a>
    <a href="<?= base_url('user/history'); ?>" class="active" title="History">
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
      <form id="nmapForm" method="post" action="<?= base_url('scan/startNmapScan'); ?>"></form>
      <a href="javascript:void(0);" onclick="submitNmapForm()" title="Nmap">
      <i class="fa-solid fa-network-wired"></i>
      </a>
    </div>
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
        <div class="columns">
            <?php if (!empty($scanDetails) && is_array($scanDetails)) : ?>
                <?php
                $scansGrouped = [];
                foreach ($scanDetails as $detail) {
                    $scansGrouped[$detail['id_scan']][] = $detail;
                }
                ?>
                <?php foreach ($scansGrouped as $details) : ?>
                    <div class="scan-group">
                        <div class="scan-summary" onclick="toggleDetails(this)">
                            <h2>Scan Information</h2>
                            <ul>
                                <li><strong>Scan Date:</strong> <?= $details[0]['scan_date'] ?></li>
                                <li><strong>User:</strong> <?= $details[0]['user_name'] ?></li>
                            </ul>
                        </div>
                        <div class="scan-details">
                            <div class="left-column">
                                <h2>Network Information</h2>
                                <ul>
                                    <li><strong><i class="fa-solid fa-wifi"></i> ESSID:</strong> <?= $details[0]['essid'] ?></li>
                                    <li><strong> <i class="fa-solid fa-tag"></i> BSSID:</strong> <?= $details[0]['bssid'] ?></li>
                                    <li><strong><i class="fa-solid fa-signal"></i> Signal:</strong> <?= $details[0]['signal'] ?></li>
                                    <li><strong><i class="fa-solid fa-list"></i> Channel:</strong> <?= $details[0]['channel'] ?></li>
                                    <li><strong><i class="fa-solid fa-lock"></i> Security Type:</strong> <?= $details[0]['security_type'] ?></li>
                                </ul>
                            </div>
                            <div class="right-column">
                                <?php
                                $devicesGrouped = [];
                                foreach ($details as $detail) {
                                    $devicesGrouped[$detail['ip_address']][] = $detail;
                                }

                                foreach ($devicesGrouped as $deviceDetails) : ?>
                                    <h2>Device Information</h2>
                                    <ul>
                                        <li><strong><i class="fa-solid fa-map-pin"></i> IP:</strong> <?= $deviceDetails[0]['ip_address'] ?></li>
                                        <li><strong><i class="fas fa-laptop"></i>  Operating System:</strong> <?= $deviceDetails[0]['operating_system'] ?></li>
                                        <li><strong><i class="fa-solid fa-tag"></i> MAC:</strong> <?= $deviceDetails[0]['mac_address'] ?></li>
                                    </ul>

                                    <?php
                                    $portsGrouped = [];
                                    foreach ($deviceDetails as $device) {
                                        $portsGrouped[$device['port_name']][] = $device;
                                    }

                                    foreach ($portsGrouped as $portName => $portDetails) : ?>
                                        <h3>Port Information</h3>

                                        <ul>
                                            <li><strong><i class="fas fa-plug"></i> Port:</strong> <?= $portName ?></li>
                                            <li><strong><i class="fas fa-cogs"></i>  Service:</strong> <?= $portDetails[0]['service'] ?></li>
                                            <li><strong><i class="fas fa-circle-check"></i> Status:</strong> <?= $portDetails[0]['status'] ?></li>
                                            <?php foreach ($portDetails as $port) : ?>
                                                <h3>Vulnerability details</h3>

                                                <li><strong><i class="fas fa-code"></i> Public Code:</strong> <?= $port['vulnerability_code'] ?></li>
                                                <li><strong><i class="fas fa-exclamation-triangle"></i> Vulnerability Description:</strong> <?= $port['vuln_description'] ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button class="downloadPDF btn btn-primary"
                            data-scan-date="<?= $details[0]['scan_date'] ?>"
                            data-user-name="<?= $details[0]['user_name'] ?>"
                            data-signal="<?= $details[0]['signal'] ?>"
                            data-essid="<?= $details[0]['essid'] ?>"
                            data-bssid="<?= $details[0]['bssid'] ?>"
                            data-channel="<?= $details[0]['channel'] ?>"
                            data-security-type="<?= $details[0]['security_type'] ?>"
                            data-devices='<?= json_encode($details) ?>'>
                            Download Scan PDF
                        </button>

                        <form action="<?= base_url('user/history/deleteScan/' . $detail['id_scan']) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este escaneo?');">
                            <button type="submit" class="btn btn-danger">Eliminar Scan</button>
                        </form>

                    </div>
                <?php endforeach; ?>

            <?php else : ?>
                <p>No details found for this scan</p>
            <?php endif; ?>
        </div>
    </div>
