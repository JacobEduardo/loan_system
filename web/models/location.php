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

function GetNameLocationById($id_location){
    $query = "SELECT * FROM location WHERE ID_LOCATION = $id_location;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}