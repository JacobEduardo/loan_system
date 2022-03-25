<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';

function GetAllLoandsInProgress(){
    $table = GetLoandsInProgress();
    return $table;
}

function GetAllDebtors(){
    $table = GetDebtors();
    return $table;
}

