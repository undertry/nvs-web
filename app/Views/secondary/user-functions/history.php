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
            const doc = new jsPDF({
                format: 'a4'
            });

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

            // Función para dividir texto en líneas adecuadas
            const splitTextAndFormat = (doc, text, x, y, width = 180) => {
                const lines = doc.splitTextToSize(text, width);
                doc.text(lines, x, y);
                return y + lines.length * 10;
            };

            // Estilo general
            doc.setFontSize(12);
            doc.setTextColor(0);

            // Crear función para generar PDF con o sin imagen
            const generatePDF = () => {
                // Encabezado
                doc.setFontSize(18);
                doc.setFont('helvetica', 'bold'); // Establecer fuente en negrita para el encabezado
                doc.text("Network Scan Report", 105, 20, null, null, "center");
                doc.setFontSize(12);
                doc.text(`Scan Date: ${scanDate}`, 10, 30);
                doc.text(`User: ${userName}`, 150, 30);

                // Función para dibujar borde y agregar título en negrita y centrado
                const drawBox = (x, y, width, height, title = "") => {
                    doc.rect(x, y, width, height); // Dibuja el borde
                    if (title) {
                        doc.setFontSize(14);
                        doc.setFont('helvetica', 'bold');
                        const titleWidth = doc.getStringUnitWidth(title) * 14 / doc.internal.scaleFactor;
                        doc.text(title, (x + (width - titleWidth) / 2), y + 8);  // Centra el título
                        doc.setFontSize(12); // Restaurar tamaño después del título
                        doc.setFont('helvetica', 'normal');
                    }
                };

                // Caja de Información de Red
                drawBox(10, 40, 190, 45, "Network Information");
                doc.text(`Signal: ${signal}`, 15, 56);
                doc.text(`ESSID: ${essid}`, 15, 66);
                doc.text(`BSSID: ${bssid}`, 15, 76);
                doc.text(`Channel: ${channel}`, 100, 56);
                doc.text(`Security Type: ${securityType}`, 100, 66);

                // Caja de Información del Dispositivo
                drawBox(10, 100, 190, 35, "Device Information");
                doc.text(`IP: ${ip}`, 15, 116);
                doc.text(`Operating System: ${os}`, 15, 126);
                doc.text(`MAC: ${mac}`, 100, 116);

                // Caja de Información del Puerto
                drawBox(10, 150, 190, 35, "Port Information");
                doc.text(`Port: ${port}`, 15, 166);
                doc.text(`Service: ${service}`, 15, 176);
                doc.text(`Protocol: ${protocol}`, 100, 166);
                doc.text(`Status: ${status}`, 100, 176);

                // Caja de Vulnerabilidad
                drawBox(10, 200, 190, 18, "Public Code");
                doc.text(vulnCode, 15, 216);

                // Caja de Descripción de Vulnerabilidad
                drawBox(10, 230, 190, 25, "Vulnerability Description");
                let y = splitTextAndFormat(doc, vulnDesc, 15, 248, 180);

                // Caja de Solución
                drawBox(10, y + 5, 190, 30, "Solution");
                splitTextAndFormat(doc, solution, 15, y + 25, 180);

                // Descargar PDF
                doc.save(`scan_details_${scanDate}.pdf`);
            };

            // Cargar imagen desde URL
            const imgUrl = '../public/complements/styles/images/huella.png';  // Ruta de la imagen
            const image = new Image();
            image.src = imgUrl;

            // Manejar el evento de carga de la imagen
            image.onload = function() {
                // Insertar imagen en la esquina superior izquierda (ajusta posición y tamaño según lo necesites)
                doc.addImage(image, 'PNG', 4, 4, 20, 20);  // (x, y, width, height)
                generatePDF();  // Generar PDF una vez que la imagen se haya cargado
            };

            // Manejar error de carga de la imagen
            image.onerror = function() {
                console.error("La imagen no se pudo cargar. Se generará el PDF sin la imagen.");
                generatePDF();  // Generar PDF sin la imagen si hay un error
            };
        });
    });
</script>





    <?= $this->include('modules/history/end.php'); ?>
