<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available WiFi Networks</title>
</head>
<body>
    <h1>Available WiFi Networks</h1>
    <?php if (!empty($networks)): ?>
    <ul>
        <?php foreach ($networks as $network): ?>
        <li>
            <strong>ESSID:</strong> <?= esc($network['essid']) ?><br>
            <strong>BSSID:</strong> <?= esc($network['bssid']) ?><br>
            <strong>Signal:</strong> <?= esc($network['signal']) ?><br>
            <strong>Channel:</strong> <?= esc($network['channel']) ?><br>
            <strong>Encryption:</strong> <?= esc($network['encryption']) ?><br>
            <hr>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <p>No WiFi networks found</p>
    <?php endif; ?>
</body>

</html>

