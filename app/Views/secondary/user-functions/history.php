<?= $this->include('modules/history/start.php'); ?>
<title>Detalles del Scan</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
                            <li><strong>Service:</strong> <?= $detail['service'] ?></li>
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
                
                <!-- Botón para descargar el PDF específico de este escaneo -->
                <button class="downloadPDF btn btn-primary" data-scan-date="<?= $scan_date ?>" data-user-name="<?= $details[0]['user_name'] ?>" data-signal="<?= $details[0]['signal'] ?>" data-essid="<?= $details[0]['essid'] ?>" data-bssid="<?= $details[0]['bssid'] ?>" data-channel="<?= $details[0]['channel'] ?>" data-security-type="<?= $details[0]['security_type'] ?>" data-ip="<?= $details[0]['ip_address'] ?>" data-os="<?= $details[0]['operating_system'] ?>" data-mac="<?= $details[0]['mac_address'] ?>" data-port="<?= $details[0]['port_name'] ?>" data-service="<?= $details[0]['service'] ?>" data-protocol="<?= $details[0]['protocol'] ?>" data-status="<?= $detail['open'] ? 'open' : ($detail['close'] ? 'close' : 'filtered') ?>" data-vuln-code="<?= $detail['vulnerability_code'] ?>" data-vuln-desc="<?= $detail['vuln_description'] ?>" data-solution="<?= $detail['solution'] ?>">Download Scan PDF</button>
                
            </div>
            <?php endforeach; ?>
            
            <?php else : ?>
            <p>No details found for this scan</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Script para generar el PDF específico de cada escaneo -->
    <script>
        document.querySelectorAll('.downloadPDF').forEach(button => {
            button.addEventListener('click', function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Obtener datos específicos del botón seleccionado
                const scanDate = this.getAttribute('data-scan-date');
                const userName = this.getAttribute('data-user-name');
                const signal = this.getAttribute('data-signal');
                const essid = this.getAttribute('data-essid');
                const bssid = this.getAttribute('data-bssid');
                const channel = this.getAttribute('data-channel');
                const securityType = this.getAttribute('data-security-type');
                const ip = this.getAttribute('data-ip');
                const os = this.getAttribute('data-os');
                const mac = this.getAttribute('data-mac');
                const port = this.getAttribute('data-port');
                const service = this.getAttribute('data-service');
                const protocol = this.getAttribute('data-protocol');
                const status = this.getAttribute('data-status');
                const vulnCode = this.getAttribute('data-vuln-code');
                const vulnDesc = this.getAttribute('data-vuln-desc');
                const solution = this.getAttribute('data-solution');

                // Título
                doc.setFontSize(18);
                doc.text("Scan Details", 10, 10);

                // Información del escaneo
                doc.setFontSize(14);
                doc.text("Scan Information", 10, 20);
                doc.setFontSize(12);
                doc.text(`Scan Date: ${scanDate}`, 10, 30);
                doc.text(`User: ${userName}`, 10, 40);

                // Información de red
                doc.setFontSize(14);
                doc.text("Network Information", 10, 50);
                doc.setFontSize(12);
                doc.text(`Signal: ${signal}`, 10, 60);
                doc.text(`ESSID: ${essid}`, 10, 70);
                doc.text(`BSSID: ${bssid}`, 10, 80);
                doc.text(`Channel: ${channel}`, 10, 90);
                doc.text(`Security Type: ${securityType}`, 10, 100);

                // Información del dispositivo
                doc.setFontSize(14);
                doc.text("Device Information", 10, 110);
                doc.setFontSize(12);
                doc.text(`IP: ${ip}`, 10, 120);
                doc.text(`Operating System: ${os}`, 10, 130);
                doc.text(`MAC: ${mac}`, 10, 140);

                // Información del puerto
                doc.setFontSize(14);
                doc.text("Port Information", 10, 150);
                doc.setFontSize(12);
                doc.text(`Port: ${port}`, 10, 160);
                doc.text(`Service: ${service}`, 10, 170);
                doc.text(`Protocol: ${protocol}`, 10, 180);
                doc.text(`Status: ${status}`, 10, 190);

                // Información de vulnerabilidad
                doc.setFontSize(14);
                doc.text("Public Code", 10, 200);
                doc.setFontSize(12);
                doc.text(vulnCode, 10, 210);

                doc.setFontSize(14);
                doc.text("Vulnerability Description", 10, 220);
                doc.setFontSize(12);
                doc.text(vulnDesc, 10, 230);

                // Solución
                doc.setFontSize(14);
                doc.text("Solution", 10, 240);
                doc.setFontSize(12);
                doc.text(solution, 10, 250);

                // Descargar el PDF
                doc.save(`scan_details_${scanDate}.pdf`);
            });
        });
    </script>
    <?= $this->include('modules/history/end.php'); ?>
