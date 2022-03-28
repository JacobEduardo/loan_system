<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';

function GetHistory(){
    $query = "Select product.CODE ,loan_history.DATE_START, user1.NICKNAME AS USER_START, client.RUT, client.NAME, client.MAIL ,loan_history.DATE_END, user2.NICKNAME AS USER_END FROM loan_history     
    INNER JOIN user AS user1 ON loan_history.ID_USER_START = user1.ID_USER 
    INNER JOIN user AS user2 ON loan_history.ID_USER_END = user2.ID_USER 
    INNER JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT
    INNER JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT
    WHERE product.ID_LOCATION =" .$_SESSION['id_location'] ."; ";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}

function GetDebsAsJSON($id_client){
    $query = "Select loan_history.ID_PRODUCT, loan_history.ID_CLIENT, product.CODE, product.DESCRIPTION, loan_history.DATE_START FROM loan_history JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT WHERE (loan_history.ID_CLIENT = $id_client) AND (loan_history.STATUS = 1)";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function ReturnPRODUCT ($return_ID_PRODUCT){
    $query = "UPDATE loan_history SET loan_history.STATUS = 0, loan_history.DATE_END = CURRENT_TIMESTAMP, loan_history.ID_USER_END =" .$_SESSION['id_user'] ." WHERE loan_history.ID_PRODUCT = $return_ID_PRODUCT AND loan_history.STATUS = 1";
    return ExecuteQuery($query);
}

function GetLoandsInProgress($id_location){
    $query = "SELECT loan_history.DATE_START, client.NAME as 'NAME_CLIENT', client.RUT as 'RUT_CLIENT', client.MAIL as 'MAIL_CLIENT', product.CODE, user.NAME as 'NAME_USER' FROM loan_history INNER JOIN user ON loan_history.ID_USER_START = user.ID_USER INNER JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT INNER JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT AND loan_history.STATUS = 1 AND product.ID_LOCATION = $id_location;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}

function GetDebtors($id_location){
    $query = "SELECT loan_history.DATE_START, client.NAME as 'NAME_CLIENT', client.RUT as 'RUT_CLIENT', client.MAIL as 'MAIL_CLIENT', product.CODE, user.NAME as 'NAME_USER' FROM loan_history INNER JOIN user ON loan_history.ID_USER_START = user.ID_USER INNER JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT INNER JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT AND loan_history.STATUS = 1 AND DATE_START <= NOW() - INTERVAL 1 DAY AND product.ID_LOCATION = $id_location;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return $result;
}

function GetProductHistory($code_product){
    $id_product = GetIdProductByCode($code_product);
    $query = "Select loan_history.DATE_START, user1.NICKNAME AS USER_START, client.RUT, loan_history.DATE_END, user2.NICKNAME AS USER_END FROM loan_history INNER JOIN user AS user1 ON loan_history.ID_USER_START = user1.ID_USER INNER JOIN user AS user2 ON loan_history.ID_USER_END = user2.ID_USER INNER JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT WHERE loan_history.ID_PRODUCT = $id_product AND loan_history.STATUS = 0 ORDER BY `loan_history`.`DATE_START` DESC";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}