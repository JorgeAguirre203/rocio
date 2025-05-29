<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar dirección</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: white;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 24px #bbb;
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            color: #444;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
        }

        button {
            background-color: #4a4a4a;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 1em;
            margin-top: 10px;
        }

        button:hover {
            background-color: #333;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #ffeeee;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }

        .success {
            color: green;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #eeffee;
            border: 1px solid #ccffcc;
            border-radius: 5px;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Agregar dirección</h2>
        {if $mensaje}
            <script>
                alert('{$mensaje|escape:"js"}');
                {if $mensaje == 'Dirección guardada correctamente'}
                    window.close();
                {/if}
            </script>
        {/if}
        <form method="post" id="direccionForm" autocomplete="off">
            <label>Calle:
                <input type="text" name="calle" id="calle" required>
            </label>
            <label>Colonia:
                <input type="text" name="colonia" id="colonia" required>
            </label>
            <label>Número de casa:
                <input type="text" name="numero_casa" id="numero_casa" required>
            </label>
            <label>Estado:
                <input type="text" name="estado" id="estado" required>
            </label>
            <label>Municipio:
                <input type="text" name="municipio" id="municipio" required>
            </label>
            <button type="submit">Guardar</button>
            <a href="dashboard_servicios.php">
                <button type="button" style="margin-top:10px;">Salir</button>
            </a>
        </form>
    </div>
    <script>
    document.getElementById('direccionForm').addEventListener('submit', function(e) {
        // Obtener valores
        const calle = document.getElementById('calle').value.trim();
        const colonia = document.getElementById('colonia').value.trim();
        const numero_casa = document.getElementById('numero_casa').value.trim();
        const estado = document.getElementById('estado').value.trim();
        const municipio = document.getElementById('municipio').value.trim();

        // Validar que todos los campos estén llenos
        if (!calle || !colonia || !numero_casa || !estado || !municipio) {
            alert('Todos los campos son obligatorios.');
            e.preventDefault();
            return false;
        }

        // Validar que calle, colonia, estado y municipio NO contengan números
        const soloLetras = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;
        if (!soloLetras.test(calle)) {
            alert('La calle solo debe contener letras.');
            e.preventDefault();
            return false;
        }
        if (!soloLetras.test(colonia)) {
            alert('La colonia solo debe contener letras.');
            e.preventDefault();
            return false;
        }
        if (!soloLetras.test(estado)) {
            alert('El estado solo debe contener letras.');
            e.preventDefault();
            return false;
        }
        if (!soloLetras.test(municipio)) {
            alert('El municipio solo debe contener letras.');
            e.preventDefault();
            return false;
        }

        // Validar que número de casa NO contenga letras (solo números y opcionalmente guiones)
        const soloNumeros = /^[0-9\-]+$/;
        if (!soloNumeros.test(numero_casa)) {
            alert('El número de casa solo debe contener números o guiones.');
            e.preventDefault();
            return false;
        }
    });
    </script>
</body>
</html>