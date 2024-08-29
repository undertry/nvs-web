<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
/* Estilo Global */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    /* Color de fondo claro */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    /* Altura completa del viewport */
}

.container {
    background-color: #ffffff;
    /* Fondo blanco para el formulario */
    border-radius: 8px;
    /* Bordes redondeados */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Sombra sutil */
    padding: 20px;
    max-width: 400px;
    /* Ancho máximo del formulario */
    width: 100%;
    text-align: center;
    /* Centrar el texto */
}

h2 {
    margin: 0 0 20px;
    /* Espacio debajo del título */
    font-size: 1.5em;
    /* Tamaño del título */
    color: #333;
    /* Color del texto */
}

.form-inputs {
    margin-bottom: 20px;
    /* Espacio debajo de los campos del formulario */
}

.form-label {
    margin-bottom: 15px;
    /* Espacio debajo de cada campo */
}

input[type="email"] {
    width: 100%;
    /* Ancho completo del contenedor */
    padding: 10px;
    /* Espaciado interno */
    border: 1px solid #ddd;
    /* Borde gris claro */
    border-radius: 4px;
    /* Bordes ligeramente redondeados */
    box-sizing: border-box;
    /* Incluir padding y borde en el ancho total */
}

input[type="submit"] {
    background-color: #007bff;
    /* Color de fondo del botón */
    color: #fff;
    /* Color del texto del botón */
    border: none;
    /* Sin borde */
    border-radius: 4px;
    /* Bordes redondeados del botón */
    padding: 10px 15px;
    /* Espaciado interno del botón */
    font-size: 1em;
    /* Tamaño de fuente del botón */
    cursor: pointer;
    /* Cursor de puntero en hover */
    width: 100%;
    /* Ancho completo del contenedor */
    box-sizing: border-box;
    /* Incluir padding y borde en el ancho total */
}

input[type="submit"]:hover {
    background-color: #0056b3;
    /* Color de fondo en hover */
}

p {
    margin-top: 20px;
    /* Espacio arriba del párrafo */
}

a {
    color: #007bff;
    /* Color del enlace */
    text-decoration: none;
    /* Sin subrayado */
}

a:hover {
    text-decoration: underline;
    /* Subrayar en hover */
}
</style>

<body>
    <div class="container">
        <form method="post" action="<?= base_url('/sendemail'); ?>" class="form">
            <h2>Forgot Password</h2>
            <div class="form-inputs">
                <div class="form-label">
                    <input name="email" type="email" id="email" placeholder="name@example.com" required>
                </div>
                <input type="submit" value="Send Code">
        </form>
        <p> <a href="<?= base_url('login'); ?>">Log In</a> </p>
    </div>
</body>

</html>