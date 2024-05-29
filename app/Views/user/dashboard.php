<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .navbar {
            width: 100%;
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .profile-container h1 {
            font-size: 2.5rem;
            color: #333;
        }
        .profile-container p {
            font-size: 1.2rem;
            color: #666;
        }
        .profile-info {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="<?= base_url('/'); ?>">Home</a>
        <a href="<?= base_url('/logout'); ?>">Logout</a>
        <a href="<?= base_url('/console'); ?>">Console</a>
    </div>
    <div class="profile-container">
        <h1>Perfil de Usuario</h1>
        <div class="profile-info">
            <p>Nombre: <?= session('user')->name; ?></p>
            <p>Email: <?= session('user')->email; ?></p>
            <p>Cuenta creada: <?= session('user')->created_at; ?></p>
        </div>
    </div>
</body>
</html>
