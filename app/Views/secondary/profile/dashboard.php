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
            <p>Overview of your activities</p>
            <li><a href="<?= base_url('ip'); ?>">ip<i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>

        </header>

        <section class="dashboard-sections">
            <div class="dashboard-card">
                <h3>Network Scan</h3>
                <p>Scan nearby networks and view details.</p>
            </div>
            <div class="dashboard-card">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> History</h3>
                <p>View your past scans and reports.</p>
            </div>
            <div class="dashboard-card">
                <h3>Red seleccionada anteriormente</h3>
                <p>Modify user settings and preferences.</p>
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