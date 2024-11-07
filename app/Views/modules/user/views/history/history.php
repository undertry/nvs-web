    <div class="container">
        <h1 class="header"><a href="<?= base_url('dashboard'); ?>">NVS</a></h1>
        <h1>Scan Details</h1>
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
                                    <li><strong>Signal:</strong> <?= $details[0]['signal'] ?></li>
                                    <li><strong>ESSID:</strong> <?= $details[0]['essid'] ?></li>
                                    <li><strong>BSSID:</strong> <?= $details[0]['bssid'] ?></li>
                                    <li><strong>Channel:</strong> <?= $details[0]['channel'] ?></li>
                                    <li><strong>Security Type:</strong> <?= $details[0]['security_type'] ?></li>
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
                                        <li><strong>IP:</strong> <?= $deviceDetails[0]['ip_address'] ?></li>
                                        <li><strong>Operating System:</strong> <?= $deviceDetails[0]['operating_system'] ?></li>
                                        <li><strong>MAC:</strong> <?= $deviceDetails[0]['mac_address'] ?></li>
                                    </ul>

                                    <?php
                                    $portsGrouped = [];
                                    foreach ($deviceDetails as $device) {
                                        $portsGrouped[$device['port_name']][] = $device;
                                    }

                                    foreach ($portsGrouped as $portName => $portDetails) : ?>
                                        <h3>Port Information</h3>

                                        <ul>
                                            <li><strong>Port:</strong> <?= $portName ?></li>
                                            <li><strong>Service:</strong> <?= $portDetails[0]['service'] ?></li>
                                            <li><strong>Status:</strong> <?= $portDetails[0]['status'] ?></li>
                                            <?php foreach ($portDetails as $port) : ?>
                                                <h3>Vulnerability details</h3>

                                                <li><strong>Public Code:</strong> <?= $port['vulnerability_code'] ?></li>
                                                <li><strong>Vulnerability Description:</strong> <?= $port['vuln_description'] ?></li>
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

                        <form action="<?= base_url('history/deleteScan/' . $detail['id_scan']) ?>" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este escaneo?');">
                            <button type="submit" class="btn btn-danger">Eliminar Scan</button>
                        </form>

                    </div>
                <?php endforeach; ?>

            <?php else : ?>
                <p>No details found for this scan</p>
            <?php endif; ?>
        </div>
    </div>
