<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Scan</title>
</head>
<body>
    <h1>Detalles del Scan</h1>
    
    <?php if (!empty($scanDetails) && is_array($scanDetails)): ?>
        <h2>Información del Scan</h2>
        <ul>
            <li><strong>Fecha del Scan:</strong> <?= $scanDetails[0]['fecha_scan'] ?></li>
            <li><strong>Usuario:</strong> <?= $scanDetails[0]['user_name'] ?></li>
        </ul>

        <h2>Información de la Red</h2>
        <ul>
            <li><strong>Dirección de Red:</strong> <?= $scanDetails[0]['direccion_red'] ?></li>
            <li><strong>Potencia:</strong> <?= $scanDetails[0]['potencia'] ?></li>
            <li><strong>ESSID:</strong> <?= $scanDetails[0]['essid'] ?></li>
            <li><strong>BSSID:</strong> <?= $scanDetails[0]['bssid'] ?></li>
            <li><strong>Tipo de Seguridad:</strong> <?= $scanDetails[0]['tipo_seguridad'] ?></li>
        </ul>

        <h2>Información de los Dispositivos</h2>
        <?php foreach ($scanDetails as $detail): ?>
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

            <h3>Solución</h3>
            <ul>
                <li><?= $detail['solucion'] ?></li>
            </ul>
        <?php endforeach; ?>

    <?php else: ?>
        <p>No se encontraron detalles para este scan.</p>
    <?php endif; ?>
</body>
</html>
