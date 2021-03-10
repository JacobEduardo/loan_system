<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\user.php';

function LendGoods($code_goods, $rut_client, $rut_user){
    $id_client = GetIdClientByRut($rut_client);
    $id_user = GetIdUserByRut($rut_user);
    
    $id_good = GetIdGoodsByCode($code_goods);
    if(!$id_good){
        $arr = array("Id"=>1, "Color"=>'este es el color GetIdGoodsByCode', "Mensaje"=>'No se encontraron concidencias');
        return $arr;
    }

    $result = ExecuteQueryBoolean("SELECT * FROM `loan_history` WHERE (STATUS='1') AND (ID_GOODS=$id_good)");
    if($result == 1){
        $arr = array("Id"=>2, "Color"=>'este es el color ExecuteQueryBoolean', "Mensaje"=>''.$code_goods.'Se encuantra en prestamo');
        return $arr;
    }

    $query = "INSERT INTO loan_history (`ID_GOODS`,`ID_USER_START`,`ID_CLIENT`,`STATUS`) values ($id_good,$id_user,$id_client,1);";
    $dasd = ExecuteQuery($query);
    if($dasd == 1){
        $arr = array("Id"=>3, "Color"=>'este es el color ExecuteQuery', "Mensaje"=>''.$code_goods.'Ingresado correctamente');
        return $arr;
    }

    return 0;
}

function GetIdGoodsByCode($code_goods)
{
    $query = "SELECT ID_GOODS FROM goods WHERE code = '$code_goods';";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}