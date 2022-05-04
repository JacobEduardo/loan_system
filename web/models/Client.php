<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetClientsAsJSON($imput){
    $query = "SELECT * FROM client WHERE rut LIKE '%$imput%';";
    $result = ExecuteQueryGetResultLikeArray($query);
    if (empty($result)) {
        $query = "SELECT * FROM client WHERE client.NAME LIKE '%$imput%'";
        $result = ExecuteQueryGetResultLikeArray($query);
    }
    return json_encode($result);
}

function DeleteClient($rut){
    $query = "UPDATE `client` SET `STATUS`='0' WHERE `RUT`='" .$rut ."';";
    $result = ExecuteDelete($query);
    return $result;
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

function CreateClient ($name, $rut, $kind ,$mail){
    $query = "INSERT INTO `client`(`RUT`, `NAME`, `KIND`, `STATUS`, `MAIL`) VALUES ('$rut','$name','$kind', 1 ,'$mail' )";
    return ExecuteQuery($query);
}

function GetAllActiveClient (){
    $query = "SELECT RUT, NAME, KIND, MAIL FROM `client` WHERE client.STATUS = 1;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}



function GetFilteredClients($input_keyword){
    $query = "SELECT * FROM client WHERE client.NAME LIKE '%" .$input_keyword ."%' AND client.STATUS = '1' OR client.RUT LIKE '%" .$input_keyword ."%' AND client.STATUS = '1'  OR client.MAIL LIKE '%" .$input_keyword ."%'  AND client.STATUS = '1' ;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}