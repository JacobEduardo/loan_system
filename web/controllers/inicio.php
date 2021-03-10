<?php
    session_start ();
    
if( isset($_GET['page']) ) {
    require_once('C:\xampp\htdocs\loan_system\web\views\inicio.php');
}

if( isset($_GET['search']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
    $clients = GetClientsAsJSON($_GET['search']);
    echo $clients;
    exit();
}

if( isset($_GET['search_debt']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
    $debt = GetDebtsAsJSON($_GET['search_debt']);
    echo $debt;
    exit();
}

if( isset($_GET['code_goods']) ) {
    $code_goods = $_GET['code_goods'];
    $rut_client = $_GET['rut_client'];
    $rut_user = $_SESSION['rut'];
    require_once 'C:\xampp\htdocs\loan_system\web\models\goods.php';
    $debt = LendGoods($code_goods ,$rut_client,$rut_user);
    echo json_encode($debt);
    exit();
}