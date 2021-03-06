<?php
require_once 'C:\xampp\htdocs\loan_system\web\models\menu.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\location.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\user.php';

function GetAllPermit(){
    return GetTableMenu();
}

function GetAllLocation(){
    return GetTableLocation();
}

if(isset($_POST['send'])){
    $permits = "";
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $rut = $_POST["rut"];
    $nickname = $_POST["user_name"];
    $password = $_POST["password"];

    $id_location = $_POST["location"];


    if(!empty($nickname) && !empty($name) && !empty($last_name) && !empty($rut) && !empty($password)){
        if(!empty($_POST['check_list'])){
            foreach($_POST['check_list'] as $selected){
                $permits = $permits .",".$selected;
            }
            $permits=substr($permits,1);
        }
    }else{
        header("location:../index.php?page=createuser&result=2");
        die;
    }

    $result = CreateUser($id_location,$name,$last_name,$rut,$permits,$nickname,$password);
    if(!empty($result)){
        header("location:../index.php?page=createuser.php&result=1");
    }else{
        header("location:../index.php?page=createuser.php&result=0");
    }
}