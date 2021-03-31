<?php
require_once 'C:\xampp\htdocs\loan_system\web\models\menu.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\location.php';

function GetAllPermit(){
    return GetTableMenu();
}

function GetAllLocation(){
    return GetTableLocation();
}