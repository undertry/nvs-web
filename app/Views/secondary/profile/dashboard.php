<?= $this->include('modules/dashboard/start.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Dashboard</title>
</head>

<div class="sidebar" id="sidebar">
    <h2 class="sidebar-title"><i class="fa-solid fa-fingerprint"></i></h2>
    <nav>
        <a class="active"><span class="icon"><i class="fa-solid fa-inbox"></i></span> <span class="text">Dashboard</span></a>
        <a href="<?= base_url('nmap-animation'); ?>"><span class="icon"><i class="fa-solid fa-shield-virus"></i></span> <span class="text">Scan Results</span></a>
        <a href="<?= base_url('history-animation'); ?>"><span class="icon"><i class="fa-solid fa-clock-rotate-left"></i></span> <span class="text">History</span></a>


        <a href="#help"><span class="icon"><i class="fa-solid fa-circle-info"></i></span> <span class="text">Help Center</span></a>
    </nav>
</div>

<div class="main-content">
    <header>
        <div class="user-profile">
            <i class="fa-solid fa-user-secret user" id="user-icon"></i>
            <a href="<?= base_url('configuration') ?>" class="settings"><i class="fa-solid fa-gear"></i></a>
        </div>

        <!-- Modal de Perfil de Usuario -->
        <div id="userModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>User Information</h2>
                <p><strong>Name:</strong> <?= session('user')->name; ?></p>
                <p><strong>Email:</strong> <?= session('user')->email; ?></p>
                <p><strong>Account created at:</strong> <?= session('user')->created_at; ?></p>
                <p><strong>Verification:</strong>
                    <?= session('user')->verification == 1 ? 'Enabled' : 'Disabled'; ?></p>
                <!-- Puedes agregar más datos del usuario aquí -->
            </div>
        </div>


    </header>

    <div class="content-wrapper">
        <!-- Sección de Redes WiFi -->

        <div class="wifi-section">
            <div class="section-header hidden">
                <h2><i class="fa-brands fa-uncharted"></i></h2>
            </div>
            <h2> Available WiFi Networks</h2>
            <button id="fetch-networks" class="btn btn-primary">Start Scan</button>
            <div id="loading-spinner" style="display: none; text-align: center;">
                <div class="spinner-border text-primary" role="status"></div>
                <p><i class="fa-solid fa-spinner"></i></p>
            </div>
            <ul id="wifi-list" class="list-group mt-3"></ul>
        </div>

        <div class="accordion-section">
            <div class="text">
                <h3>Menu</h3>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-title" onclick="toggleAccordion('info-content')">
                    <i class="fa-solid fa-database icon"></i> Information
                </h2>
                <div id="info-content" class="accordion-content">
                    <p><strong>Current IP:</strong> <?= session('ip'); ?></p>
                    <p><strong>Chosen Mode:</strong> <?= session('mode'); ?></p>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-title" onclick="toggleAccordion('last-network-content')">
                    <i class="fa-solid fa-wifi icon"></i> Current Network
                </h2>
                <div id="last-network-content" class="accordion-content">
                    <?php if (session()->has('current_network')): ?>
                        <p><strong>Current Network Selected:

                            </strong><?= session('current_network')['essid']; ?></p>
                        <p><strong>BSSID: </strong> <?= session('current_network')['bssid']; ?></p>
                        <p><strong>Signal: </strong> <?= session('current_network')['signal']; ?></p>
                        <p><strong>channel: </strong> <?= session('current_network')['channel']; ?></p>
                        <p><strong>Encryption: </strong> <?= session('current_network')['security']; ?></p>

                    <?php else: ?>
                        <p>No previous scan results were found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-title" onclick="toggleAccordion('scan-content')">
                    <i class="fas fa-list-check icon"></i> Scan Manager
                </h2>
                <div id="scan-content" class="accordion-content">
                    <?php if (session('scan_message')): ?>
                        <div class="alert alert-info">
                            <?= session('scan_message'); ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= base_url('startWifiScan'); ?>" style="display: inline;">
                        <input type="submit" value="Wifi" class="btn-submit">
                    </form>
                    <form method="post" action="<?= base_url('startDeviceScan'); ?>" style="display: inline;">
                        <input type="submit" value="Device" class="btn-submit">
                    </form>
                    <form method="post" action="<?= base_url('startNmapScan'); ?>" style="display: inline;">
                        <input type="submit" value="Nmap" class="btn-submit">
                    </form>
                    <form method="post" action="<?= base_url('csv'); ?>" style="display: inline;">
                        <input type="submit" value="csv" class="btn-submit">
                    </form>
                    <form method="post" action="<?= base_url('mac'); ?>" style="display: inline;">
                        <input type="submit" value="mac" class="btn-submit">
                    </form>
                </div>
            </div>

        </div>



    </div>
</div>

<script>
    function toggleAccordion(contentId) {
        const content = document.getElementById(contentId);
        content.style.display = (content.style.display === "none" || content.style.display === "") ? "block" : "none";
    }
</script>


<script>
    document.getElementById('user-icon').onclick = function() {
        // Muestra el modal
        document.getElementById('userModal').style.display = "block";
    }

    document.querySelector('.close').onclick = function() {
        // Oculta el modal
        document.getElementById('userModal').style.display = "none";
    }

    // Cierra el modal si el usuario hace clic fuera de él
    window.onclick = function(event) {
        if (event.target == document.getElementById('userModal')) {
            document.getElementById('userModal').style.display = "none";
        }
    }
</script>


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