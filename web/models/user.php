<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetIdUserByRut($rut_user)
{
    $query = "SELECT ID_USER FROM user WHERE Rut = '$rut_user'";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}