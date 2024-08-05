<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redes WiFi Disponibles</title>
</head>
<body>
    <h1>Redes WiFi Disponibles</h1>
    <?php if (!empty($networks)): ?>
        <ul>
            <?php foreach ($networks as $network): ?>
                <li>
                    <strong>ESSID:</strong> <?= esc($network['essid']) ?><br>
                    <strong>BSSID:</strong> <?= esc($network['bssid']) ?><br>
                    <strong>Señal:</strong> <?= esc($network['signal']) ?><br>
                    <strong>Canal:</strong> <?= esc($network['channel']) ?><br>
                    <strong>Encriptación:</strong> <?= esc($network['encryption']) ?><br>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No se encontraron redes WiFi.</p>
    <?php endif; ?>
</body>
</html>
