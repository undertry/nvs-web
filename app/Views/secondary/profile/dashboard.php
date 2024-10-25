<?= $this->include('modules/dashboard/start.php'); ?>
<title>Dashboard</title>
</head>

<div class="dashboard-container">
    <!-- Sidebar de navegación -->
    <aside class="sidebar">
        <nav class="sidebar-nav">
            <ul>
                <li class="logo"><i class="fa-solid fa-fingerprint"></i></li>
                <li><a href="<?= base_url('home-animation'); ?>"><i class="fa-solid fa-house"></i><span>Inicio</span></a></li>
                <li><a href="<?= base_url('network-animation'); ?>"><i class="fa-solid fa-wifi"></i><span>Redes</span></a></li>
                <li><a href="<?= base_url('nmap-animation'); ?>"><i class="fa-solid fa-shield-virus"></i><span>Seguridad</span></a></li>
                <li><a href="<?= base_url('history-animation'); ?>"><i class="fa-solid fa-clock-rotate-left"></i><span>Historial</span></a></li>
                <li><a href="<?= base_url('configuration'); ?>"><i class="fa-solid fa-gear"></i><span>Configuración</span></a></li>
                <li><a><i class="fa-solid fa-moon" id="mode-icon"></i><span>Modo Oscuro</span></a></li>
                <li><a href="<?= base_url('logout'); ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar sesión</span></a></li>
            </ul>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="main-header">
            <div class="user-info">
                <h1>Welcome, <?= session('user')->name; ?></h1>
            </div>
            <hr class="divider" />
            <div class="dashboard-info">
                <h3>Your Information</h3>
                <p>Email: <?= session('user')->email; ?></p>
                <p>Created At: <?= session('user')->created_at; ?></p>
                <p>2FA: <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?></p>
            </div>
            <p class="overview">Overview of your activities</p>
        </header>

        <!-- Sección de Formularios y Gráficos -->
        <section class="dashboard-sections">
            <!-- IP Input Form -->
            <div class="dashboard-small">
                <form method="post" action="<?= base_url('ipset'); ?>" class="form">
                    <h3 class="intro">Enter Interface IP</h3>
                    <div class="form-inputs">
                        <input name="ip" type="text" id="ip" placeholder="e.g. 192.168.2.170" required>
                        <input type="submit" value="Enter" class="btn-submit">
                    </div>
                </form>
            </div>
            <!-- Last Network Section -->
            <div class="dashboard-small">
                <h3>Last Network</h3>
                <?php if (!empty($last_network)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Network Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= esc($last_network[0]['essid']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No selected network found.</p>
                <?php endif; ?>
            </div>
            <!-- History Section -->
            <div class="dashboard-small">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> History</h3>
                <p>View your past scans and reports.</p>
                <table>
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Resultados del historial de escaneos -->
                    </tbody>
                </table>
            </div>
            <!-- Configuration Section -->
            <div class="dashboard-small">
                <h3>Configuration</h3>
                <p>Modify user settings and preferences.</p>
            </div>
            <!-- Network Scan Section -->
            <div class="dashboard-card large-card">
                <h3>Network Scan</h3>
                <p>Scan nearby networks and view detailed reports.</p>
                <div class="scan-results">
                    <canvas id="networkChart"></canvas>
                </div>
            </div>



            <!-- Vulnerabilities Pie Chart Section -->
            <div class="dashboard-card large-card">
                <h3>Common Vulnerabilities</h3>
                <canvas id="vulnerabilitiesPieChart"></canvas>
            </div>





        </section>
    </main>
</div>


<!-- Scripts para agregar gráficos e interactividad -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de barras para el escaneo de redes
    const ctx = document.getElementById('networkChart').getContext('2d');
    const networkChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Network 1', 'Network 2', 'Network 3'],
            datasets: [{
                label: 'Signal Strength',
                data: [30, 50, 80],
                backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                borderColor: ['rgba(75, 192, 192, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Gráfico de torta para vulnerabilidades más comunes
    const pieCtx = document.getElementById('vulnerabilitiesPieChart').getContext('2d');
    const vulnerabilitiesPieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['SQL Injection', 'XSS', 'CSRF', 'Buffer Overflow', 'Privilege Escalation'],
            datasets: [{
                data: [25, 20, 15, 25, 15], // Datos de ejemplo, ajusta con tus valores reales
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</div>

</body>

</html>