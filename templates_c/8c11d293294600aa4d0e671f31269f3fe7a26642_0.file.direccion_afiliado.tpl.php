<?php
/* Smarty version 3.1.39, created on 2025-10-28 01:01:22
  from '/var/www/html/rocio/templates/direccion_afiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_690015e2a88814_07652696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c11d293294600aa4d0e671f31269f3fe7a26642' => 
    array (
      0 => '/var/www/html/rocio/templates/direccion_afiliado.tpl',
      1 => 1761613261,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690015e2a88814_07652696 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar dirección (Afiliado)</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #4a90e2;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #4a90e2;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #357abD;
        }

        .error {
            border-color: #e74c3c !important;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.8em;
            margin-top: -15px;
            margin-bottom: 15px;
            display: none;
        }

        .button-secondary {
            background-color: #95a5a6;
        }

        .button-secondary:hover {
            background-color: #7f8c8d;
        }

        small {
            display: block;
            font-size: 0.8em;
            color: #7f8c8d;
            margin-top: -15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Dirección del Afiliado</h2>
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <?php echo '<script'; ?>
>
                alert('<?php echo strtr($_smarty_tpl->tpl_vars['mensaje']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
                <?php if ($_smarty_tpl->tpl_vars['mensaje']->value == 'Dirección guardada correctamente') {?>
                    window.location.href = 'dashboard_servicios.php';
                <?php }?>
            <?php echo '</script'; ?>
>
        <?php }?>
        
        <form method="post" id="direccionForm" autocomplete="off">
            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['calle'])===null||$tmp==='' ? '' : $tmp);?>
" required>
                <span class="error-message" id="calle-error">Solo se permiten letras y espacios</span>
            </div>
            
            <div class="form-group">
                <label for="numero_casa">Número de casa (opcional):</label>
                <input type="text" id="numero_casa" name="numero_casa" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['numero_casa'])===null||$tmp==='' ? '' : $tmp);?>
">
                <span class="error-message" id="numero-error">Solo se permiten números y guiones</span>
            </div>
            
            <div class="form-group">
                <label for="codigo_postal">Código postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['codigo_postal'])===null||$tmp==='' ? '' : $tmp);?>
" maxlength="5" required>
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
                <textarea id="indicaciones" name="indicaciones" required><?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['indicaciones'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
                <small>Ejemplo: Casa color azul, portón rojo, coche blanco estacionado</small>
            </div>
            
            <button type="submit">Guardar dirección</button>
            <a href="dashboard_servicios.php">
                <button type="button" class="button-secondary">Cancelar y salir</button>
            </a>
        </form>
    </div>
    <?php echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('direccionForm');
        const inputs = {
            calle: document.getElementById('calle'),
            numero_casa: document.getElementById('numero_casa'),
            codigo_postal: document.getElementById('codigo_postal'),
            indicaciones: document.getElementById('indicaciones')
        };

        const regex = {
            soloLetras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
            soloNumeros: /^[0-9\-]*$/
        };

        // Validación en tiempo real para calle
        inputs.calle.addEventListener('input', function() {
            let original = this.value;
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (original !== this.value) {
                const calleError = document.getElementById('calle-error');
                calleError.textContent = 'Solo se permiten letras y espacios';
                calleError.style.display = 'block';
                this.classList.add('error');
            } else {
                const calleError = document.getElementById('calle-error');
                calleError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        // Validación en tiempo real para número de casa (solo números)
        inputs.numero_casa.addEventListener('input', function() {
            let original = this.value;
            // Solo permite números
            this.value = this.value.replace(/\D/g, '');
            if (original !== this.value) {
                const numeroError = document.getElementById('numero-error');
                numeroError.textContent = 'Solo se permiten números';
                numeroError.style.display = 'block';
                this.classList.add('error');
            } else {
                const numeroError = document.getElementById('numero-error');
                numeroError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        // Validación en tiempo real para código postal
        const cpError = document.getElementById('cp-error');
        inputs.codigo_postal.addEventListener('input', function() {
            let original = this.value;
            // Solo permite números y máximo 5 caracteres
            this.value = this.value.replace(/\D/g, '').slice(0, 5);

            if (original !== this.value) {
                cpError.textContent = 'Solo se permiten 5 caracteres numéricos';
                cpError.style.display = 'block';
                this.classList.add('error');
            } else {
                cpError.style.display = 'none';
                this.classList.remove('error');
            }
        });

        function validateField(field, regex, errorId) {
            const errorElement = document.getElementById(errorId);
            const value = field.value.trim();

            if (value && !regex.test(value)) {
                field.classList.add('error');
                errorElement.style.display = 'block';
                return false;
            } else {
                field.classList.remove('error');
                errorElement.style.display = 'none';
                return true;
            }
        }

        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validar campos obligatorios
            if (!inputs.calle.value.trim()) {
                inputs.calle.classList.add('error');
                isValid = false;
            }
            if (!inputs.indicaciones.value.trim()) {
                inputs.indicaciones.classList.add('error');
                isValid = false;
            }

            // Validar formato de campos
            if (!validateField(inputs.calle, regex.soloLetras, 'calle-error')) isValid = false;
            if (!validateField(inputs.numero_casa, regex.soloNumeros, 'numero-error')) isValid = false;

            // Validar código postal (exactamente 5 dígitos)
            if (inputs.codigo_postal.value.length !== 5) {
                inputs.codigo_postal.classList.add('error');
                cpError.textContent = 'Solo se permiten 5 caracteres numéricos';
                cpError.style.display = 'block';
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                alert('Por favor complete correctamente todos los campos obligatorios.');
            }
        });
    });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
