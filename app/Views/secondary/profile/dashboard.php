<?= $this->include('modules/dashboard/start.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Dashboard</title>
</head>

<div class="sidebar" id="sidebar">
    <h2 class="sidebar-title">CyberDashboard</h2>
    <nav>
        <a href="#dashboard" class="active"><span class="icon"><i class="fa-solid fa-inbox"></i></span> <span class="text">Dashboard</span></a>
        <a href="#analytics"><span class="icon">📊</span> <span class="text">Analytics</span></a>
        <a href="<?= base_url('configuration') ?>"><span class="icon">⚙️</span> <span class="text">Settings</span></a>
        <a href="#help"><span class="icon">❓</span> <span class="text">Help Center</span></a>
    </nav>
</div>

<div class="main-content">
    <header>
        <div class="user-profile">
            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn0.iconfinder.com%2Fdata%2Ficons%2Fcyber-crime-or-threats%2F120%2Fhacker_cyber_crime-1024.png&f=1&nofb=1" alt="Profile Picture">
            <span><?= session('user')->name; ?></span>
        </div>
    </header>

    <div class="content-wrapper">
        <!-- Sección de Redes WiFi -->
        <div class="wifi-section">
            <h2><i class="fa-solid fa-wifi"></i> Available WiFi Networks</h2>
            <button id="fetch-networks" class="btn btn-primary">Start Scan</button>
            <div id="loading-spinner" style="display: none; text-align: center;">
                <div class="spinner-border text-primary" role="status"></div>
                <p><i class="fa-solid fa-spinner"></i></p>
            </div>
            <ul id="wifi-list" class="list-group mt-3"></ul>
        </div>

        <!-- Sección de Detalles de la Red -->
        <div class="details-section">
        <?php if (session('scan_message')): ?>
    <div class="alert alert-info">
        <?= session('scan_message'); ?>
    </div>
<?php endif; ?>

        <form method="post" action="<?= base_url('startDeviceScan'); ?>" style="display: inline;">
    <input type="submit" value="Start scan" class="btn-submit">
</form>

            <h2><i class="fa-solid fa-database"></i> Network Data</h2>
            <p><strong>Current IP:</strong><?= session('ip'); ?></p>
            <p><strong>Last Network Selected:</strong> <?= session('network'); ?></p>
            <p><strong>Chosen Mode:</strong><?= session('mode'); ?></p>
               
   <h2><i class="fa-solid fa-server"></i>  Last Network</h2>
            <?php if (session()->has('last_scan_data')): ?>

   <p><strong>IP:</strong> <?= session('last_scan_data')['ip']; ?></p>
   <p><strong>MAC:</strong> <?= session('last_scan_data')['mac']; ?></p>
   <p><strong>Sistema Operativo:</strong> <?= session('last_scan_data')['os_info']; ?></p>

   <?php else: ?>
    <p>No previous scan results were found.</p>

<?php endif; ?>

        </div>
   

    </div>
</div>


<script>
    document.getElementById('fetch-networks').addEventListener('click', function() {
        const wifiList = document.getElementById('wifi-list');
        const loadingSpinner = document.getElementById('loading-spinner');

        // Mostrar el spinner y limpiar la lista de redes
        loadingSpinner.style.display = 'block';
        wifiList.innerHTML = '';

        fetch('fetchNetworks')
            .then(response => response.json())
            .then(data => {
                loadingSpinner.style.display = 'none'; // Ocultar el spinner

                if (!data.success) {
                    alert(data.message);
                    return;
                }

                // Mostrar redes en la lista si la respuesta es exitosa
                data.data.forEach(network => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = network.ESSID;

                    const detailsDiv = document.createElement('div');
                    detailsDiv.className = 'network-details';
                    detailsDiv.innerHTML = `
                    <p><strong>BSSID:</strong> ${network.BSSID}</p>
                    <p><strong>Canal:</strong> ${network.Channel}</p>
                    <p><strong>Frecuencia:</strong> ${network.Signal}</p>
                       <p><strong>Encryption:</strong> ${network.Encryption}</p>
                    <button class="btn btn-primary select-network-btn">Seleccionar Red WiFi</button>
                `;

                    listItem.addEventListener('click', function() {
                        const isVisible = detailsDiv.style.display === 'block';
                        detailsDiv.style.display = isVisible ? 'none' : 'block';
                    });

                    detailsDiv.querySelector('.select-network-btn').addEventListener('click', function() {
                        selectNetwork(network);
                    });

                    listItem.appendChild(detailsDiv);
                    wifiList.appendChild(listItem);
                });
            })
            .catch(error => {
                loadingSpinner.style.display = 'none'; // Ocultar el spinner si ocurre un error
                console.error('Error al obtener las redes:', error);
                alert('Error al conectar con la API. Por favor, asegúrate de que está inicializada.');
            });
    });


    // Función para enviar la red seleccionada al controlador
    function selectNetwork(network) {
        fetch('select-network', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    essid: network.ESSID,
                    bssid: network.BSSID,
                    signal: network.Signal,
                    channel: network.Channel,
                    encryption: network.Encryption
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Red WiFi seleccionada con éxito');
                } else {
                    alert('Error al seleccionar la red WiFi');
                }
            })
            .catch(error => console.error('Error al seleccionar la red:', error));
    }
</script>

</body>

</html>