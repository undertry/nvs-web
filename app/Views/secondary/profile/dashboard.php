<?= $this->include('modules/dashboard/start.php'); ?>
<title>Dashboard</title>
</head>

<div class="dashboard-container">
    <!-- Sidebar de navegación -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Dashboard</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="<?= base_url('home-animation'); ?>"><i class="icon-home"></i> Home</a></li>
                <li><a href="<?= base_url('network-animation'); ?>"><i class="icon-network"></i> Network Scan</a></li>
                <li><a href="<?= base_url('history-animation'); ?>"><i class="icon-history"></i> History</a></li>
                <li><a href="<?= base_url('configuration'); ?>"><i class="icon-settings"></i> Configuration</a></li>
                <li><a href="<?= base_url('logout'); ?>"><i class="icon-logout"></i> Log Out</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="main-header">
            <h1>Welcome, <?= session('user')->name; ?></h1>
            <p>Overview of your activities</p>
        </header>

        <section class="dashboard-sections">
            <div class="dashboard-card">
                <h3>Network Scan</h3>
                <p>Scan nearby networks and view details.</p>
            </div>
            <div class="dashboard-card">
                <h3>History</h3>
                <p>View your past scans and reports.</p>
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