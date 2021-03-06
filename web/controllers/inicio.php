<?php
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
    require_once 'C:\xampp\htdocs\loan_system\web\models\goods.php';
    $debt = LendGoods($_GET['search_debt']);
    echo $debt;
    exit();
}