<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetClientsAsJSON($rut_client){
    $query = "SELECT * FROM client WHERE rut LIKE '%$rut_client%';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetClientsByIdAsJSON($id){
    $query = "SELECT * FROM client WHERE id_client = '$id';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetIdClientByRut($rut_client)
{
    $result = "SELECT ID_CLIENT FROM client WHERE rut = '$rut_client'";
    $id = ExecuteQueryGetResultLikeString($result);
    return($id);
}

function CreateClient ($name, $rut, $kind){
        $query = "INSERT INTO `client`(`RUT`, `NAME`, `KIND`, `STATUS`) VALUES ('$rut','$name ','$kind' ,1)";
        return ExecuteQuery($query);
}