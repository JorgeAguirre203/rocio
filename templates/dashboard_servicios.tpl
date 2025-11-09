<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title|escape:'html'}</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Estilos CSS proporcionados */
        .affiliate-page {
          min-height: 100vh;
          background: linear-gradient(to bottom right, #f8fafc, #e2e8f0);
        }
        .affiliate-content {
          margin-left: 0;
          transition: margin-left 0.3s ease;
        }
        @media (min-width: 1024px) {
          .affiliate-content {
            margin-left: 256px;
          }
        }
        /* Header */
        .affiliate-header {
          background-color: #0f172a;
          color: white;
          padding: 16px 20px;
          display: flex;
          justify-content: space-between;
          align-items: center;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header-left {
          display: flex;
          align-items: center;
          gap: 12px;
        }
        .menu-toggle {
          background: none;
          border: none;
          color: white;
          cursor: pointer;
          padding: 8px;
          border-radius: 6px;
          transition: background-color 0.2s;
        }
        .menu-toggle:hover {
          background-color: rgba(255, 255, 255, 0.1);
        }
        @media (min-width: 1024px) {
          .menu-toggle {
            display: none;
          }
        }
        .icon-menu {
          width: 24px;
          height: 24px;
        }
        .affiliate-header h1 {
          margin: 0;
          font-size: 18px;
        }
        @media (min-width: 768px) {
          .affiliate-header h1 {
            font-size: 20px;
          }
        }
        .home-btn {
          display: flex;
          align-items: center;
          gap: 8px;
          background-color: rgba(255, 255, 255, 0.1);
          border: none;
          color: white;
          padding: 8px 16px;
          border-radius: 6px;
          cursor: pointer;
          transition: background-color 0.2s;
        }
        .home-btn:hover {
          background-color: rgba(255, 255, 255, 0.2);
        }
        .icon-sm {
          width: 18px;
          height: 18px;
        }
        /* Container */
        .affiliate-container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 24px 16px;
        }
        @media (min-width: 768px) {
          .affiliate-container {
            padding: 32px 24px;
          }
        }
        /* Profile Card */
        .profile-card {
          background-color: white;
          border-radius: 16px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
          padding: 32px 24px;
          text-align: center;
          margin-bottom: 32px;
        }
        .profile-avatar-large {
          width: 120px;
          height: 120px;
          background: linear-gradient(135deg, #2563eb, #1d4ed8);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          margin: 0 auto 24px;
          box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .avatar-icon {
          width: 60px;
          height: 60px;
          color: white;
        }
        .profile-name {
          color: #0f172a;
          margin-bottom: 24px;
          text-transform: capitalize;
        }
        .profile-details {
          display: flex;
          flex-direction: column;
          gap: 16px;
          max-width: 500px;
          margin: 0 auto;
        }
        .detail-item {
          display: flex;
          align-items: center;
          gap: 12px;
          padding: 12px;
          background-color: #f8fafc;
          border-radius: 8px;
          text-align: left;
        }
        .detail-icon {
          width: 20px;
          height: 20px;
          color: #2563eb;
          flex-shrink: 0;
        }
        .detail-item > div {
          display: flex;
          flex-direction: column;
          gap: 2px;
        }
        .detail-label {
          font-size: 13px;
          color: #64748b;
        }
        .detail-value {
          color: #0f172a;
          font-weight: 500;
        }
        /* Requests Section */
        .requests-section {
          margin-bottom: 32px;
        }
        .section-title {
          color: #0f172a;
          margin-bottom: 20px;
          padding-bottom: 12px;
          border-bottom: 2px solid #e2e8f0;
        }
        /* Empty State */
        .empty-state {
          background-color: white;
          border-radius: 12px;
          padding: 48px 24px;
          text-align: center;
          border: 2px dashed #e2e8f0;
        }
        .empty-icon {
          font-size: 48px;
          margin-bottom: 16px;
        }
        .empty-state p {
          color: #64748b;
          margin: 0;
        }
        /* Clients Grid */
        .clients-grid {
          display: grid;
          gap: 20px;
          grid-template-columns: 1fr;
        }
        @media (min-width: 768px) {
          .clients-grid {
            grid-template-columns: repeat(2, 1fr);
          }
        }
        @media (min-width: 1200px) {
          .clients-grid {
            grid-template-columns: repeat(2, 1fr);
          }
        }
        /* Client Card */
        .client-card {
          background-color: white;
          border-radius: 12px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
          padding: 20px;
          transition: transform 0.2s, box-shadow 0.2s;
        }
        .client-card:hover {
          transform: translateY(-2px);
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
        .client-header {
          display: flex;
          align-items: center;
          gap: 12px;
          margin-bottom: 16px;
          padding-bottom: 16px;
          border-bottom: 1px solid #f1f5f9;
        }
        .client-avatar {
          width: 48px;
          height: 48px;
          background: linear-gradient(135deg, #8b5cf6, #6366f1);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-shrink: 0;
        }
        .client-avatar-icon {
          width: 24px;
          height: 24px;
          color: white;
        }
        .client-name {
          color: #0f172a;
          margin: 0;
          font-size: 16px;
          text-transform: capitalize;
        }
        .client-nickname {
          color: #64748b;
          margin: 4px 0 0;
          font-size: 14px;
        }
        /* Client Info */
        .client-info {
          display: flex;
          flex-direction: column;
          gap: 12px;
          margin-bottom: 16px;
        }
        .info-row {
          display: flex;
          align-items: flex-start;
          gap: 10px;
          font-size: 14px;
          color: #475569;
        }
        .info-icon {
          width: 16px;
          height: 16px;
          color: #64748b;
          flex-shrink: 0;
          margin-top: 2px;
        }
        .indications {
          background-color: #fef3c7;
          padding: 10px;
          border-radius: 6px;
          border-left: 3px solid #f59e0b;
        }
        .indications .info-icon {
          color: #f59e0b;
        }
        .indications > div {
          display: flex;
          flex-direction: column;
          gap: 4px;
        }
        .indications-label {
          font-weight: 600;
          color: #92400e;
          font-style: italic;
          font-size: 13px;
        }
        .indications-text {
          color: #78350f;
        }
        
        /* Client Actions */
        
        .client-actions {
          display: flex;
          flex-wrap: wrap;
          gap: 8px;
          margin-top: 16px;
          margin-bottom: 16px;
          padding-top: 16px;
          border-top: 1px solid #f1f5f9;
        }
        
        .action-btn {
          display: flex;
          align-items: center;
          gap: 6px;
          padding: 8px 14px;
          border-radius: 6px;
          border: none;
          cursor: pointer;
          transition: all 0.2s;
          font-size: 13px;
          font-weight: 500;
          flex: none;
          min-width: fit-content;
          justify-content: center;
        }
        
        @media (min-width: 640px) {
          .action-btn {
            flex: none;
          }
        }
        
        .btn-icon {
          width: 16px;
          height: 16px;
        }
        
        .btn-primary {
          background-color: #10b981;
          color: white;
        }
        .btn-primary:hover {
          background-color: #059669;
        }
        .btn-secondary {
          background-color: #3b82f6;
          color: white;
        }
        .btn-secondary:hover {
          background-color: #2563eb;
        }
        .btn-outline {
          background-color: white;
          border: 1px solid #e2e8f0;
          color: #0f172a;
        }
        .btn-outline:hover {
          background-color: #f8fafc;
          border-color: #cbd5e1;
        }
        
        /* Estilos existentes que se mantienen */

        .sidebar-filtros {
            position: fixed;
            right: 0;
            top: 65px;
            width: 300px;
            height: calc(100% - 65px);
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.5);
            z-index: 998;
            overflow-y: auto;
        }
        /* Filtros */
        .filtro-bloque {
            margin-bottom: 15px;
        }
        .filtro-bloque h4 {
            margin-bottom: 10px;
            color: #333;
        }
        /* Estilos para los servicios/afiliados */
        .servicios {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            margin-right: 320px;
        }
        .servicio {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            width: 280px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .servicio:hover {
            transform: translateY(-5px);
        }
        .servicio img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .servicio h2 {
            margin: 0 0 10px;
            color: #2c3e50;
        }
        .servicio button {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }
        .detalles {
            display: none;
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        .no-resultados {
            text-align: center;
            padding: 40px;
            color: #666;
            width: 100%;
        }
        /* estilo de la bara lateral de la campanita*/
        /* Campanita de notificaciones */
        .notificaciones-icono {
            position: relative;
            cursor: pointer;
            font-size: 28px;
            display: inline-block;
        }
        .bell {
            font-size: 28px;
            color: #3498db;
        }
        .noti-badge {
            background: #e74c3c;
            color: #fff;
            border-radius: 50%;
            font-size: 12px;
            padding: 3px 6px;
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
        .chat-badge {
            background: #e74c3c;
            color: #fff;
            border-radius: 50%;
            font-size: 11px;
            padding: 2px 6px;
            margin-left: 5px;
            position: relative;
            top: -2px;
        }
        /* Barra lateral de notificaciones */
        .notificaciones-barra {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 8px rgba(0,0,0,0.15);
            z-index: 1200;
            transition: right 0.4s;
            display: flex;
            flex-direction: column;
        }
        .notificaciones-barra.abierta {
            right: 0;
        }
        .noti-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.2);
            z-index: 1199;
        }
        .notificaciones-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px 10px 20px;
            border-bottom: 1px solid #eee;
        }
        .close-noti {
            background: none;
            border: none;
            font-size: 28px;
            color: #888;
            cursor: pointer;
        }
        .notificaciones-lista {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }
        /* estilo para que no se vea e boton de inicio sobre el de la campana de notificacioens*/
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            right: 30px;
            top: 10px;
        }
        .notificaciones-icono {
            position: relative;
            top: 0;
            right: 0;
        }
        .servicio-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            text-decoration: none;
        }
        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
        
        /* Estilos para la ventana de chat flotante */
        #chat-container {
          position: fixed;
          bottom: 0;
          right: 20px;
          width: 320px;
          max-height: 450px;
          border: 1px solid #ccc;
          background: #fff;
          box-shadow: 0 0 10px rgba(0,0,0,0.2);
          display: none; /* Oculto por defecto */
          flex-direction: column;
          font-family: Arial, sans-serif;
          border-radius: 10px 10px 0 0;
          z-index: 1500;
        }
        #chat-header {
          background: #0078ff;
          color: white;
          padding: 12px;
          cursor: pointer;
          border-radius: 10px 10px 0 0;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        #chat-header button { background: none; border: none; color: white; font-size: 20px; cursor: pointer; }
        #mensajes { flex: 1; padding: 10px; overflow-y: auto; background: #f1f0f0; display: flex; flex-direction: column; }
        #formChat { display: flex; border-top: 1px solid #ccc; }
        #formChat input { flex: 1; padding: 10px; border: none; }
        #formChat button { padding: 10px 15px; border: none; background: #0078ff; color: white; cursor: pointer; }
        .mensaje-mio { background: #dcf8c6; padding: 8px 12px; border-radius: 15px 15px 0 15px; margin-bottom: 8px; max-width: 80%; align-self: flex-end; word-wrap: break-word; }
        .mensaje-otro { background: #fff; padding: 8px 12px; border-radius: 15px 15px 15px 0; margin-bottom: 8px; max-width: 80%; align-self: flex-start; word-wrap: break-word; }
        .hora { font-size: 0.7em; color: gray; margin-left: 8px; display: block; text-align: right; }
        
        /* Estilos para los botones de navegación en el sidebar */
        .nav-btn {
            display: block;
            padding: 10px 15px;
            margin: 8px 0;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.2s;
        }
        .nav-btn:hover {
            background-color: #1d4ed8;
        }
        
        /* Mejoras para el diseño de afiliados */
        .affiliate-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            max-width: 300px;
        }
        .affiliate-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
        .affiliate-header-card {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        .affiliate-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }
        .affiliate-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .affiliate-avatar-icon {
            width: 24px;
            height: 24px;
            color: white;
        }
        .affiliate-name {
            color: #0f172a;
            margin: 0;
            font-size: 16px;
            text-transform: capitalize;
        }
        .affiliate-nickname {
            color: #64748b;
            margin: 4px 0 0;
            font-size: 14px;
        }
        .affiliate-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 16px;
        }
        .affiliate-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .star-filled {
            color: gold;
        }
        .star-empty {
            color: #ccc;
        }
        .affiliate-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px; /* Oculto fuera de la pantalla */
            width: 250px;  /* Ancho fijo */
            height: 100%;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            z-index: 999; /* Barra lateral deslizante en primer plano */
        }

        .sidebar-content {
            position: relative;
            padding: 20px;
            color: #fff;
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
    </style>

</head>
<body>
    {if $direccion_incompleta}
        <div style="position:fixed;top:10px;left:10px;z-index:1000;background:#ffeeba;color:#856404;padding:10px 20px;border-radius:5px;">
            <strong>¡Atención!</strong> Primero agrega tu dirección antes de contratar un afiliado.
            <a href="direccion_usuario.php" style="color:#007bff;text-decoration:underline;">Agregar dirección</a>
        </div>
    {/if}

    <!-- Header -->
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Afiliados Verificados</h1>
        <div class="header-actions">
            <a href="index.php" class="btn-home-inicio">
                <span>🏠</span>
                Inicio
            </a>
            <!-- Campanita de notificaciones -->
            <div class="notificaciones-icono" onclick="toggleNotificaciones()" title="Notificaciones">
                <span class="bell">&#128276;</span>
                <span class="noti-badge" id="noti-badge" {if $noti_count == 0}style="display:none;"{/if}>{$noti_count}</span>
            </div>
        </div>
    </div>

    <!-- Barra lateral de notificaciones -->
    <div id="notificaciones-barra" class="notificaciones-barra">
        <div class="notificaciones-header">
            <h2>Notificaciones</h2>
            <button onclick="closeNotificaciones()" class="close-noti">&times;</button>
        </div>
        <div class="notificaciones-lista" id="notificaciones-lista">
            {if $noti_count > 0}
                <ul>
                {foreach $notificaciones as $noti}
                    <li>
                        {$noti.mensaje nofilter}
                        <form method="post" action="eliminar_notificacion.php" style="display:inline;">
                            <input type="hidden" name="id_notificacion" value="{$noti.id}">
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;" title="Eliminar notificación">&#10006;</button>
                        </form>
                    </li>
                {/foreach}
                </ul>
            {else}
                <p>No tienes notificaciones.</p>
            {/if}
        </div>
    </div>
    <div id="noti-overlay" class="noti-overlay" onclick="closeNotificaciones()"></div>

    <!-- Sidebar de perfil -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Nickname:</strong> {$nickname}</p>
            <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
            <a href="ELiminar_perfiles.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
            <a href="direccion_usuario.php" class="nav-btn">Agregar dirección</a>
            <a href="logout.php" class="nav-btn">Cerrar sesión</a>
        </div>
    </div>
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- Sidebar de filtros -->
    <div class="sidebar-filtros">
        <h3>Filtrar afiliados</h3>
        
        <div class="filtro-bloque">
            <h4>Especialidad</h4>
            <ul>
                {foreach $categorias as $categoria}
                <li>
                    <input type="checkbox" id="cat_{$categoria.id|escape:'html'}" 
                           class="filtro-categoria"
                           data-categoria="{$categoria.id|escape:'html'}" 
                           {if $categoria.checked}checked{/if}>
                    <label for="cat_{$categoria.id|escape:'html'}">{$categoria.nombre|escape:'html'}</label>
                </li>
                {/foreach}
            </ul>
        </div>
        
        <div class="filtro-bloque">
            <h4>Calificación</h4>
            <select id="filtro-estrellas" class="filtro-select">
                {html_options options=$opciones_estrellas}
            </select>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="affiliate-container">
        <main class="servicios">
            {if count($servicios) > 0}
            <div class="clients-grid">
                {foreach $servicios as $servicio}
                <div class="client-card"
                     data-estrellas="{$servicio.estrellas|escape:'html'}"
                     data-precio="{$servicio.precio|escape:'html'}"
                     data-disponibilidad="{$servicio.disponibilidad|escape:'html'}"
                     data-especialidad="{$servicio.especialidad|escape:'html'}">
                    <div class="client-header">
                        <div class="client-avatar" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                            <img src="{$servicio.foto_perfil}" alt="Foto" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                        </div>
                        <div>
                            <h4 class="client-name">{$servicio.nombre|escape:'html'}</h4>
                            <p class="client-nickname">{$servicio.nickname|escape:'html'}</p>
                        </div>
                    </div>
                    <div class="client-info">
                        <div class="info-row">
                            <i class="fas fa-briefcase info-icon"></i>
                            <span><strong>Especialidad:</strong> {$servicio.especialidad|escape:'html'}</span>
                        </div>
                        <div class="info-row">
                            <i class="fas fa-star info-icon" style="color: #f59e0b;"></i>
                            <span>
                                <strong>Calificación:</strong> {$servicio.estrellas} / 5
                            </span>
                        </div>
                    </div>
                    <div class="client-actions">
                        <a href="seleccionar_servicio.php?id_afiliado={$servicio.id}&id_usuario={$id_usuario}" class="action-btn btn-primary">
                            <i class="fas fa-handshake btn-icon"></i>
                            Contratar
                        </a>
                        <button class="action-btn btn-secondary"
                                onclick="abrirChat({$smarty.session.usuario.id}, {$servicio.id}, '{$servicio.nombre|escape:'javascript'}', 0)">
                            <i class="fas fa-comments btn-icon"></i>
                            Chatear
                            {if $servicio.unread_messages > 0}<span class="chat-badge">{$servicio.unread_messages}</span>{/if}
                        </button>
                    </div>
                </div>
                {/foreach}
            </div>
        {else}
            <div class="no-resultados">
                <p>No hay afiliados verificados disponibles</p>
            </div>
        {/if}
        </main>
    </div>

    <!-- Chat Container -->
    <div id="chat-container">
      <div id="chat-header">
        <span id="chat-con-nombre">Chat</span>
        <button onclick="cerrarChat()">×</button>
      </div>
      <div id="mensajes"></div>
      <form id="formChat">
        <input type="hidden" id="remitente_id">
        <input type="hidden" id="receptor_id">
        <input type="hidden" id="remitente_es_afiliado">
        <input type="text" id="mensaje" placeholder="Escribe un mensaje..." required autocomplete="off">
        <button type="submit">Enviar</button>
      </form>
    </div>

    <!-- JavaScript -->
    <script>
        // Función de confirmación para eliminar cuenta
        function confirmarEliminacion() {
            return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
        }

        // Control de sidebars
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-250px";
                overlay.style.display = "none";
            } else {
                sidebar.style.left = "0";
                overlay.style.display = "block";
            }
        }
        
        function closeSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.style.left = "-250px";
            document.getElementById("overlay").style.display = "none";
        }
        
        // Mostrar/ocultar detalles
        function mostrarDetalles(id) {
            const detalles = document.getElementById(id + '_detalles');
            if (detalles) {
                detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
            }
        }
        
        // Sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar eventos para los filtros
            document.querySelectorAll('.filtro-categoria').forEach(checkbox => {
                checkbox.addEventListener('change', aplicarFiltros);
            });
            
            document.getElementById('filtro-estrellas').addEventListener('change', aplicarFiltros);
        });
        
        function aplicarFiltros() {
            const categoriasActivas = Array.from(document.querySelectorAll('.filtro-categoria:checked'))
                .map(cb => cb.dataset.categoria);
            const estrellasMin = parseInt(document.getElementById('filtro-estrellas').value);
            
            document.querySelectorAll('.client-card').forEach(servicio => {
                const especialidad = servicio.dataset.especialidad;
                const estrellas = parseInt(servicio.dataset.estrellas);
                
                const cumpleCategoria = categoriasActivas.length === 0 || categoriasActivas.includes(especialidad);
                const cumpleEstrellas = estrellas >= estrellasMin;
                
                servicio.style.display = (cumpleCategoria && cumpleEstrellas) 
                    ? 'block' : 'none';
            });
        }

        // Notificaciones: abrir/cerrar barra lateral
        function toggleNotificaciones() {
            document.getElementById('notificaciones-barra').classList.toggle('abierta');
            document.getElementById('noti-overlay').style.display = 
                document.getElementById('notificaciones-barra').classList.contains('abierta') ? 'block' : 'none';
        }
        function closeNotificaciones() {
            document.getElementById('notificaciones-barra').classList.remove('abierta');
            document.getElementById('noti-overlay').style.display = 'none';
        }

        // Funciones del chat
        {literal}
        let chatInterval;
        function abrirChat(remitenteId, receptorId, receptorNombre, esAfiliado) { document.getElementById('chat-container').style.display = 'flex'; document.getElementById('chat-con-nombre').innerText = 'Chat con ' + receptorNombre; document.getElementById('remitente_id').value = remitenteId; document.getElementById('receptor_id').value = receptorId; document.getElementById('remitente_es_afiliado').value = esAfiliado; marcarLeido(); cargarMensajes(); if (chatInterval) clearInterval(chatInterval); chatInterval = setInterval(cargarMensajes, 3000); }
        function marcarLeido() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value; if (!r || !t) return; fetch('marcar_leido.php', { method: 'POST', body: new URLSearchParams({ usuario_actual_id: r, otro_usuario_id: t, usuario_actual_es_afiliado: e }) }); }
        function cerrarChat() { document.getElementById('chat-container').style.display = 'none'; if (chatInterval) clearInterval(chatInterval); }
        function cargarMensajes() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value, n = document.getElementById('mensajes'); if (!r || !t) return; fetch(`obtener_mensajes.php?usuario_actual_id=${r}&otro_usuario_id=${t}&usuario_actual_es_afiliado=${e}`).then(e => e.text()).then(e => { n.innerHTML = e, n.scrollTop = n.scrollHeight }) }
        document.getElementById('formChat').addEventListener('submit', e => { e.preventDefault(); const t = new FormData; t.append('remitente_id', document.getElementById('remitente_id').value), t.append('receptor_id', document.getElementById('receptor_id').value), t.append('mensaje', document.getElementById('mensaje').value), t.append('remitente_es_afiliado', document.getElementById('remitente_es_afiliado').value), fetch('enviar_mensaje.php', { method: 'POST', body: t }).then(() => { document.getElementById('mensaje').value = '', cargarMensajes() }) });
        {/literal}
    </script>
    <style>
        /* Estilo para que las tarjetas ocultas no ocupen espacio vertical y tengan transición */
        .client-card {
            transition: opacity 0.3s ease-in-out;
        }
        .client-card.oculto {
            opacity: 0;
            pointer-events: none; /* Evita que se pueda hacer clic mientras desaparece */
        }
    </style>
</body>
</html>
