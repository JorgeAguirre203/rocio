<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{$page_title}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
            width: 400px;
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4a4a4a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
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
        }

        .success {
            color: green;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #eeffee;
            border: 1px solid #ccffcc;
            border-radius: 5px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
            display: none;
        }
        .input-error {
            border-color: red;
        }
    </style>
    {if $success}
    <script>
        alert('Datos actualizados correctamente.');
        window.location.href='dashboard_servicios.php';
    </script>
    {/if}
</head>
<body>
    <div class="form-container">
        <h2>{$page_title}</h2>
        {if $error}
            <div class="error">{$error}</div>
        {/if}
        
        <form method="post" id="editarPerfilForm" autocomplete="off">
            <label>Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{$nombre_actual}" required>
            <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>

            <label>Nickname:</label>
            <input type="text" name="nickname" value="{$nickname_actual}" required>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>

    {literal}
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación en tiempo real para el campo nombre
        const nombreInput = document.getElementById('nombre');
        const nombreError = document.getElementById('nombre-error');
        nombreInput.addEventListener('input', function() {
            const regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]*$/;
            if (!regex.test(this.value)) {
                this.classList.add('input-error');
                nombreError.style.display = 'block';
                this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
            } else {
                this.classList.remove('input-error');
                nombreError.style.display = 'none';
            }
        });

        // Validación al enviar el formulario
        document.getElementById('editarPerfilForm').addEventListener('submit', function(e) {
            if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(nombreInput.value.trim())) {
                nombreInput.classList.add('input-error');
                nombreError.style.display = 'block';
                e.preventDefault();
            }
        });
    });
    </script>
    {/literal}
</body>
</html>