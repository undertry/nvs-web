<?= $this->include('common/history/start.php'); ?>
<title>Detalles del Scan</title>
</head>

<body>
  <div class="container">
    <h1 class="header"><a href="<?= base_url('dashboard'); ?>">NVS</a></h1>
    <h1>Detalles del Scan</h1>
    <div class="columns">
      <?php if (!empty($scanDetails) && is_array($scanDetails)) : ?>
        <?php
        // Agrupar los detalles del scan por cada scan
        $scansGrouped = [];
        foreach ($scanDetails as $detail) {
          $scansGrouped[$detail['fecha_scan']][] = $detail;
        }
        ?>
        <?php foreach ($scansGrouped as $fecha_scan => $details) : ?>
          <div class="scan-group">
            <div class="scan-summary" onclick="toggleDetails(this)">
              <h2>Información del Scan</h2>
              <ul>
                <li><strong>Fecha del Scan:</strong> <?= $fecha_scan ?></li>
                <li><strong>Usuario:</strong> <?= $details[0]['user_name'] ?></li>
              </ul>
            </div>
            <div class="scan-details">
              <div class="left-column">
                <h2>Información de la Red</h2>
                <ul>
                  <li><strong>Dirección de Red:</strong> <?= $details[0]['direccion_red'] ?></li>
                  <li><strong>Potencia:</strong> <?= $details[0]['potencia'] ?></li>
                  <li><strong>ESSID:</strong> <?= $details[0]['essid'] ?></li>
                  <li><strong>BSSID:</strong> <?= $details[0]['bssid'] ?></li>
                  <li><strong>Tipo de Seguridad:</strong> <?= $details[0]['tipo_seguridad'] ?></li>
                </ul>
              </div>
              <div class="right-column">
                <h2>Información de los Dispositivos</h2>
                <?php foreach ($details as $detail) : ?>
                  <h3>Dispositivo</h3>
                  <ul>
                    <li><strong>IP:</strong> <?= $detail['direccion_ip'] ?></li>
                    <li><strong>Sistema Operativo:</strong> <?= $detail['sistema_operativo'] ?></li>
                    <li><strong>MAC:</strong> <?= $detail['dir_mac'] ?></li>
                  </ul>
                  <h3>Información del Puerto</h3>
                  <ul>
                    <li><strong>Puerto:</strong> <?= $detail['puerto_nombre'] ?></li>
                    <li><strong>Servicio:</strong> <?= $detail['servicio'] ?></li>
                    <li><strong>Protocolo:</strong> <?= $detail['protocolo'] ?></li>
                    <li><strong>Estado:</strong>
                      <?php
                      if ($detail['abierto']) echo 'Abierto';
                      elseif ($detail['cerrado']) echo 'Cerrado';
                      else echo 'Filtrado';
                      ?>
                    </li>
                  </ul>
                  <h3>Código Público</h3>
                  <ul>
                    <li><?= $detail['codigo_vulnerabilidad'] ?></li>
                  </ul>
                  <h3 id="descripcion">Descripción vulnerabilidad</h3>
                  <ul>
                    <li><?= $detail['descripcion_vuln'] ?></li>
                  </ul>
                  <h3 id="solucion">Solución</h3>
                  <ul>
                    <li><?= $detail['solucion'] ?></li>
                  </ul>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p>No se encontraron detalles para este scan.</p>
      <?php endif; ?>
    </div>
  </div>
  <?= $this->include('common/history/end.php'); ?>