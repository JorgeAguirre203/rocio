
<?php
require_once 'libs/Smarty.class.php';

// Configurar Smarty
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Asignar todas las variables necesarias
$smarty->assign([
    'page_title' => 'Servi Now',
    'current_year' => date('Y'),
    'hero_title' => '¡Contrata al instante!',
    'hero_text' => 'Encuentra a los mejores profesionales en un solo clic.',
    'about_title' => 'Sobre Nosotros',
    'about_text' => 'En Servi Now nos dedicamos a conectar clientes con profesionales confiables. Nuestro objetivo es ofrecer soluciones rápidas y efectivas para todo tipo de servicios en el hogar o la empresa, registrate y accede a una variedad de servicios disponibles!.'
]);

// Mostrar la plantilla completa
$smarty->display('index.tpl');
?>
