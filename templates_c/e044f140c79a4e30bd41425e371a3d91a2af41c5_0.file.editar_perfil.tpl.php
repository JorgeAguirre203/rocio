<?php
/* Smarty version 3.1.39, created on 2025-05-30 15:07:52
  from '/var/www/html/rocio/templates/editar_perfil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6839c9c8aaf484_53766119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e044f140c79a4e30bd41425e371a3d91a2af41c5' => 
    array (
      0 => '/var/www/html/rocio/templates/editar_perfil.tpl',
      1 => 1748617669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6839c9c8aaf484_53766119 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
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
    <?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
    <?php echo '<script'; ?>
>
        alert('Datos actualizados correctamente.');
        window.location.href='dashboard_servicios.php';
    <?php echo '</script'; ?>
>
    <?php }?>
</head>
<body>
    <div class="form-container">
        <h2><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h2>
        <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
            <div class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
        <?php }?>
        
        <form method="post" id="editarPerfilForm" autocomplete="off">
            <label>Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['nombre_actual']->value;?>
" required>
            <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>

            <label>Nickname:</label>
            <input type="text" name="nickname" value="<?php echo $_smarty_tpl->tpl_vars['nickname_actual']->value;?>
" required>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>

    
    <?php echo '<script'; ?>
>
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
    <?php echo '</script'; ?>
>
    
</body>
</html><?php }
}
