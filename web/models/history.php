<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetDebsAsJSON($id_client){
    $query = "Select loan_history.ID_GOODS, loan_history.ID_CLIENT, goods.CODE, goods.DESCRIPTION, loan_history.DATE_START FROM loan_history JOIN goods ON loan_history.ID_GOODS = goods.ID_GOODS WHERE (loan_history.ID_CLIENT = $id_client) AND (loan_history.STATUS = 1)";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function ReturnGoods ($return_id_goods){
    $query = "UPDATE loan_history SET loan_history.STATUS = 0 WHERE loan_history.ID_GOODS = $return_id_goods";
    ExecuteQuerySimple($query);
    return "OK";
}