<?php 
defined('C5_EXECUTE') or die("Access Denied.");
?>

        <?php 
    $bt_main = BlockType::getByHandle('autonav'); 
    $bt_main->controller->displayPages = 'top'; 
    $bt_main->controller->orderBy = 'display_asc'; 
    $bt_main->controller->displaySubPages = 'relevant_breadcrumb';
    $bt_main->controller->displaySubPageLevels = 'all';  
    $bt_main->controller->displayPagesIncludeSelf = 1; 
    $bt_main->render('templates/breadcrumb'); 
   ?>
