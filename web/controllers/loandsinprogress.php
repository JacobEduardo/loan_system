<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';

function GetAllHistory(){
    $table = GetHistory();
    return $table;
}

function GetAllLoandsInProgress($id_location){
    $table = GetLoandsInProgress($id_location);
    return $table;
}

function GetAllDebtors($id_location){
    $table = GetDebtors($id_location);
    return $table;
}

