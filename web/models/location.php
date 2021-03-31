<?php 
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetTableLocation(){
    $query = "SELECT * FROM `location`";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}