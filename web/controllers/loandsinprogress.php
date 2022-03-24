<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';

function GetAllLoandsInProgress(){
    $table = GetLoandsInProgress();
    return $table;
}

function GetAllLoandsProgress(){
    $table = GetLoandsInProgress();
    return $table;
}

