<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetClientsAsJSON($rut_client){
    $query = "SELECT * FROM client WHERE rut LIKE '%$rut_client%';";
    $result = CreateConexionAndExecute($query);
    return json_encode($result);
}

function GetDebtsAsJSON($rut_client){
    /*date_default_timezone_set('America/Santiago');
    $date = date("Y-m-d H:i:s");*/
    $query = "INSERT INTO goods WHERE code LIKE '%$rut_client%';";
    $result = CreateConexionAndExecute($query);
    return json_encode($result);
}

function GetIdClientByRut($rut_client)
{
    $id_user = CreateConexionAndExecute("SELECT ID_USER FROM `user` WHERE rut = '$rut_client'");
    return($id_user);
}