<?php
/* Smarty version 3.1.39, created on 2025-11-11 01:15:02
  from 'C:\xampp\htdocs\rocio\templates\editar_perfil_afiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_69128006e50528_26418737',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47e9f08615a4ca2e432b97298133a204e414bce5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\editar_perfil_afiliado.tpl',
      1 => 1762469278,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69128006e50528_26418737 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
        .error-message {
            display: none;
            color: red;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .input-error {
            border-color: red;
        }
    </style>
</head>
<body>

    <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
        <div class="alert alert-success" style="color:green; margin:10px 0;"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
    <?php }?>
    <div class="form-container">
        <h2>Editar Perfil de Afiliado</h2>
        
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <div class="alert <?php if (strpos(mb_strtolower($_smarty_tpl->tpl_vars['mensaje']->value, 'UTF-8'),'error') !== false) {?>alert-error<?php } else { ?>alert-success<?php }?>">
                <?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>

            </div>
        <?php }?>
        
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
" required>
                <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>
            </div>
            
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos"
                value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['apellido_paterno'], ENT_QUOTES, 'UTF-8', true);
if ($_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno']) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno'], ENT_QUOTES, 'UTF-8', true);
}?>"
                required>
            <div id="apellidos-error" class="error-message">Solo se permiten letras y espacios</div>
        </div>
            
            <div class="form-group">
                <label for="nickname">Nickname:</label>
                <input type="text" id="nickname" name="nickname" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['nickname'], ENT_QUOTES, 'UTF-8', true);?>
" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
" required>
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['telefono'], ENT_QUOTES, 'UTF-8', true);?>
" required>
            </div>
            
            <div class="form-group">
                <label for="especialidad">Especialidad:</label>
                <select id="especialidad" name="especialidad" required>
                    <option value="albanileria" <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['especialidad'] == 'albanileria') {?>selected<?php }?>>Albañilería</option>
                    <option value="plomeria" <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['especialidad'] == 'plomeria') {?>selected<?php }?>>Plomería</option>
                    <option value="carpinteria" <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['especialidad'] == 'carpinteria') {?>selected<?php }?>>Carpintería</option>
                    <option value="electricidad" <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['especialidad'] == 'electricidad') {?>selected<?php }?>>Electricidad</option>
                </select>
            </div>
            
            <!-- Sección mejorada para Foto de Perfil -->
            <div class="form-group">
                <label for="foto_perfil">Foto de perfil:</label>
                <div class="file-input-container">
                    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg, image/png, image/gif">
                </div>
                <img id="foto_perfil_preview" class="preview-image" src="#" alt="Vista previa de foto de perfil" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['foto_perfil']) {?>
                    <div class="current-photo">
                        <p>Foto actual:</p>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['foto_perfil'];?>
" alt="Foto de perfil" class="preview-image">
                    </div>
                <?php }?>
            </div>
            
            <!-- Sección para INE Frente -->
            <div class="form-group">
                <label for="ine_frente">INE Frente:</label>
                <div class="file-input-container">
                    <input type="file" id="ine_frente" name="ine_frente" accept="image/jpeg, image/png, image/gif">
                </div>
                <img id="ine_frente_preview" class="preview-image" src="#" alt="Vista previa INE Frente" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['ine_frente']) {?>
                    <div class="current-photo">
                        <p>INE Frente actual:</p>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['ine_frente'];?>
" alt="INE Frente" class="preview-image">
                    </div>
                <?php }?>
            </div>
            
            <!-- Sección para INE Reverso -->
            <div class="form-group">
                <label for="ine_reverso">INE Reverso:</label>
                <div class="file-input-container">
                    <input type="file" id="ine_reverso" name="ine_reverso" accept="image/jpeg, image/png, image/gif">
                </div>
                <img id="ine_reverso_preview" class="preview-image" src="#" alt="Vista previa INE Reverso" style="display:none;">
                <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['ine_reverso']) {?>
                    <div class="current-photo">
                        <p>INE Reverso actual:</p>
                        <img src="<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['ine_reverso'];?>
" alt="INE Reverso" class="preview-image">
                    </div>
                <?php }?>
            </div>
            
            <button type="submit">Guardar cambios</button>
            <a href="afiliados.php">
                <button type="button" class="button-secondary">Cancelar</button>
            </a>
        </form>
    </div>

    
    <?php echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function() {
      // Validación en tiempo real para campos de nombre y apellidos
      const nameFields = ['nombre', 'apellidos'];
      nameFields.forEach(field => {
        const input = document.getElementById(field);
        const error = document.getElementById(`${field}-error`);
        input.addEventListener('input', function() {
          const regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]*$/;
          if (!regex.test(this.value)) {
            this.classList.add('input-error');
            error.style.display = 'block';
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
          } else {
            this.classList.remove('input-error');
            error.style.display = 'none';
          }
        });
      });

      // Función para mostrar vista previa de imágenes
      function mostrarVistaPrevia(input, previewId) {
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            preview.style.display = 'block';
            preview.src = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      // Event listeners para las vistas previas
      document.getElementById('foto_perfil').addEventListener('change', function() {
        mostrarVistaPrevia(this, 'foto_perfil_preview');
      });
      document.getElementById('ine_frente').addEventListener('change', function() {
        mostrarVistaPrevia(this, 'ine_frente_preview');
      });
      document.getElementById('ine_reverso').addEventListener('change', function() {
        mostrarVistaPrevia(this, 'ine_reverso_preview');
      });
    });
    <?php echo '</script'; ?>
>
    
</body>
</html><?php }
}
