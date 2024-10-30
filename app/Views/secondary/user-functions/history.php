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
                $scansGrouped[$detail['id_scan']][] = $detail;
            }
        ?>
        <?php foreach ($scansGrouped as $details) : ?>
        <div class="scan-group">
            <div class="scan-summary" onclick="toggleDetails(this)">
                <h2>Scan Information</h2>
                <ul>
                    <li><strong>Scan Date:</strong> <?=  $details[0]['scan_date'] ?></li>
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

                    <?php 
                    // Agrupar por dispositivos para mostrar los puertos consecutivos
                    $devicesGrouped = [];
                    foreach ($details as $detail) {
                        $devicesGrouped[$detail['ip_address']][] = $detail;
                    }

                    foreach ($devicesGrouped as $deviceDetails) : ?>
                        <h3>Device</h3>
                        <ul>
                            <li><strong>IP:</strong> <?= $deviceDetails[0]['ip_address'] ?></li>
                            <li><strong>Operating System:</strong> <?= $deviceDetails[0]['operating_system'] ?></li>
                            <li><strong>MAC:</strong> <?= $deviceDetails[0]['mac_address'] ?></li>
                        </ul>

                        <?php foreach ($deviceDetails as $device) : ?>
                            <h3>Port Information</h3>
                            <ul>
                                <li><strong>Port:</strong> <?= $device['port_name'] ?></li>
                                <li><strong>Service:</strong> <?= $device['service'] ?></li>
                                <li><strong>Protocol:</strong> <?= $device['protocol'] ?></li>
                                <li><strong>Status:</strong> <?= $device['status'] ?></li>
                            </ul>

                            <h3>Public Code</h3>
                            <ul>
                                <li><?= $device['vulnerability_code'] ?></li>
                            </ul>

                            <h3>Vulnerability Description</h3>
                            <ul>
                                <li><?= $device['vuln_description'] ?></li>
                            </ul>

                            
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Botón para descargar el PDF específico de este escaneo -->
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

            <!-- Botón para eliminar el escaneo -->
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

        // Función para dividir texto en líneas adecuadas
        const splitTextAndFormat = (doc, text, x, y, width = 180) => {
            const lines = doc.splitTextToSize(text, width);
            lines.forEach(line => {
                doc.text(line, x, y);
                y += 10; // Ajustar espacio entre líneas
            });
            return y;   
        };

        const drawBox = (doc, x, y, width, height, title = "") => {
            doc.rect(x, y, width, height); // Dibuja el borde
            if (title) {
                doc.setFontSize(14);
                doc.setFont('helvetica', 'bold');
                const titleWidth = doc.getStringUnitWidth(title) * 14 / doc.internal.scaleFactor;
                doc.text(title, (x + (width - titleWidth) / 2), y + 8);
                doc.setFontSize(12);
                doc.setFont('helvetica', 'normal');
            }
        };

        // Agrupar dispositivos por IP
        const groupedDevices = deviceInfo.reduce((acc, device) => {
            if (!acc[device.ip_address]) {
                acc[device.ip_address] = {
                    generalInfo: {
                        ip_address: device.ip_address,
                        operating_system: device.operating_system,
                        mac_address: device.mac_address
                    },
                    details: []
                };
            }
            acc[device.ip_address].details.push({
                port_name: device.port_name,
                service: device.service,
                protocol: device.protocol,
                status: device.status,
                vulnerability_code: device.vulnerability_code,
                vuln_description: device.vuln_description,
            });
            return acc;
        }, {});

        // Cargar imagen desde URL
        const imgUrl = 'https://cdn-icons-png.flaticon.com/512/8464/8464533.png';
        const image = new Image();
        image.src = imgUrl;

        // Manejar el evento de carga de la imagen
        image.onload = function() {
            doc.setFontSize(18);
            doc.setFont('helvetica', 'bold');
            doc.text("Network Scan Report", 105, 20, null, null, "center");
            doc.setFontSize(12);
            doc.text(`Scan Date: ${scanDate}`, 10, 30);
            doc.text(`User: ${userName}`, 150, 30);

            // Insertar imagen en la esquina superior izquierda
            doc.addImage(image, 'PNG', 4, 4, 20, 20);  // (x, y, width, height)

            let y = 40;

            // Información de Red
            drawBox(doc, 10, y, 190, 60, "Network Information");
            y += 15;
            y = splitTextAndFormat(doc, `Signal: ${signal}`, 15, y);
            y = splitTextAndFormat(doc, `ESSID: ${essid}`, 15, y);
            y = splitTextAndFormat(doc, `BSSID: ${bssid}`, 15, y);
            y = splitTextAndFormat(doc, `Channel: ${channel}`, 15, y);
            y = splitTextAndFormat(doc, `Security Type: ${securityType}`, 15, y);
            y += 20; // Aumentar el espacio entre secciones

            // Información de Dispositivos
            doc.setFontSize(18);
            doc.setFont('helvetica', 'bold');
            doc.text("Device Information", 78, y);
            y += 10;

            // Recorrer los dispositivos agrupados por IP
            Object.keys(groupedDevices).forEach(ip => {
                const device = groupedDevices[ip];
                const generalInfoHeight = 45; // Establecer la altura mínima de la caja
                drawBox(doc, 10, y, 190, generalInfoHeight, "Device General Info");
                y += 15;
                y = splitTextAndFormat(doc, `IP: ${device.generalInfo.ip_address}`, 15, y);
                y = splitTextAndFormat(doc, `Operating System: ${device.generalInfo.operating_system}`, 15, y);
                y = splitTextAndFormat(doc, `MAC: ${device.generalInfo.mac_address}`, 15, y);
                y += 10;

                // Agregar detalles adicionales (puertos, servicios, etc.)
                device.details.forEach(detail => {
                    let detailHeight = 0;
                    const linesCount = doc.splitTextToSize(`vulnerability description: ${detail.vulnerability_code}`, 180).length + 6; // Ajustar el número de líneas
                    detailHeight = linesCount * 10 + 10; // Calcular altura en función de las líneas

                    drawBox(doc, 10, y, 190, detailHeight, "Port Details");
                    y += 15;
                    y = splitTextAndFormat(doc, `Port: ${detail.port_name}`, 15, y);
                    y = splitTextAndFormat(doc, `Service: ${detail.service}`, 15, y);
                    y = splitTextAndFormat(doc, `Protocol: ${detail.protocol}`, 15, y);
                    y = splitTextAndFormat(doc, `Status: ${detail.status}`, 15, y);
                    y = splitTextAndFormat(doc, `Public Code: ${detail.vulnerability_code}`, 15, y);
                    y = splitTextAndFormat(doc, `Vulnerability Description: ${detail.vuln_description}`, 15, y);
                    y += 20; // Espacio entre dispositivos

                    // Verificar si se necesita nueva página
                    if (y > 250) { // Ajusta este valor según el contenido máximo que quieras en una página
                        doc.addPage();
                        y = 10; // Reiniciar la posición vertical
                    }
                });
            });

            // Descargar PDF
            doc.save(`scan_details_${scanDate}.pdf`);
        };
    });
});
</script>










    <?= $this->include('modules/history/end.php'); ?>
