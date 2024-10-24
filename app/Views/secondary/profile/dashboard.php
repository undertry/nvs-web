<?= $this->include('modules/dashboard/start.php'); ?>
<title>Dashboard</title>
</head>

<div class="dashboard-container">
    <!-- Sidebar de navegación -->
    <aside class="sidebar">

        <nav class="sidebar-nav">
            <ul>
                <li><a class="logo"><i class="fa-solid fa-fingerprint"></i></a></li>
                <li><a href="<?= base_url('home-animation'); ?>"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="<?= base_url('network-animation'); ?>"><i class="fa-solid fa-wifi"></i></a></li>
                <li><a href="<?= base_url('network-animation'); ?>"><i class="fa-solid fa-shield-virus"></i></a></li>
                <li><a href="<?= base_url('history-animation'); ?>"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
                <li><a href="<?= base_url('configuration'); ?>"><i class="fa-solid fa-gear"></i></a></li>
                <li><a><i class="fa-solid fa-moon" id="mode-icon"></i></a></li>
                <li><a href="<?= base_url('logout'); ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
            </ul>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="main-header">
            <h1>Welcome, <?= session('user')->name; ?></h1>
            <div class="dashboard-card">
                <h3>Your Information</h3>
                <p>Email: <?= session('user')->email; ?></p>
                <p>Created At: <?= session('user')->created_at; ?></p>
                <p>2FA: <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?></p>
            </div>

            <p>Overview of your activities</p>


        </header>

        <section class="dashboard-sections">
            <div class="dashboard-card">
                <form method="post" action="<?= base_url('ipset'); ?>" class="form">
                    <h3 class="intro">Ingrese La ip de la Interfaz</h3>
                    <div class="form-inputs">
                        <div class="form-label">
                            <input name="ip" type="text" id="ip" placeholder="example 192.168.2.170" required>
                            <input type="submit" value="Enter">

                        </div>
                    </div>
                </form>
            </div>
            <div class="dashboard-card">
                <h3>Network Scan</h3>
                <p>Scan nearby networks and view details.</p>
            </div>
            <div class="dashboard-card">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> History</h3>
                <p>View your past scans and reports.</p>
            </div>
            <div class="dashboard-card">
                <?php if (!empty($last_network)): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>The last Network</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= esc($last_network[0]['essid']) ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No se encontró ninguna red seleccionada.</p>
                <?php endif; ?>
            </div>
            <div class="dashboard-card">
                <h3>Configuration</h3>
                <p>Modify user settings and preferences.</p>
            </div>
        </section>
    </main>
</div>

</body>

</html>