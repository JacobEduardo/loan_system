<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetDebsAsJSON($id_client){
    $query = "Select loan_history.ID_PRODUCT, loan_history.ID_CLIENT, product.CODE, product.DESCRIPTION, loan_history.DATE_START FROM loan_history JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT WHERE (loan_history.ID_CLIENT = $id_client) AND (loan_history.STATUS = 1)";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function ReturnPRODUCT ($return_ID_PRODUCT){
    $query = "UPDATE loan_history SET loan_history.STATUS = 0 WHERE loan_history.ID_PRODUCT = $return_ID_PRODUCT";
    ExecuteQuerySimple($query);
    return "OK";
}

function GetLoandsInProgress(){
    $query = "SELECT loan_history.DATE_START, client.NAME as 'NAME_CLIENT', product.CODE, user.NAME as 'NAME_USER' FROM loan_history INNER JOIN user ON loan_history.ID_USER_START = user.ID_USER INNER JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT INNER JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT AND loan_history.STATUS = 1";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}