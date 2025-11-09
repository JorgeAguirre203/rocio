<?php
/* Smarty version 3.1.39, created on 2025-11-09 21:28:43
  from 'C:\xampp\htdocs\rocio\templates\afiliados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6910f97b945db8_15953724',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a341e352fb3afae230b9df93089246cb81eec798' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\afiliados.tpl',
      1 => 1762720052,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6910f97b945db8_15953724 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style_bienvenida.css">
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
          flex: 1;
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
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            z-index: 999;
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
        #chat-header button {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        #mensajes {
          flex: 1;
          padding: 10px;
          overflow-y: auto;
          background: #f1f0f0;
          display: flex;
          flex-direction: column;
        }
        #formChat {
          display: flex;
          border-top: 1px solid #ccc;
        }
        #formChat input {
          flex: 1;
          padding: 10px;
          border: none;
        }
        #formChat button {
          padding: 10px 15px;
          border: none;
          background: #0078ff;
          color: white;
          cursor: pointer;
        }
        .mensaje-mio {
          background: #dcf8c6; padding: 8px 12px; border-radius: 15px 15px 0 15px; margin-bottom: 8px; max-width: 80%; align-self: flex-end; word-wrap: break-word;
        }
        .mensaje-otro {
          background: #fff; padding: 8px 12px; border-radius: 15px 15px 15px 0; margin-bottom: 8px; max-width: 80%; align-self: flex-start; word-wrap: break-word;
        }
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
    </style>
    <?php echo '<script'; ?>
>
        // Funciones definidas en el head para estar disponibles inmediatamente
        function confirmarEliminacion() {
            return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
        }
       
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
            document.getElementById("sidebar").style.left = "-250px";
            document.getElementById("overlay").style.display = "none";
        }
    <?php echo '</script'; ?>
>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Mi Perfil de Afiliado</h1>
        <div class="header-actions">
            <a href="index.php" class="btn-home-inicio">
                <span>🏠</span>
                Inicio
            </a>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <?php if ($_smarty_tpl->tpl_vars['afiliado_log']->value) {?>
                <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_materno'];?>
</p>
                <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nickname'];?>
</p>
                <a href="editar_perfil_afiliado.php" class="nav-btn">Editar perfil</a>
                <a href="historial_afiliado.php" class="nav-btn">Historial de trabajos</a>
                <a href="direccion_afiliado.php" class="nav-btn">Agregar dirección</a>
                <a href="eliminar_afiliado.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
                <a href="logout.php" class="nav-btn">Cerrar sesión</a>
            <?php } else { ?>
                <p>No has iniciado sesión.</p>
            <?php }?>
        </div>
    </div>
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- Main Content -->
    <div class="affiliate-container">
        <?php if ($_smarty_tpl->tpl_vars['afiliado_log']->value) {?>
            <!-- Profile Card -->
            <section class="profile-card">
                <div class="profile-avatar-large">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['foto_perfil'];?>
" alt="Foto de perfil" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;" />
                </div>
                <h2 class="profile-name"><?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_materno'];?>
</h2>
                <div class="profile-details">
                    <div class="detail-item">
                        <i class="fas fa-user-tag detail-icon"></i>
                        <div>
                            <span class="detail-label">Nickname</span>
                            <span class="detail-value"><?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nickname'];?>
</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-envelope detail-icon"></i>
                        <div>
                            <span class="detail-label">Email</span>
                            <span class="detail-value"><?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['email'];?>
</span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-briefcase detail-icon"></i>
                        <div>
                            <span class="detail-label">Especialidad</span>
                            <span class="detail-value"><?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['especialidad'];?>
</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Peticiones Pendientes -->
            <section class="requests-section">
                <h3 class="section-title">Peticiones pendientes</h3>
                <?php if (count($_smarty_tpl->tpl_vars['peticiones']->value) > 0) {?>
                    <div class="clients-grid">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['peticiones']->value, 'peticion');
$_smarty_tpl->tpl_vars['peticion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['peticion']->value) {
$_smarty_tpl->tpl_vars['peticion']->do_else = false;
?>
                            <div class="client-card">
                                <div class="client-header">
                                    <div class="client-avatar">
                                        <i class="fas fa-user client-avatar-icon"></i>
                                    </div>
                                    <div>
                                        <h4 class="client-name"><?php echo $_smarty_tpl->tpl_vars['peticion']->value['nombre'];?>
</h4>
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['nickname']) {?>
                                            <p class="client-nickname"><?php echo $_smarty_tpl->tpl_vars['peticion']->value['nickname'];?>
</p>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="client-info">
                                    <div class="info-row">
                                        <i class="fas fa-envelope info-icon"></i>
                                        <span><?php echo $_smarty_tpl->tpl_vars['peticion']->value['email'];?>
</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-phone info-icon"></i>
                                        <span><?php echo $_smarty_tpl->tpl_vars['peticion']->value['telefono'];?>
</span>
                                    </div>
                                    <div class="info-row">
                                        <i class="fas fa-map-marker-alt info-icon"></i>
                                        <span>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['calle'];?>
 <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['numero_casa']) {?>#<?php echo $_smarty_tpl->tpl_vars['peticion']->value['numero_casa'];?>
 <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['codigo_postal']) {?>CP: <?php echo $_smarty_tpl->tpl_vars['peticion']->value['codigo_postal'];?>
 <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['municipio']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['municipio'];?>
, <?php }?>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['estado_dir'];
}?>
                                        </span>
                                    </div>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['indicaciones']) {?>
                                        <div class="info-row indications">
                                            <i class="fas fa-info-circle info-icon"></i>
                                            <div>
                                                <span class="indications-label">Indicaciones:</span>
                                                <span class="indications-text"><?php echo $_smarty_tpl->tpl_vars['peticion']->value['indicaciones'];?>
</span>
                                            </div>
                                        </div>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados']) {?>
                                        <div class="info-row">
                                            <i class="fas fa-tools info-icon"></i>
                                            <span><strong>Servicios solicitados:</strong> <?php echo $_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados'];?>
</span>
                                        </div>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['tipo_cobro'] == 'por_hora') {?>
                                        <div class="info-row">
                                            <i class="fas fa-clock info-icon"></i>
                                            <span><strong>Tipo de servicio:</strong> Cobro por hora</span>
                                        </div>
                                    <?php }?>
                                </div>
                                <div class="client-actions">
                                    <form method="post" action="aceptar_peticion.php" style="display:inline;">
                                        <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['peticion_id'];?>
">
                                        <button type="submit" class="action-btn btn-primary">
                                            <i class="fas fa-check btn-icon"></i>
                                            Aceptar
                                        </button>
                                    </form>
                                    <form method="post" action="rechazar_peticion.php" style="display:inline;">
                                        <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['peticion_id'];?>
">
                                        <button type="submit" class="action-btn btn-outline">
                                            <i class="fas fa-times btn-icon"></i>
                                            Rechazar
                                        </button>
                                    </form>
                                    <form method="get" action="contratarAfiliado.php" style="display:inline;">
                                        <input type="hidden" name="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
">
                                        <button type="submit" class="action-btn btn-outline">
                                            <i class="fas fa-map btn-icon"></i>
                                            Dirección
                                        </button>
                                    </form>
                                    <button class="action-btn btn-secondary"
                                            onclick="abrirChat(<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
, '<?php echo strtr($_smarty_tpl->tpl_vars['peticion']->value['nombre'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
', 1)">
                                        <i class="fas fa-comments btn-icon"></i>
                                        Chatear
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['unread_messages'] > 0) {?><span class="chat-badge"><?php echo $_smarty_tpl->tpl_vars['peticion']->value['unread_messages'];?>
</span><?php }?>
                                    </button>
                                </div>
                            </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox empty-icon"></i>
                        <p>No tienes peticiones pendientes.</p>
                    </div>
                <?php }?>
            </section>

            <!-- Peticiones Aceptadas -->
            <section class="requests-section">
                <h3 class="section-title">Peticiones aceptadas</h3>
                <?php if (count($_smarty_tpl->tpl_vars['peticiones_aceptadas']->value) > 0) {?>
                    <div class="clients-grid">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['peticiones_aceptadas']->value, 'peticion');
$_smarty_tpl->tpl_vars['peticion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['peticion']->value) {
$_smarty_tpl->tpl_vars['peticion']->do_else = false;
?>
                            <?php if (!$_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] || $_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] == 'pendiente') {?>
                                <div class="client-card">
                                    <div class="client-header">
                                        <div class="client-avatar">
                                            <i class="fas fa-user client-avatar-icon"></i>
                                        </div>
                                        <div>
                                            <h4 class="client-name"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nombre'])===null||$tmp==='' ? '' : $tmp);?>
</h4>
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['nickname']) {?>
                                                <p class="client-nickname"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nickname'])===null||$tmp==='' ? '' : $tmp);?>
</p>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="client-info">
                                        <div class="info-row">
                                            <i class="fas fa-envelope info-icon"></i>
                                            <span><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-phone info-icon"></i>
                                            <span><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['telefono'])===null||$tmp==='' ? '' : $tmp);?>
</span>
                                        </div>
                                        <div class="info-row">
                                            <i class="fas fa-map-marker-alt info-icon"></i>
                                            <span>
                                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['calle'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['numero_casa']) {?>#<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['numero_casa'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['codigo_postal']) {?>CP: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['codigo_postal'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['municipio']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['municipio'])===null||$tmp==='' ? '' : $tmp);?>
, <?php }?>
                                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['estado_dir'])===null||$tmp==='' ? '' : $tmp);
}?>
                                            </span>
                                        </div>
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['indicaciones']) {?>
                                            <div class="info-row indications">
                                                <i class="fas fa-info-circle info-icon"></i>
                                                <div>
                                                    <span class="indications-label">Indicaciones:</span>
                                                    <span class="indications-text"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['indicaciones'])===null||$tmp==='' ? '' : $tmp);?>
</span>
                                                </div>
                                            </div>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados']) {?>
                                            <div class="info-row">
                                                <i class="fas fa-tools info-icon"></i>
                                                <span><strong>Servicios solicitados:</strong> <?php echo $_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados'];?>
</span>
                                            </div>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['tipo_cobro'] == 'por_hora') {?>
                                            <div class="info-row">
                                                <i class="fas fa-clock info-icon"></i>
                                                <span><strong>Tipo de servicio:</strong> Cobro por hora</span>
                                            </div>
                                        <?php }?>
                                    </div>
                                    <div class="client-actions">
                                        <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle'] || $_smarty_tpl->tpl_vars['peticion']->value['numero_casa'] || $_smarty_tpl->tpl_vars['peticion']->value['municipio'] || $_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {?>
                                            <form method="get" action="contratarAfiliado.php" style="display:inline;">
                                                <input type="hidden" name="id_usuario" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['id_usuario'])===null||$tmp==='' ? '' : $tmp);?>
">
                                                <button type="submit" class="action-btn btn-outline">
                                                    <i class="fas fa-map btn-icon"></i>
                                                    Dirección
                                                </button>
                                            </form>
                                        <?php }?>
                                        <button class="action-btn btn-secondary"
                                                onclick="abrirChat(<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
, '<?php echo strtr((($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nombre'])===null||$tmp==='' ? '' : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
', 1)">
                                            <i class="fas fa-comments btn-icon"></i>
                                            Chatear
                                            <?php if ($_smarty_tpl->tpl_vars['peticion']->value['unread_messages'] > 0) {?><span class="chat-badge"><?php echo $_smarty_tpl->tpl_vars['peticion']->value['unread_messages'];?>
</span><?php }?>
                                        </button>
                                        <?php if (!$_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion']) {?>
                                            <form method="get" action="crear_cotizacion.php" style="display:inline;">
                                                <input type="hidden" name="peticion_id" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['peticion_id'])===null||$tmp==='' ? '' : $tmp);?>
">
                                                <button type="submit" class="action-btn btn-primary">
                                                    <i class="fas fa-file-invoice-dollar btn-icon"></i>
                                                    Cotizar
                                                </button>
                                            </form>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] == 'pendiente') {?>
                                            <span style="color: orange; font-weight: bold; display: flex; align-items: center; gap: 5px;">
                                                <i class="fas fa-clock"></i> Pago pendiente
                                            </span>
                                        <?php }?>
                                    </div>
                                </div>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                <?php } else { ?>
                    <div class="empty-state">
                        <i class="fas fa-check-circle empty-icon"></i>
                        <p>No tienes peticiones aceptadas.</p>
                    </div>
                <?php }?>
            </section>
        <?php } else { ?>
            <div class="empty-state">
                <i class="fas fa-exclamation-circle empty-icon"></i>
                <p>No has iniciado sesión.</p>
            </div>
        <?php }?>
    </div>

    <!-- Solicitudes esperando cotización -->
    <?php if (count($_smarty_tpl->tpl_vars['solicitudes']->value) > 0) {?>
        <section class="affiliate-container">
            <h3 class="section-title">Solicitudes esperando cotización</h3>
            <div class="clients-grid">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['solicitudes']->value, 'solicitud');
$_smarty_tpl->tpl_vars['solicitud']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['solicitud']->value) {
$_smarty_tpl->tpl_vars['solicitud']->do_else = false;
?>
                    <div class="client-card">
                        <div class="client-header">
                            <div class="client-avatar">
                                <i class="fas fa-user client-avatar-icon"></i>
                            </div>
                            <div>
                                <h4 class="client-name"><?php echo $_smarty_tpl->tpl_vars['solicitud']->value['nombre'];?>
</h4>
                            </div>
                        </div>
                        <div class="client-info">
                            <div class="info-row">
                                <i class="fas fa-file-alt info-icon"></i>
                                <span><strong>Descripción:</strong> <?php echo $_smarty_tpl->tpl_vars['solicitud']->value['descripcion'];?>
</span>
                            </div>
                        </div>
                        <div class="client-actions">
                            <form method="post" action="crear_cotizacion.php" style="display:inline;">
                                <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['solicitud']->value['id'];?>
">
                                <input type="number" step="0.01" name="monto" placeholder="Monto a cobrar" required style="padding: 8px; border: 1px solid #e2e8f0; border-radius: 6px; margin-right: 8px;">
                                <button type="submit" class="action-btn btn-primary">
                                    <i class="fas fa-paper-plane btn-icon"></i>
                                    Enviar cotización
                                </button>
                            </form>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </section>
    <?php }?>

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

    <?php echo '<script'; ?>
>
        // Configuración adicional cuando el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar sidebar al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                if (event.target === overlay) {
                    closeSidebar();
                }
            });
        });

        // Funciones del chat
        
        let chatInterval;
        function abrirChat(remitenteId, receptorId, receptorNombre, esAfiliado) {
            document.getElementById('chat-container').style.display = 'flex';
            document.getElementById('chat-con-nombre').innerText = 'Chat con ' + receptorNombre;
            document.getElementById('remitente_id').value = remitenteId;
            document.getElementById('receptor_id').value = receptorId;
            document.getElementById('remitente_es_afiliado').value = esAfiliado;
            marcarLeido();
            cargarMensajes();
            if (chatInterval) clearInterval(chatInterval);
            chatInterval = setInterval(cargarMensajes, 3000);
        }
        function marcarLeido() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value; if (!r || !t) return; fetch('marcar_leido.php', { method: 'POST', body: new URLSearchParams({ usuario_actual_id: r, otro_usuario_id: t, usuario_actual_es_afiliado: e }) }); }
        function cerrarChat() { 
            document.getElementById('chat-container').style.display = 'none'; 
            if (chatInterval) clearInterval(chatInterval); 
        }
        function cargarMensajes() { 
            const r = document.getElementById('remitente_id').value, 
                  t = document.getElementById('receptor_id').value, 
                  e = document.getElementById('remitente_es_afiliado').value, 
                  n = document.getElementById('mensajes'); 
            if (!r || !t) return; 
            fetch(`obtener_mensajes.php?usuario_actual_id=${r}&otro_usuario_id=${t}&usuario_actual_es_afiliado=${e}`)
                .then(e => e.text())
                .then(e => { 
                    n.innerHTML = e; 
                    n.scrollTop = n.scrollHeight; 
                }); 
        }
        document.getElementById('formChat').addEventListener('submit', e => { 
            e.preventDefault(); 
            const t = new FormData; 
            t.append('remitente_id', document.getElementById('remitente_id').value);
            t.append('receptor_id', document.getElementById('receptor_id').value);
            t.append('mensaje', document.getElementById('mensaje').value);
            t.append('remitente_es_afiliado', document.getElementById('remitente_es_afiliado').value);
            fetch('enviar_mensaje.php', { method: 'POST', body: t })
                .then(() => { 
                    document.getElementById('mensaje').value = ''; 
                    cargarMensajes(); 
                }); 
        });
        
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
