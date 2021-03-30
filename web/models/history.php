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