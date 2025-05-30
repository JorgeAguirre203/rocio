<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cotización</title>
</head>
<body>
    <h2>Crear Cotización</h2>
    <form method="post">
        <input type="hidden" name="peticion_id" value="{$peticion_id}">
        <label>Servicio:</label>
        <select name="servicio" required>
            <option value="plomeria">Plomería</option>
            <option value="electricidad">Electricidad</option>
            <option value="carpinteria">Carpintería</option>
            <option value="albanileria">Albañilería</option>
        </select><br><br>
        <label>Horas estimadas:</label>
        <input type="number" step="0.1" name="horas" required><br><br>
        <label>Precio por hora:</label>
        <input type="number" step="0.01" name="precio_hora" required><br><br>
        <label>Detalles:</label><br>
        <textarea name="detalles" rows="3"></textarea><br><br>
        <button type="submit">Guardar y continuar a pago</button>
    </form>
</body>
</html>