<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetIdUserByRut($rut_user)
{
    $query = "SELECT ID_USER FROM user WHERE Rut = '$rut_user' AND user.status = 1";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}

function GetPermitsAsJSON($id_user){
    $query = "SELECT PERMITIS FROM `user` WHERE ID_USER = $id_user  AND user.status = 1";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetIdUserLocation ($rut_user){
    $query = "SELECT ID_LOCATION FROM user WHERE Rut = '$rut_user' AND status = 1";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}

function CreateUser($id_location, $name, $rut, $permit, $nickname, $password){
    $query = "INSERT INTO `user`(`ID_LOCATION`, `NAME`, `RUT`, `PERMITS`, `NICKNAME`, `PASSWORD`)
    VALUES ('".$id_location."','".$name."','".$rut."','".$permit."','".$nickname."','".$password."')";
    return ExecuteQuery($query);
}