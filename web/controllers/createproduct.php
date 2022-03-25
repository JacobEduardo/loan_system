<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\location.php';

function GetAllLocation(){
    return GetTableLocation();
}

if(isset($_POST['send'])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $serial = $_POST['serial'];
    $code = $_POST["code"];

    $id_location = $_POST["location"];

    $id = GetIdProductByCode($code);
    if(!empty($id)){
        header("location:../index.php?page=createproduct.php&result=3");
        die;
    }

    if(!empty($name) && !empty($description) && !empty($code)){
        $result = CreateProduct($name,$description,$serial,$code,$id_location);
        if(!empty($result)){
            header("location:../index.php?page=createproduct.php&result=1");
            die;
        }else{
            header("location:../index.php?page=createproduct.php&result=0");
            die;
        }
    }else{
        header("location:../index.php?page=createproduct.php&result=2");
        die;
    }  
}