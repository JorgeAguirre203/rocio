<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cuenta Afiliado</title>
    <link rel="stylesheet" href="style_bienvenida.css">
</head>
<body>
    <div class="form-container">
        <h2>Eliminar Cuenta</h2>
        {if $mensaje}
            <div class="alert">{$mensaje}</div>
        {/if}
        <form method="post">
            <p>¿Estás seguro que deseas eliminar tu cuenta, <strong>{$afiliado.nombre} {$afiliado.apellido_paterno} {$afiliado.apellido_materno}</strong>?<br>
            Esta acción es irreversible.</p>
            <button type="submit" class="danger">Sí, eliminar mi cuenta</button>
            <a href="afiliados.php"><button type="button" class="button-secondary">Cancelar</button></a>
        </form>
    </div>
</body>
</html>