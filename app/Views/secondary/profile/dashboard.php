<?= $this->include('modules/dashboard/start.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<title>Dashboard</title>
</head>

<div class="sidebar" id="sidebar">
  <h2 class="sidebar-title">CyberDashboard</h2>
  <select id="storeSelect" class="sidebar-select">
    <option value="main">Main Dashboard</option>
    <option value="network">Network Security</option>
    <option value="devices">Device Monitoring</option>
  </select>
  <nav>
    <a href="#dashboard" class="active">
      <span class="icon">🏠</span> <span class="text">Dashboard</span>
    </a>
    <a href="#analytics">
      <span class="icon">📊</span> <span class="text">Analytics</span>
      <span class="notification">3</span>
    </a>
    <a href="#campaigns">
      <span class="icon">📋</span> <span class="text">Campaigns</span>
      <span class="notification">1</span>
    </a>
    <a href="#settings">
      <span class="icon">⚙️</span> <span class="text">Settings</span>
    </a>
    <a href="#help">
      <span class="icon">❓</span> <span class="text">Help Center</span>
    </a>
  </nav>
  <button id="toggleSidebar">↔️</button>
</div>


  <div class="main-content">
    <header>
      <div class="user-profile">
        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn0.iconfinder.com%2Fdata%2Ficons%2Fcyber-crime-or-threats%2F120%2Fhacker_cyber_crime-1024.png&f=1&nofb=1&ipt=7a2df72b85cfa3042fb954e59b566e4269822c142fc794b409976a85b4b89d02&ipo=images" alt="Profile Picture">
        <span><?= session('user')->name; ?></span>
      </div>
    </header>

    <div class="dashboard-container">
  <!-- Columna Izquierda: Textual -->
  <div class="column izquierda">
    <div class="card large">
      <h3>Última Actividad</h3>
      <ul id="activityList">
        <li>
          <span class="username">usuario@correo.com</span>
          <span class="action">Inicio de sesión</span>
          <span class="timestamp">Hace 5 minutos</span>
        </li>
      </ul>
    </div>

    <div class="card large">
      <h3>Resumen de Incidentes</h3>
      <table id="incidentTable">
        <thead>
          <tr>
            <th>Incidente</th>
            <th>Fecha</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <!-- Los datos se cargarán dinámicamente aquí -->
        </tbody>
      </table>
    </div>
  </div>

  <div class="quick-config">
      <!-- Card: Última Red Escaneada -->
      <div class="card small">
        <h4>Última Red Escaneada</h4>
        <?php if (!empty($last_network)): ?>
        <p id="lastNetwork"><?= esc($last_network[0]['essid']) ?></p>
        <?php else: ?>
                    <p>No selected network found.</p>
                <?php endif; ?>
      </div>

      <!-- Card: Cambiar IP de Interfaz -->
      <div class="card small">
        <h4>Cambiar IP de Interfaz</h4>
        <form method="post" action="<?= base_url('ipset'); ?>" class="form">
        <label for="ip">Última IP: <span id="lastIP"><?= esc($last_ip) ?: 'N/A' ?></span></label>
          <div class="form-inputs">
            <input name="ip" type="text" id="ip" placeholder="e.g. 192.168.2.170" required>
            <input type="submit" value="Enter" class="btn-submit">
          </div>
        </form>
      </div>
  

    <div class="card small">
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
        <h4>Modo de escaneo:</h4>
        <form action="<?= site_url('setScanMode') ?>" method="post">
    <label for="mode">Modo de escaneo:</label>
    <select name="mode" id="mode" required>
        <option value="rapido">Rápido</option>
        <option value="intermedio">Intermedio</option>
        <option value="profundo">Profundo</option>
    </select>
    <button type="submit">Establecer Modo</button>
</form>
      </div>
        </div>

  <!-- Columna Derecha: Gráficos -->
  <div class="column derecha">
    <div class="card large">
      <h3>Visitas Mensuales</h3>
      <canvas id="visitasChart"></canvas>
    </div>

    <div class="card large">
      <h3>Amenazas Detectadas</h3>
      <canvas id="amenazasChart"></canvas>
    </div>

    <div class="card large">
      <h3>Gráfico de Actividad</h3>
      <canvas id="actividadChart"></canvas>
    </div>
  </div>
</div>


<!-- Scripts para agregar gráficos e interactividad -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.getElementById('toggleSidebar').addEventListener('click', function () {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('collapsed');
});
</script>

<script>
    const ctx = document.getElementById('visitasChart').getContext('2d');
const visitasChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
    datasets: [{
      label: 'Visitas',
      data: [1200, 1500, 1800, 1700, 1600, 2000],
      backgroundColor: '#4f46e5'
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false },
    },
    scales: {
      y: { beginAtZero: true }
    }
  }
});

</script>

<script>
    const actividades = [
  { usuario: 'user1@correo.com', accion: 'Inicio de sesión', tiempo: 'Hace 5 minutos' },
  { usuario: 'user2@correo.com', accion: 'Cambiado Contraseña', tiempo: 'Hace 10 minutos' },
  { usuario: 'user3@correo.com', accion: 'Acceso Denegado', tiempo: 'Hace 15 minutos' }
];

const activityList = document.getElementById('activityList');
actividades.forEach(actividad => {
  const li = document.createElement('li');
  li.innerHTML = `
    <span class="username">${actividad.usuario}</span>
    <span class="action">${actividad.accion}</span>
    <span class="timestamp">${actividad.tiempo}</span>
  `;
  activityList.appendChild(li);
});

</script>

<script>
    const amenazasCtx = document.getElementById('amenazasChart').getContext('2d');
const amenazasChart = new Chart(amenazasCtx, {
  type: 'radar',
  data: {
    labels: ['Malware', 'Phishing', 'DDoS', 'Ransomware', 'Spyware', 'Troyanos'],
    datasets: [{
      label: 'Amenazas',
      data: [65, 59, 90, 81, 56, 55],
      backgroundColor: 'rgba(78, 115, 223, 0.2)',
      borderColor: 'rgba(78, 115, 223, 1)',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false }
    },
    scales: {
      r: {
        beginAtZero: true
      }
    }
  }
});

</script>

<script>
    const actividadCtx = document.getElementById('actividadChart').getContext('2d');
const actividadChart = new Chart(actividadCtx, {
  type: 'line',
  data: {
    labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
    datasets: [{
      label: 'Actividad',
      data: [200, 300, 250, 400, 300, 450, 500],
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1,
      fill: true,
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false }
    },
    scales: {
      y: { beginAtZero: true }
    }
  }
});

</script>

<script>
    const incidentes = [
  { tipo: 'Malware', fecha: '2024-10-20', estado: 'Resuelto' },
  { tipo: 'Phishing', fecha: '2024-10-22', estado: 'Pendiente' },
  { tipo: 'DDoS', fecha: '2024-10-23', estado: 'En proceso' }
];

const tbody = document.querySelector('#incidentTable tbody');
incidentes.forEach(incidente => {
  const row = document.createElement('tr');
  row.innerHTML = `
    <td>${incidente.tipo}</td>
    <td>${incidente.fecha}</td>
    <td>${incidente.estado}</td>
  `;
  tbody.appendChild(row);
});

</script>

</body>

</html>