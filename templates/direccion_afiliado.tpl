<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar dirección (Afiliado)</title>
    <link rel="stylesheet" href="direccion_form.css">
</head>
<body>
    <div class="form-container">
        <h2>Dirección del Afiliado</h2>
        {if $mensaje}
            <script>
                alert('{$mensaje|escape:"javascript"}');
                {if $mensaje == 'Dirección guardada correctamente'}
                    window.location.href = 'dashboard_servicios.php';
                {/if}
            </script>
        {/if}
        
        <form method="post" id="direccionForm" autocomplete="off">
            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="{$datos_actuales.calle|default:''}" required>
                <span class="error-message" id="calle-error">Solo se permiten letras y espacios</span>
            </div>
            
            <div class="form-group">
                <label for="numero_casa">Número de casa (opcional):</label>
                <input type="text" id="numero_casa" name="numero_casa" value="{$datos_actuales.numero_casa|default:''}">
                <span class="error-message" id="numero-error">Solo se permiten números y guiones</span>
            </div>
            
            <div class="form-group">
                <label for="codigo_postal">Código postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" value="{$datos_actuales.codigo_postal|default:''}" maxlength="5" required>
                <span class="error-message" id="cp-error">El código postal debe ser de 5 dígitos numéricos</span>
            </div>
            
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="Sinaloa" readonly>
            </div>
            
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" id="municipio" name="municipio" value="Ahome" readonly>
            </div>
            
            <div class="form-group">
                <label for="indicaciones">Indicaciones adicionales:</label>
                <textarea id="indicaciones" name="indicaciones" required>{$datos_actuales.indicaciones|default:''}</textarea>
                <small>Ejemplo: Casa color azul, portón rojo, coche blanco estacionado</small>
            </div>
            
            <button type="submit">Guardar dirección</button>
            <a href="dashboard_servicios.php">
                <button type="button" class="button-secondary">Cancelar y salir</button>
            </a>
        </form>
    </div>
    <script src="direccion_form.js"></script>
</body>
</html>