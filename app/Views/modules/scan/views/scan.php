
    <h1>Nmap Scan Results</h1>
    <div class="container">
    <section>
        <h2>Puertos, IP, MAC, Servicios y Sistema Operativo</h2>
        <p><strong>IP:</strong> <?= $nmap_ports_services['ip'] ?? 'N/A' ?></p>
        <p><strong>MAC:</strong> <?= $nmap_ports_services['mac'] ?? 'N/A' ?></p>
        <p><strong>Sistema Operativo:</strong> <?= $nmap_ports_services['os_info'] ?? 'N/A' ?></p>

        <h3>Puertos y Servicios</h3>
        <?php if (!empty($nmap_ports_services['ports_services'])): ?>
            <ul>
                <?php foreach ($nmap_ports_services['ports_services'] as $service): ?>
                    <li><?= $service['port'] ?> - <?= $service['state'] ?> - <?= $service['service'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No se encontraron servicios abiertos.</p>
        <?php endif; ?>
    </section>

    <!-- Vista de Vulnerabilidades -->
    <section>
        <h2>Vulnerabilidades</h2>
        <button id="toggle-vulnerabilities">Ver Vulnerabilidades</button>
        <div id="vulnerabilities-list" style="display: none;"> <!-- Inicialmente oculto -->
        <?php if (!empty($nmap_vulnerabilities['vulnerabilities'])): ?>
    <ul>
        <?php foreach ($nmap_vulnerabilities['vulnerabilities'] as $vuln): ?>
            <li>
                <strong>CVE:</strong> <?= $vuln['cve'] ?? 'No CVE disponible' ?> 
                - <?= $vuln['description'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron vulnerabilidades.</p>
<?php endif; ?>

        </div>
    </section>
</div>

