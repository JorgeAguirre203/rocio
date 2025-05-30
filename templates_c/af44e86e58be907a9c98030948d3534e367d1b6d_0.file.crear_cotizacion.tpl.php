<?php
/* Smarty version 3.1.39, created on 2025-05-30 12:33:27
  from '/var/www/html/rocio/templates/crear_cotizacion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6839a597c6b715_37437272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af44e86e58be907a9c98030948d3534e367d1b6d' => 
    array (
      0 => '/var/www/html/rocio/templates/crear_cotizacion.tpl',
      1 => 1748608402,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6839a597c6b715_37437272 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cotización</title>
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
            color: #333;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 15px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin: 5px 0 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
            transition: border 0.3s;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 15px;
            padding-right: 30px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4a4a4a;
            box-shadow: 0 0 0 2px rgba(74, 74, 74, 0.1);
        }

        button {
            background-color: #4a4a4a;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #333;
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        .input-hint {
            font-size: 13px;
            color: #777;
            margin-top: 5px;
        }

        .service-option {
            display: flex;
            align-items: center;
            padding: 8px 0;
        }

        .service-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            background-color: #e3f2fd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1976d2;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }
            
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2><?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['id']) {?>Editar Cotización<?php } else { ?>Crear Nueva Cotización<?php }?></h2>
        
        <form method="post">
            <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion_id']->value;?>
">
            <input type="hidden" name="id_cotizacion" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cotizacion']->value['id'])===null||$tmp==='' ? '' : $tmp);?>
">
            
            <div class="form-group">
                <label for="servicio">Servicio:</label>
                <select name="servicio" id="servicio" required>
                    <option value="plomeria" <?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['servicio'] == 'plomeria') {?>selected<?php }?>>
                        <span class="service-option">
                            <span class="service-icon">P</span>
                            Plomería
                        </span>
                    </option>
                    <option value="electricidad" <?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['servicio'] == 'electricidad') {?>selected<?php }?>>
                        <span class="service-option">
                            <span class="service-icon">E</span>
                            Electricidad
                        </span>
                    </option>
                    <option value="carpinteria" <?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['servicio'] == 'carpinteria') {?>selected<?php }?>>
                        <span class="service-option">
                            <span class="service-icon">C</span>
                            Carpintería
                        </span>
                    </option>
                    <option value="albanileria" <?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['servicio'] == 'albanileria') {?>selected<?php }?>>
                        <span class="service-option">
                            <span class="service-icon">A</span>
                            Albañilería
                        </span>
                    </option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="horas">Horas estimadas:</label>
                <input type="number" step="0.1" min="0.1" name="horas" id="horas" 
                       value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cotizacion']->value['horas'])===null||$tmp==='' ? '' : $tmp);?>
" required>
                <div class="input-hint">Ejemplo: 2.5 (para 2 horas y media)</div>
            </div>
            
            <div class="form-group">
                <label for="precio_hora">Precio por hora ($):</label>
                <input type="number" step="0.01" min="0.01" name="precio_hora" id="precio_hora" 
                       value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['cotizacion']->value['precio_hora'])===null||$tmp==='' ? '' : $tmp);?>
" required>
                <div class="input-hint">Ingrese el precio por hora en pesos mexicanos</div>
            </div>
            
            <div class="form-group">
                <label for="detalles">Detalles del servicio:</label>
                <textarea name="detalles" id="detalles"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['cotizacion']->value['detalles'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
                <div class="input-hint">Describa los detalles del trabajo a realizar</div>
            </div>
            
            <button type="submit"><?php if ($_smarty_tpl->tpl_vars['cotizacion']->value['id']) {?>Actualizar cotización<?php } else { ?>Guardar y continuar a pago<?php }?></button>
        </form>
    </div>

    <?php echo '<script'; ?>
>
        // Mejorar la experiencia del formulario
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                // Validación en tiempo real para campos numéricos
                if (input.type === 'number') {
                    input.addEventListener('input', function() {
                        if (this.value < 0) this.value = '';
                    });
                }
                
                // Efecto al enfocar
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('label').style.color = '#2c3e50';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('label').style.color = '#555';
                });
            });
        });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
