<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil | Afiliado</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
            width: 100%;
            max-width: 500px;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 15px;
        }

        input[type="file"] {
            padding: 3px;
        }

        .current-photo {
            margin: 15px 0;
            text-align: center;
        }

        .current-photo p {
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .preview-image {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            max-height: 200px;
            border-radius: 6px;
            border: 1px solid #eee;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        button {
            background-color: #4a4a4a;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin: 5px 0;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #333;
        }

        .button-secondary {
            background-color: #888;
        }

        .button-secondary:hover {
            background-color: #555;
        }

        .alert {
            color: #333;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-success {
            background-color: #eeffee;
            border: 1px solid #ccffcc;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .file-input-container {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Perfil de Afiliado</h2>
        
        {if $mensaje}
            <div class="alert {if $mensaje|lower|strpos:'error' !== false}alert-error{else}alert-success{/if}">
                {$mensaje}
            </div>
        {/if}
        
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{$afiliado.nombre|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="apellido_paterno">Apellido paterno:</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="{$afiliado.apellido_paterno|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="apellido_materno">Apellido materno:</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="{$afiliado.apellido_materno|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="nickname">Nickname:</label>
                <input type="text" id="nickname" name="nickname" value="{$afiliado.nickname|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{$afiliado.email|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{$afiliado.telefono|escape:'html'}" required>
            </div>
            
            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="albanileria" {if $afiliado.especialidad == 'albanileria'}selected{/if}>Albañilería</option>
                    <option value="plomeria" {if $afiliado.especialidad == 'plomeria'}selected{/if}>Plomería</option>
                    <option value="carpinteria" {if $afiliado.especialidad == 'carpinteria'}selected{/if}>Carpintería</option>
                    <option value="electricidad" {if $afiliado.especialidad == 'electricidad'}selected{/if}>Electricidad</option>
                </select>
            </div>
            
            <!-- Sección mejorada para Foto de Perfil -->
            <div class="form-group">
                <label for="foto_perfil">Foto de perfil:</label>
                <div class="file-input-container">
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg, image/png, image/gif">
                </div>
                {if $afiliado.foto_perfil}
                    <div class="current-photo">
                        <p>Foto actual:</p>
                        <img src="{$afiliado.foto_perfil}" alt="Foto de perfil" class="preview-image">
                    </div>
                {/if}
            </div>
            
            <!-- Sección para INE Frente -->
            <div class="form-group">
                <label for="ine_frente">INE Frente:</label>
                <div class="file-input-container">
                    <input type="file" id="ine_frente" name="ine_frente" accept="image/jpeg, image/png, image/gif">
                </div>
                {if $afiliado.ine_frente}
                    <div class="current-photo">
                        <p>INE Frente actual:</p>
                        <img src="{$afiliado.ine_frente}" alt="INE Frente" class="preview-image">
                    </div>
                {/if}
            </div>
            
            <!-- Sección para INE Reverso -->
            <div class="form-group">
                <label for="ine_reverso">INE Reverso:</label>
                <div class="file-input-container">
                    <input type="file" id="ine_reverso" name="ine_reverso" accept="image/jpeg, image/png, image/gif">
                </div>
                {if $afiliado.ine_reverso}
                    <div class="current-photo">
                        <p>INE Reverso actual:</p>
                        <img src="{$afiliado.ine_reverso}" alt="INE Reverso" class="preview-image">
                    </div>
                {/if}
            </div>
            
            <button type="submit">Guardar cambios</button>
            <a href="afiliados.php">
                <button type="button" class="button-secondary">Cancelar</button>
            </a>
        </form>
    </div>

    <script>
    // Opcional: Puedes agregar aquí scripts para previsualizar imágenes antes de subir
    document.addEventListener('DOMContentLoaded', function() {
        // Ejemplo de previsualización para foto de perfil
        document.getElementById('foto_perfil').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const previewContainer = this.closest('.form-group').querySelector('.current-photo') || 
                                       this.closest('.form-group').appendChild(document.createElement('div'));
                
                previewContainer.className = 'current-photo';
                previewContainer.innerHTML = '<p>Nueva vista previa:</p><img class="preview-image">';
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContainer.querySelector('img').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Puedes agregar listeners similares para los otros campos de imagen
    });
    </script>
</body>
</html>