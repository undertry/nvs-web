<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Available WiFi Networks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/progressbar.js@1.1.0/dist/progressbar.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('complements/styles/tertiary/network.css'); ?>">
</head>

<body>
    <!-- Div para mostrar mensajes de éxito -->
    <div id="successMessage"
        style="display:none; background-color: #4CAF50; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
        ¡Red seleccionada con éxito!
    </div>

    <div class="container">
        <h1>Available WiFi Networks</h1>
        <?php if (!empty($network)): ?>
        <ul class="wifi-list">
            <?php foreach ($network as $net): ?>
            <li class="wifi-card">
                <strong class="essid"><i class="fa-solid fa-wifi"></i> ESSID:</strong> <?= esc($net['ESSID']) ?><br>
                <strong class="bssid"><i class="fa-solid fa-tag"></i> BSSID:</strong>
                <?= esc($net['BSSID']) ?><br>
                <strong class="signal"><i class="fa-solid fa-signal"></i> Signal:</strong>
                <?= esc($net['Signal']) ?><br>
                <strong class="channel"><i class="fa-solid fa-list"></i> Channel:</strong>
                <?= esc($net['Channel']) ?><br>
                <strong class="encryption"><i class="fa-solid fa-lock"></i> Encryption:</strong>
                <?= esc($net['Encryption']) ?>

                <!-- Mostrar un icono de alerta si es OPN o WPA -->
                <?php if (esc($net['Encryption']) == 'OPN'): ?>
                <i class="fa-solid fa-exclamation-circle" style="color: orange;" title="Open Network - Unsecure"></i>
                <?php elseif (strpos(esc($net['Encryption']), 'WPA') !== false): ?>
                <i class="fa-solid fa-shield" style="color: green;" title="WPA Secured Network"></i>
                <?php endif; ?>
                <br>

                <!-- Botón para seleccionar la red -->
                <form id="networkForm-<?= esc($net['ESSID']) ?>" action="<?= base_url('select-network') ?>"
                    method="post">
                    <input type="hidden" name="essid" value="<?= esc($net['ESSID']) ?>">
                    <input type="hidden" name="bssid" value="<?= esc($net['BSSID']) ?>">
                    <input type="hidden" name="signal" value="<?= esc($net['Signal']) ?>">
                    <input type="hidden" name="channel" value="<?= esc($net['Channel']) ?>">
                    <input type="hidden" name="encryption" value="<?= esc($net['Encryption']) ?>">
                    <button type="submit" class="btn-select">Seleccionar</button>
                </form>

            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No WiFi networks found.</p>
        <?php endif; ?>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const forms = document.querySelectorAll("form[id^='networkForm']");

        forms.forEach(function(form) {
            form.addEventListener("submit", function(event) {
                event.preventDefault(); // Evita que el formulario se envíe y recargue la página

                // Mostrar el mensaje de éxito
                const successMessage = document.getElementById("successMessage");
                successMessage.style.display = "block";

                // Ocultar el mensaje después de unos segundos
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 3000);

                // Aquí es donde realmente envías el formulario después de mostrar el mensaje
                form.submit();
            });
        });
    });
    </script>

</body>

</html>