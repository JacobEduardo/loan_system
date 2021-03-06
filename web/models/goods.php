<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function LendGoods($code_goods, $rut_user, $rut_client){
    $id_client = GetIdClientByRut($rut_client);
    $id_user = GetIdUserByRut($rut_user);
    GetIdGoodsByCode($code_goods);
    $query = "INSERT INTO loan_history (`ID_GOODS`,`ID_USER_START`,`ID_CLIENT`,`STATUS`) values (1,$id_user,$id_client,1);";
    $result = CreateConexionAndExecute($query);
    return json_encode($result);
}

function GetIdGoodsByCode($code_goods)
{
    # code...
}