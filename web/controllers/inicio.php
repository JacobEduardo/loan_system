<?php
if( isset($_GET['page']) ) {
    require_once('C:\xampp\htdocs\loan_system\web\views\inicio.php');
}

if( isset($_GET['search']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';

    header('Content-type: application/json; charset=utf-8');
    $clients = CreateClients($_GET['search']);
    echo json_encode($clients);
    exit();
}