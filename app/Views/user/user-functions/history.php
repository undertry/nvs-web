<?= $this->include('common/history/start.php'); ?>
<title>Detalles del Scan</title>
</head>

<body>
    <div class="container">
        <h1 class="header"><a href="<?= base_url('dashboard'); ?>">NVS</a></h1>
        <h1>Scan Details</h1>
        <div class="columns">
            <?php if (!empty($scanDetails) && is_array($scanDetails)) : ?>
            <?php
        // Agrupar los detalles del scan por cada scan
        $scansGrouped = [];
        foreach ($scanDetails as $detail) {
          $scansGrouped[$detail['scan_date']][] = $detail;
        }
        ?>
            <?php foreach ($scansGrouped as $scan_date => $details) : ?>
            <div class="scan-group">
                <div class="scan-summary" onclick="toggleDetails(this)">
                    <h2>Scan Information</h2>
                    <ul>
                        <li><strong>Scan Date:</strong> <?= $scan_date ?></li>
                        <li><strong>user:</strong> <?= $details[0]['user_name'] ?></li>
                    </ul>
                </div>
                <div class="scan-details">
                    <div class="left-column">
                        <h2>Network Information</h2>
                        <ul>
                            <li><strong>Signal:</strong> <?= $details[0]['signal'] ?></li>
                            <li><strong>ESSID:</strong> <?= $details[0]['essid'] ?></li>
                            <li><strong>BSSID:</strong> <?= $details[0]['bssid'] ?></li>
                            <li><strong>Channel:</strong> <?= $details[0]['channel'] ?></li>
                            <li><strong>Security Type:</strong> <?= $details[0]['security_type'] ?></li>
                        </ul>
                    </div>
                    <div class="right-column">
                        <h2>Device Information</h2>
                        <?php foreach ($details as $detail) : ?>
                        <h3>Device</h3>
                        <ul>
                            <li><strong>IP:</strong> <?= $detail['ip_address'] ?></li>
                            <li><strong>Operating System:</strong> <?= $detail['operating_system'] ?></li>
                            <li><strong>MAC:</strong> <?= $detail['mac_address'] ?></li>
                        </ul>
                        <h3>Port Information</h3>
                        <ul>
                            <li><strong>Port:</strong> <?= $detail['port_name'] ?></li>
                            <li><strong>service:</strong> <?= $detail['service'] ?></li>
                            <li><strong>Protocol:</strong> <?= $detail['protocol'] ?></li>
                            <li><strong>Status:</strong>
                                <?php
                      if ($detail['open']) echo 'open';
                      elseif ($detail['close']) echo 'close';
                      else echo 'filtered';
                      ?>
                            </li>
                        </ul>
                        <h3>Public Code</h3>
                        <ul>
                            <li><?= $detail['vulnerability_code'] ?></li>
                        </ul>
                        <h3 id="description">Vulnerability Description</h3>
                        <ul>
                            <li><?= $detail['vuln_description'] ?></li>
                        </ul>
                        <h3 id="solution">Solution</h3>
                        <ul>
                            <li><?= $detail['solution'] ?></li>
                        </ul>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <p>No details found for this scan</p>
            <?php endif; ?>
        </div>
    </div>
    <?= $this->include('common/history/end.php'); ?>