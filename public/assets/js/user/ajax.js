document.getElementById('fetch-networks').addEventListener('click', function () {
    const wifiList = document.getElementById('wifi-list');
    const loadingSpinner = document.getElementById('loading-spinner');
    const arrowIcon = this.querySelector('.arrow-icon');

    if (wifiList.style.display === 'none') {
        wifiList.style.display = 'block';
        arrowIcon.classList.add('rotate');
        loadingSpinner.style.display = 'block';
        wifiList.innerHTML = '';

        fetch('fetchNetworks')
            .then(response => response.json())
            .then(data => {
                loadingSpinner.style.display = 'none';

                if (!data.success) {
                    alert(data.message);
                    return;
                }

                data.data.forEach(network => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';

                    const detailsDiv = document.createElement('div');
                    detailsDiv.className = 'network-details';
                    detailsDiv.innerHTML = `
                        <p><strong><i class="fa-solid fa-wifi"></i> ESSID:</strong> ${network.ESSID}</p>
                        <p><strong><i class="fa-solid fa-tag"></i> BSSID:</strong> ${network.BSSID}</p>
                        <p><strong><i class="fa-solid fa-list"></i> Canal:</strong> ${network.Channel}</p>
                        <p><strong><i class="fa-solid fa-signal"></i> Frecuencia:</strong> ${network.Signal}</p>
                        <p><strong><i class="fa-solid fa-lock"></i> Encryption:</strong> ${network.Encryption}</p>
                        <button class="btn btn-primary select-network-btn">Seleccionar Red WiFi</button>
                      `;

                    detailsDiv.querySelector('.select-network-btn').addEventListener('click', function () {
                        selectNetwork(network);
                    });

                    listItem.appendChild(detailsDiv);
                    wifiList.appendChild(listItem);
                });
            })
            .catch(error => {
                loadingSpinner.style.display = 'none';
                console.error('Error al obtener las redes:', error);
                alert('Error al conectar con la API. Por favor, asegúrate de que está inicializada.');
            });
    } else {
        wifiList.style.display = 'none';
        arrowIcon.classList.remove('rotate');
    }
});

function selectNetwork(network) {
    fetch('/NVS/public/scan/select-network', {
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

document.getElementById('fetch-devices').addEventListener('click', function () {
    const deviceList = document.getElementById('device-list');
    const loadingSpinnerDevice = document.getElementById('loading-spinner-device');
    const arrowIcon = this.querySelector('.arrow-icon');

    if (deviceList.style.display === 'none') {
        deviceList.style.display = 'block';
        arrowIcon.classList.add('rotate');
        loadingSpinnerDevice.style.display = 'block';
        deviceList.innerHTML = '';

        fetch('fetchDevices')
            .then(response => response.json())
            .then(data => {
                loadingSpinnerDevice.style.display = 'none';

                if (!data.success) {
                    alert(data.message);
                    return;
                }

                data.data.forEach(device => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';

                    const detailsDiv = document.createElement('div');
                    detailsDiv.className = 'device-details';
                    detailsDiv.innerHTML = `
                        <p><strong><i class="fa-solid fa-tag"></i> MAC Address:</strong> ${device.mac_address}</p>
                        <p><strong><i class="fa-solid fa-map-pin"></i> IP Address:</strong> ${device.ip_address}</p>
                      `;
                    listItem.appendChild(detailsDiv);
                    deviceList.appendChild(listItem);
                });
            })
            .catch(error => {
                loadingSpinnerDevice.style.display = 'none';
                console.error('Error al obtener los dispositivos:', error);
                alert('Error al conectar con la API de dispositivos. Por favor, asegúrate de que está inicializada.');
            });
    } else {
        deviceList.style.display = 'none';
        arrowIcon.classList.remove('rotate');
    }
});