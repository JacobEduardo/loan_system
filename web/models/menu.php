<?php 
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetTableMenu(){
    $query = "SELECT * FROM `menu`";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}