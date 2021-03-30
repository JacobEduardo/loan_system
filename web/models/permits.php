<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetAllPermits($permits){

    $query = "SELECT * FROM `menu` WHERE MENU_CODE IN ($permits)";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}