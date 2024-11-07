<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nmap Scan Results</title>
    <style>
/* Reset de márgenes y paddings */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilos del body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    color: #333;
    line-height: 1.6;
}

/* Contenedor principal */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Secciones */
section {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}

/* Títulos */
h2, h3 {
    color: #dc3545; /* Rojo */
    margin-bottom: 10px;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 20px;
}

/* Listas */
ul {
    list-style-type: none; /* Quitar puntos de las listas */
    padding-left: 0; /* Sin padding a la izquierda */
}

li {
    background-color: #f2f2f2; /* Color de fondo para cada ítem */
    border: 1px solid #ddd; /* Borde para cada ítem */
    border-radius: 5px;
    padding: 10px;
    margin: 5px 0; /* Margen entre los ítems */
}

/* Estilo para párrafos */
p {
    margin: 10px 0;
}

/* Botones */
button {
    background-color: #dc3545; /* Rojo */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #c82333; /* Rojo más oscuro */
}

/* Estilos responsivos */
@media (max-width: 768px) {
    section {
        padding: 15px;
    }
    
    h2, h3 {
        font-size: 20px;
    }

    button {
        width: 100%;
    }

    .container {
        padding: 10px;
    }
}

/* Estilo para el botón de ver vulnerabilidades */
#toggle-vulnerabilities {
    margin-top: 15px;
    background-color: #007bff; /* Color azul */
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

#toggle-vulnerabilities:hover {
    background-color: #0056b3; /* Azul más oscuro */
}



    </style>
</head>
<body>
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

    <script>
    document.getElementById("toggle-vulnerabilities").addEventListener("click", function() {
        const vulnerabilitiesList = document.getElementById("vulnerabilities-list");
        if (vulnerabilitiesList.style.display === "none") {
            vulnerabilitiesList.style.display = "block"; // Muestra la lista
            this.textContent = "Ocultar Vulnerabilidades"; // Cambia el texto del botón
        } else {
            vulnerabilitiesList.style.display = "none"; // Oculta la lista
            this.textContent = "Ver Vulnerabilidades"; // Restablece el texto del botón
        }
    });
</script>


</body>
</html>