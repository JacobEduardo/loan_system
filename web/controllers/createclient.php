<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';

function GetAllLocation(){
    return GetTableLocation();
}

if(isset($_POST['send'])){
    $name = $_POST["name"];
    $rut = $_POST["rut"];
    $mail = $_POST["mail"];

    $kind = $_POST["kind"];

    if(!empty($name) && !empty($rut) && !empty($mail)){
        $id = GetIdClientByRutAndStatus($rut);        
        if(empty($id)){
            CreateClient($name,$rut,$kind,$mail);
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