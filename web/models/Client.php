<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetClientsAsJSON($rut_client){
    $query = "SELECT * FROM client WHERE rut LIKE '%$rut_client%';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetDebtsAsJSON($rut_client){
    $query = "INSERT INTO goods WHERE code LIKE '%$rut_client%';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetIdClientByRut($rut_client)
{
    $result = "SELECT ID_CLIENT FROM client WHERE rut = '$rut_client'";
    $id = ExecuteQueryGetResultLikeString($result);
    return($id);
}