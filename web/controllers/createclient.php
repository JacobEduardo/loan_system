<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';

function GetAllLocation(){
    return GetTableLocation();
}

if(isset($_POST['send'])){
    $name = $_POST["name"];
    $rut = $_POST["rut"];

    $kind = $_POST["kind"];

    if(!empty($name) && !empty($rut) ){
        $result = CreateClient($name,$rut,$kind);
        if(!empty($result)){
            header("location:../index.php?page=createclient.php&result=1");
            die;
        }else{
            header("location:../index.php?page=createclient.php&result=0");
            die;
        }
    }else{
        header("location:../index.php?page=createclient.php&result=2");
        die;
    }  
}