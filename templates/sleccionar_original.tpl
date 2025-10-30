<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Servicio</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <style>
        /* === DISEÑO MEJORADO Y MÁS AMIGABLE === */
        
        .container {
            width: 90%;
            max-width: 950px;
            margin: 40px auto;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #e8f4ff;
        }
        
        h3 {
            color: #1e40af;
            border-left: 6px solid #3b82f6;
            padding: 15px 20px;
            margin: 40px 0 25px 0;
            background: linear-gradient(90deg, #f0f9ff, #ffffff);
            border-radius: 0 12px 12px 0;
            font-size: 1.4em;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        }
        
        .servicios-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 25px 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
            background: white;
            border: 1px solid #e2e8f0;
        }
        
        .servicios-table th {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            color: #fff;
            padding: 18px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1em;
            border: none;
        }
        
        .servicios-table th:first-child {
            border-radius: 16px 0 0 0;
        }
        
        .servicios-table th:last-child {
            border-radius: 0 16px 0 0;
        }
        
        .servicios-table td {
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .servicios-table tr:nth-child(even) {
            background: #f8fafc;
        }

        .servicios-table tr:hover {
            background: linear-gradient(90deg, #f0f9ff, #ffffff);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .servicios-table tr:hover td {
            background: transparent;
        }

        .servicios-table tr:last-child td:first-child {
            border-radius: 0 0 0 16px;
        }

        .servicios-table tr:last-child td:last-child {
            border-radius: 0 0 16px 0;
        }

        .mensaje.success {
            background: linear-gradient(135deg, #dbeafe, #e0f2fe);
            border-left: 6px solid #3b82f6;
            color: #1e3a8a;
            font-weight: 500;
            padding: 20px;
            border-radius: 12px;
            margin: 30px 0;
            font-size: 1.1em;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .checkbox-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            cursor: pointer;
            position: relative;
            transition: transform 0.2s ease;
        }

        .checkbox-container:hover {
            transform: scale(1.1);
        }

        .checkmark {
            width: 26px;
            height: 26px;
            background: #f8fafc;
            border: 3px solid #cbd5e1;
            border-radius: 8px;
            display: inline-block;
            position: relative;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .checkbox-container input:checked + .checkmark {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            border-color: #3b82f6;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked + .checkmark:after {
            display: block;
            animation: checkmarkPop 0.3s ease;
        }

        .checkbox-container .checkmark:after {
            left: 7px;
            top: 3px;
            width: 8px;
            height: 14px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        .checkbox-container input[type="checkbox"] {
            display: none;  /* ⭐ ESTA LÍNEA OCULTA EL CHECKBOX NATIVO */
        }

        @keyframes checkmarkPop {
            0% { transform: scale(0.8); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1.1); }
        }

        .nota {
            margin: 25px 0;
            color: #1e40af;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            padding: 20px;
            border-radius: 14px;
            font-size: 1em;
            border: 1px solid #bfdbfe;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.08);
        }

        .nota strong {
            color: #1e3a8a;
            font-size: 1.1em;
        }
    
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
        }

        .btn-home-inicio {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #000000;
            padding: 24px 50px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            color: white;
            font-size: 2.2em;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .btn-home-inicio:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .sidebar {
            z-index: 9999;
        }

        .botones-container {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        /* Estilos para el texto de los servicios */
        .servicios-table strong {
            color: #1e3a8a;
            font-size: 1.1em;
        }

        .servicios-table td {
            color: #475569;
            font-size: 1em;
        }

        .servicios-table td:nth-child(3) {
            color: #059669;
            font-weight: 700;
            font-size: 1.2em;
        }

        /* Mejora visual para el checkbox de "cobro por hora" */
        .cobro-hora-container {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: linear-gradient(135deg, #f8fafc, #ffffff);
            border-radius: 14px;
            margin: 20px 0;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .cobro-hora-container:hover {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #f0f9ff, #ffffff);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.1);
        }

        .cobro-hora-text {
            font-size: 1.1em;
            font-weight: 600;
            color: #1e3a8a;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 25px;
                margin: 20px auto;
            }
            
            .servicios-table {
                font-size: 0.9em;
            }
            
            .botones-container {
                flex-direction: column;
            }
            
            .nav-btn {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Seleccionar Servicio</h1>
        <a href="index.php" class="btn-home-inicio">
            <span>🏠</span>
            Inicio
        </a>
    </div>

    <!-- Sidebar de perfil -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Nickname:</strong> {$nickname}</p>
            <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
            <a href="ELiminar_perfiles.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
            <a href="direccion_usuario.php" class="nav-btn">Agregar direccion</a>
            <a href="logout.php" class="nav-btn">Cerrar sesión</a>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <script>
    // FUNCIONES UNIFICADAS PARA SIDEBAR
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        if (sidebar.style.width === "250px") {
            sidebar.style.width = "0";
            overlay.style.display = "none";
        } else {
            sidebar.style.width = "250px";
            overlay.style.display = "block";
        }
    }

    function closeSidebar() {
        document.getElementById("sidebar").style.width = "0";
        document.getElementById("overlay").style.display = "none";
    }

    function confirmarEliminacion() {
        return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
    }

    // Cerrar sidebar al hacer clic fuera
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            
            if (event.target === overlay) {
                closeSidebar();
            }
        });
        
        // Cerrar sidebar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeSidebar();
            }
        });
    });
    </script>

    <div class="container">
        <h2>Selecciona el tipo de trabajo para contratar a 
            <strong>{$afiliado.nombre} {$afiliado.apellido_paterno} {$afiliado.apellido_materno}</strong>
        </h2>

        <form method="post">
            {if $servicios|@count > 0}
                <h3>✨ Servicios y precios fijos ({$especialidad|capitalize})</h3>
                    <table class="servicios-table">
                        <tr>
                            <th>Servicio</th>
                            <th>Descripción</th>
                            <th>Precio fijo</th>
                            <th>Seleccionar</th>
                        </tr>
                        {foreach $servicios as $servicio}
                            <tr>
                                <td><strong>{$servicio.nombre_servicio}</strong></td>
                                <td>{$servicio.descripcion}</td>
                                <td><strong>${$servicio.precio} MXN</strong></td>
                                <td style="text-align:center;">
                                    <label class="checkbox-container">
                                        <input type="checkbox" name="servicios_seleccionados[]" value="{$servicio.id}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                        {/foreach}
                    </table>
            {/if}

            <h3>🎯 Otro servicio (cobro por hora)</h3>
            <div class="cobro-hora-container">
                <label class="checkbox-container">
                    <input type="checkbox" name="tipo_cobro" value="por_hora">
                    <span class="checkmark"></span>
                </label>
                <span class="cobro-hora-text">Solicitar cotización por hora</span>
            </div>

            <div class="nota">
                <strong>💡 Información importante:</strong> También se cobrará la distancia que recorrerá el afiliado y la comisión de la aplicación. Todos los precios incluyen IVA.
            </div>

            <div class="botones-container">
                <button type="submit" class="nav-btn">✅ Confirmar contratación</button>
                <a href="dashboard_servicios.php" class="nav-btn cancelar">❌ Cancelar contratación</a>
            </div>
        </form>

        {if $mensaje}
            <div class="mensaje success">{$mensaje}</div>
        {/if}
    </div>
</body>
</html>