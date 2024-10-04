<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerabilidades Escaneadas</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f2f2;
        color: #151414;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #151414;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #d60b0b;
        color: #fff;
    }

    .cve-btn {
        background-color: #d60b0b;
        color: white;
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }
    </style>
</head>

<body>

    <h1>Resultado de Vulnerabilidades</h1>

    <?php if (!empty($vulnerabilities)): ?>
    <table>
        <thead>
            <tr>
                <th>IP</th>
                <th>MAC</th>
                <th>Puertos</th>
                <th>Servicios</th>
                <th>Sistema Operativo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vulnerabilities as $device): ?>
            <tr>
                <td><?= esc($device['ip']) ?></td>
                <td><?= esc($device['mac']) ?></td>
                <td>
                    <?php foreach ($device['ports_services'] as $port): ?>
                    <?= esc($port['port']) ?><br>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php foreach ($device['ports_services'] as $port): ?>
                    <?= esc($port['service']) ?><br>
                    <?php endforeach; ?>
                </td>
                <td><?= esc($device['os_info']) ?></td>
                <td>
                    <button class="cve-btn" onclick="fetchVulnerabilities('<?= esc($device['ip']) ?>')">Ver CVE</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p>No se encontraron vulnerabilidades.</p>
    <?php endif; ?>

    <div id="vulnerabilities-details"></div>

    <script>
    // Define la función fetchVulnerabilities
    function fetchVulnerabilities(ip) {
        fetch(`/vulnerabilities/details/${ip}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Manejo básico de errores
                } else {
                    // Muestra los CVE o haz algo con la respuesta
                    displayCVE(data);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function displayVulnerabilities(data) {
        const vulnerabilities = data.vulnerabilities;
        const vulnsList = document.getElementById("vulnerabilities");

        if (vulnerabilities.length > 0) {
            vulnerabilities.forEach(vuln => {
                const listItem = document.createElement("li");
                listItem.innerHTML =
                    `CVE: <a href="${vuln.description}" target="_blank">${vuln.cve}</a> - Descripción: ${vuln.description}`;
                vulnsList.appendChild(listItem);
            });
        } else {
            const noVulnMessage = document.createElement("p");
            noVulnMessage.innerText = "No se encontraron vulnerabilidades.";
            vulnsList.appendChild(noVulnMessage);
        }
    }
    </script>
</body>

</html>