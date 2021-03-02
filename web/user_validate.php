<?php
require 'db/ConnectionMySQL.php';
require 'models/Session.php';

$user = $_POST['user'];
$password = $_POST['password'];

$conn = new ConnectionMySQL();
$conn->CreateConnection();

$query_result = $conn->ExecuteQuery("SELECT * FROM user where nickname='$user' and pass='$password'");

if($query_result->num_rows == 1){
    $session = new Session();
    $rows = $query_result->fetch_array(MYSQLI_ASSOC);
    $session->set("nickname", $rows['NICKNAME']);
    $session->set("name", $rows['NAME']);
    $session->set("rut", $rows['RUT']);
    $session->set("last_name", $rows['LAST_NAME']);
    $conn->CloseConnection();
    header("location:index.php");
}else{
    $conn->CloseConnection();
    header("location:index.php");
}
