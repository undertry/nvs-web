document.querySelectorAll('.downloadPDF').forEach(button => {
    button.addEventListener('click', function () {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF({
            format: 'a4'
        });

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
                doc.text(title, x + width / 2 + titleOffsetX, y + 8, {
                    align: "center"
                });
            }
        };

        // Function to handle text with formatting options
        const formatText = (doc, text, x, y, size = 12, bold = false, underline = false) => {
            doc.setFontSize(size);
            doc.setFont("helvetica", bold ? "bold" : "normal");
            if (underline) {
                doc.textWithLink(text, x, y, {
                    underline
                });
            } else {
                doc.text(text, x, y);
            }
            return y + 8;
        };

        // Load image from URL and add to PDF
        const imgUrl = 'https://cdn-icons-png.flaticon.com/512/8464/8464533.png';
        const image = new Image();
        image.src = imgUrl;

        image.onload = function () {
            // Title
            doc.addImage(image, 'PNG', 10, y, 20, 20);
            doc.setFontSize(20);
            doc.setFont("helvetica", "bold");
            doc.text("Network Scan Report", 105, y + 10, {
                align: "center"
            });
            y += 30;

            // Scan Date and User on the same line
            doc.setFontSize(18);
            doc.setFont("helvetica", "bold");
            doc.text(`Scan Date: ${scanDate}               User: ${userName}`, 10, y);
            y += 10;

            addNewPageIfNeeded();

            // Network Information with border
            drawBox(doc, 10, y, 190, 60, "Network Information"); // Extendido a 60
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
                drawBox(doc, 10, y, 190, 40, "Device General Info"); // Extendido a 40
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
                    y = formatText(doc, `Status: ${portDetails[0].status}`, 15, y, 12, true, true);

                    y += 10;

                    addNewPageIfNeeded();

                    // Vulnerability Details with slight title offset
                    portDetails.forEach((vuln) => {
                        drawBox(doc, 15, y, 180, 20, "Vulnerability Details", 5); // Mueve el título ligeramente a la derecha
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