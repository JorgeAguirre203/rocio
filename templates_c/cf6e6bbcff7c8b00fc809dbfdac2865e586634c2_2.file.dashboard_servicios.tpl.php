<?php
/* Smarty version 3.1.39, created on 2025-05-21 02:49:08
  from '/var/www/html/rocio/templates/dashboard_servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_682d3f240433e3_57817662',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf6e6bbcff7c8b00fc809dbfdac2865e586634c2' => 
    array (
      0 => '/var/www/html/rocio/templates/dashboard_servicios.tpl',
      1 => 1747795743,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682d3f240433e3_57817662 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2138803287682d3f24032604_92238244', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'base.tpl');
}
/* {block 'content'} */
class Block_2138803287682d3f24032604_92238244 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2138803287682d3f24032604_92238244',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h1>Servicios Verificados</h1>

<!-- Filtros -->
<div class="filtros">
    <label>Categoría:</label>
    <select id="filtroCategoria">
        <option value="">Todas</option>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categorias']->value, 'categoria');
$_smarty_tpl->tpl_vars['categoria']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->value) {
$_smarty_tpl->tpl_vars['categoria']->do_else = false;
?>
            <option value="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</option>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </select>

    <label>Precio máximo:</label>
    <input type="number" id="filtroPrecio" min="0">

    <label>Disponibilidad:</label>
    <select id="filtroDisponibilidad">
        <option value="">Todas</option>
        <option value="Disponible">Disponible</option>
        <option value="No disponible">No disponible</option>
    </select>

    <label>Estrellas mínimas:</label>
    <input type="number" id="filtroEstrellas" min="1" max="5">
</div>

<!-- Servicios -->
<div id="contenedorServicios">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
        <section id="servicio_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"
                 class="servicio"
                 data-estrellas="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['estrellas'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"
                 data-precio="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['precio'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"
                 data-disponibilidad="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['disponibilidad'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"
                 data-categoria="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['especialidad'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
">
            <img src="img/<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['imagen'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
">
            <div class="info">
                <h3><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</h3>
                <p><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['detalles'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</p>
                <span>$<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['precio'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
 MXN</span>
            </div>
        </section>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>

<?php
}
}
/* {/block 'content'} */
}
