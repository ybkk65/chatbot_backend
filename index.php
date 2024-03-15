<?php 

require_once './connexion.php';

$availableRoutes = [];

$route = 'homepage';
if (isset($_GET['page']) and in_array($_GET['page'], $availableRoutes)) {
    $route = $_GET['page'];
}


    require './layout.php'; 
?>