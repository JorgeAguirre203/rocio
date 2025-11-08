<!DOCTYPE html>
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
        <h2>{if $cotizacion.id|default:''}Editar Cotización{else}Crear Nueva Cotización{/if}</h2>
        {* Mostrar desglose automático de cotización *}
        {if $servicios_solicitados|@count > 0}
            <div class="form-group">
                <label>Servicios solicitados:</label>
                <ul>
                    {foreach $servicios_solicitados as $serv}
                        <li>{$serv.nombre_servicio} - $ {$serv.precio}</li>
                    {/foreach}
                </ul>
                <p><strong>Total servicios:</strong> $ {$total_servicios}</p>
            </div>
        {/if}
        {if $distancia_km > 0}
            <div class="form-group">
                <label>Distancia estimada:</label>
                <p>{$distancia_km} km x $20 = <strong>$ {$total_distancia}</strong></p>
            </div>
        {/if}
        {if $total_automatico > 0}
            <div class="form-group">
                <label>Total sugerido:</label>
                <p style="font-size:1.2em;"><strong>$ {$total_automatico}</strong></p>
            </div>
        {/if}
        
        <form method="post">
            <input type="hidden" name="peticion_id" value="{$peticion_id}">
            <input type="hidden" name="id_cotizacion" value="{$cotizacion.id|default:''}">
            
            <div class="form-group">
                <label for="servicio">Servicio:</label>
                <p style="margin:0 0 8px 0;"><strong>{$servicio_afiliado|escape}</strong></p>
                <input type="hidden" name="servicio" value="{$servicio_afiliado|escape}">
            </div>
            
            {* SOLO SE MUESTRAN SI ES POR HORA *}
            {if $es_por_hora}
                <div class="form-group">
                    <label for="horas">Horas estimadas:</label>
                    <input type="number" step="0.1" min="0.1" name="horas" id="horas" 
                        value="{$cotizacion.horas|default:''}" required>
                    <div class="input-hint">Ejemplo: 2.5 (para 2 horas y media)</div>
                </div>
                <div class="form-group">
                    <label for="precio_hora">Precio por hora ($):</label>
                    <input type="number" step="0.01" min="0.01" name="precio_hora" id="precio_hora" 
                        value="{$precio_hora_especialidad|default:$cotizacion.precio_hora}" readonly>
                    <div class="input-hint">Precio por hora según especialidad</div>
                </div>
                <div class="form-group">
                    <label for="detalles">Detalles del servicio:</label>
                    <textarea name="detalles" id="detalles">{$cotizacion.detalles|default:''}</textarea>
                    <div class="input-hint">Describa los detalles del trabajo a realizar</div>
                </div>
            {/if}
            
            <button type="submit">{if $cotizacion.id|default:''}Actualizar cotización{else}Guardar y continuar a pago{/if}</button>
        </form>
    </div>

    <script>
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
    </script>
</body>
</html>