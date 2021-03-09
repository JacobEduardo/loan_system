<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\user.php';

function LendGoods($code_goods, $rut_client, $rut_user){
    $id_client = GetIdClientByRut($rut_client);
    $id_user = GetIdUserByRut($rut_user);

    $id_good = GetIdGoodsByCode($code_goods);
    if(!$id_good){
        return 2;
    }

    $result = ExecuteQuery("SELECT * FROM `loan_history` WHERE (STATUS='1') AND (ID_GOODS='$id_good')");
    if($result == 1){
        return 3;
    }

    $query = "INSERT INTO loan_history (`ID_GOODS`,`ID_USER_START`,`ID_CLIENT`,`STATUS`) values ($id_good,$id_user,$id_client,1);";
    $dasd = ExecuteQuery($query);
    if($dasd == 1){
        return 1;
    }

    return 0;
}

function GetIdGoodsByCode($code_goods)
{
    $query = "SELECT ID_GOODS FROM goods WHERE code = '$code_goods';";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}