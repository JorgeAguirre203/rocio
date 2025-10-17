<?php
/* Smarty version 3.1.39, created on 2025-05-25 03:35:05
  from '/var/www/html/rocio/templates/base.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68328fe97b9aa5_07535252',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9afaa413692a15c812859e7230f86bb83febf7ee' => 
    array (
      0 => '/var/www/html/rocio/templates/base.tpl',
      1 => 1748144100,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68328fe97b9aa5_07535252 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_46187189968328fe97b7c11_36724087', 'title');
?>
</title>
</head>
<body>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_153604554568328fe97b94b8_00645062', 'content');
?>

</body>
</html><?php }
/* {block 'title'} */
class Block_46187189968328fe97b7c11_36724087 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'title' => 
  array (
    0 => 'Block_46187189968328fe97b7c11_36724087',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Dashboard<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_153604554568328fe97b94b8_00645062 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_153604554568328fe97b94b8_00645062',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'content'} */
}
