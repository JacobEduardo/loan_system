<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetIdUserByRut($rut_user)
{
    $query = "SELECT ID_USER FROM user WHERE Rut = '$rut_user'";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}

function GetPermitsAsJSON($id_user){
    $query = "SELECT PERMITIS FROM `user` WHERE ID_USER = $id_user";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}