<?php 
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetTableLocation(){
    $query = "SELECT * FROM `location`";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}

function CreateLocation ($name){
    $query = "INSERT INTO `location`(`NAME`) VALUES ('$name')";
    return ExecuteQuery($query);
}