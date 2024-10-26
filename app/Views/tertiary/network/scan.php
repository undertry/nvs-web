<!-- scan.html -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opciones de Escaneo WiFi</title>
</head>
<body>
<h2>Seleccionar Modo de Escaneo</h2>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<form action="<?= site_url('setScanMode') ?>" method="post">
    <label for="mode">Modo de escaneo:</label>
    <select name="mode" id="mode" required>
        <option value="rapido">Rápido</option>
        <option value="intermedio">Intermedio</option>
        <option value="profundo">Profundo</option>
    </select>
    <button type="submit">Establecer Modo</button>
</form>
</body>
</html>
