<?php
if( isset($_GET['page']) ) {
    require_once("views/inicio.php");
}

if( isset($_GET['search']) ) {
    require 'C:\xampp\htdocs\loan_system\web\models\Client.php';
    require 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

    $search = $_GET['search'];
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery("SELECT * FROM goods WHERE code LIKE '%$search%';");
    
    $jsondata['success'] = true;
    $jsondata['message'] = 'Hola! El valor recibido es correcto.';
    

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
}
