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
                                            <li><strong>Protocol:</strong> <?= $portDetails[0]['protocol'] ?></li>
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

    <!-- Script para generar el PDF específico de cada escaneo -->
    <script>
document.querySelectorAll('.downloadPDF').forEach(button => {
    button.addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({ format: 'a4' });

        const scanDate = this.getAttribute('data-scan-date');
        const userName = this.getAttribute('data-user-name');
        const signal = this.getAttribute('data-signal');
        const essid = this.getAttribute('data-essid');
        const bssid = this.getAttribute('data-bssid');
        const channel = this.getAttribute('data-channel');
        const securityType = this.getAttribute('data-security-type');
        const deviceInfo = JSON.parse(this.getAttribute('data-devices'));

        const PAGE_HEIGHT = doc.internal.pageSize.height;
        const BOTTOM_MARGIN = 30;
        let y = 10;

        const addNewPageIfNeeded = () => {
            if (y > PAGE_HEIGHT - BOTTOM_MARGIN) {
                doc.addPage();
                y = 10;
            }
        };

        // Helper to draw bordered box for sections
        const drawBox = (doc, x, y, width, height, title = "", titleOffsetX = 0) => {
            doc.setLineWidth(0.5);
            doc.rect(x, y, width, height);
            if (title) {
                doc.setFontSize(16);
                doc.setFont("helvetica", "bold");
                doc.text(title, x + width / 2 + titleOffsetX, y + 8, { align: "center" });
            }
        };

        // Function to handle text with formatting options
        const formatText = (doc, text, x, y, size = 12, bold = false, underline = false) => {
            doc.setFontSize(size);
            doc.setFont("helvetica", bold ? "bold" : "normal");
            if (underline) {
                doc.textWithLink(text, x, y, { underline });
            } else {
                doc.text(text, x, y);
            }
            return y + 8;
        };

        // Load image from URL and add to PDF
        const imgUrl = 'https://cdn-icons-png.flaticon.com/512/8464/8464533.png';
        const image = new Image();
        image.src = imgUrl;

        image.onload = function() {
            // Title
            doc.addImage(image, 'PNG', 10, y, 20, 20);
            doc.setFontSize(20);
            doc.setFont("helvetica", "bold");
            doc.text("Network Scan Report", 105, y + 10, { align: "center" });
            y += 30;

            // Scan Date and User on the same line
            doc.setFontSize(18);
            doc.setFont("helvetica", "bold");
            doc.text(`Scan Date: ${scanDate}               User: ${userName}`, 10, y);
            y += 10;

            addNewPageIfNeeded();

            // Network Information with border
            drawBox(doc, 10, y, 190, 60, "Network Information");  // Extendido a 60
            y += 10;
            y = formatText(doc, `Signal: ${signal}`, 15, y + 10, 12, true, true);
            y = formatText(doc, `ESSID: ${essid}`, 15, y, 12, true, true);
            y = formatText(doc, `BSSID: ${bssid}`, 15, y, 12, true, true);
            y = formatText(doc, `Channel: ${channel}`, 15, y, 12, true, true);
            y = formatText(doc, `Security Type: ${securityType}`, 15, y, 12, true, true);
            y += 10;

            addNewPageIfNeeded();

            // Device and Port Information
            const groupedDevices = deviceInfo.reduce((acc, device) => {
                if (!acc[device.ip_address]) {
                    acc[device.ip_address] = {
                        generalInfo: {
                            ip_address: device.ip_address,
                            operating_system: device.operating_system,
                            mac_address: device.mac_address
                        },
                        ports: {}
                    };
                }
                if (!acc[device.ip_address].ports[device.port_name]) {
                    acc[device.ip_address].ports[device.port_name] = [];
                }
                acc[device.ip_address].ports[device.port_name].push({
                    service: device.service,
                    protocol: device.protocol,
                    status: device.status,
                    vulnerability_code: device.vulnerability_code,
                    vuln_description: device.vuln_description,
                });
                return acc;
            }, {});

            Object.keys(groupedDevices).forEach(ip => {
                const device = groupedDevices[ip];

                addNewPageIfNeeded();

                // Device General Info
                drawBox(doc, 10, y, 190, 40, "Device General Info");  // Extendido a 40
                y += 10;
                y = formatText(doc, `IP: ${device.generalInfo.ip_address}`, 15, y + 10, 12, true, true);
                y = formatText(doc, `Operating System: ${device.generalInfo.operating_system}`, 15, y, 12, true, true);
                y = formatText(doc, `MAC Address: ${device.generalInfo.mac_address}`, 15, y, 12, true, true);
                y += 10;

                addNewPageIfNeeded();

                // Port Details
                Object.keys(device.ports).forEach(portName => {
                    const portDetails = device.ports[portName];
                    drawBox(doc, 10, y, 190, 40, "Port Details");

                    y = formatText(doc, `Port: ${portName}`, 15, y + 10, 12, true, true);
                    y = formatText(doc, `Service: ${portDetails[0].service}`, 15, y, 12, true, true);
                    y = formatText(doc, `Protocol: ${portDetails[0].protocol}`, 15, y, 12, true, true);
                    y = formatText(doc, `Status: ${portDetails[0].status}`, 15, y, 12, true, true);
                    
                    y += 10;

                    addNewPageIfNeeded();

                    // Vulnerability Details with slight title offset
                    portDetails.forEach((vuln) => {
                        drawBox(doc, 15, y, 180, 20, "Vulnerability Details", 5);  // Mueve el título ligeramente a la derecha
                        y = formatText(doc, `Public Code: ${vuln.vulnerability_code}`, 20, y + 10, 12, true, false);
                        y = formatText(doc, `Description: ${vuln.vuln_description}`, 20, y, 12, true, false);


                        addNewPageIfNeeded();
                    });
                });
            });

            doc.save(`scan_details_${scanDate}.pdf`);
        };
    });
});


    </script>

<?= $this->include('modules/history/end.php'); ?>
