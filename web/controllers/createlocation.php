<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\location.php';

function GetAllLocation(){
    return GetTableLocation();
}

if(isset($_POST['send'])){
    $name = $_POST["name"];

    if(!empty($name)){
        $result = CreateLocation($name);
        if(!empty($result)){
            header("location:../index.php?page=createlocation.php&result=1");
            die;
        }else{
            header("location:../index.php?page=createlocation.php&result=0");
            die;
        }
    }else{
        header("location:../index.php?page=createlocation.php&result=2");
        die;
    }  
}