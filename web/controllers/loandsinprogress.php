<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';

function GetAllLoandsInProgress($id_location){
    $table = GetLoandsInProgress($id_location);
    return $table;
}

function GetAllDebtors($id_location){
    $table = GetDebtors($id_location);
    return $table;
}

if( isset($_GET['code_product']) ) {
    $history = GetHistory();
    echo $history;
    exit();
}