<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetDebsAsJSON($id_client){
    $query = "SELECT goods.CODE, loan_history.DATE_START
    FROM ((loan_history
    INNER JOIN goods ON loan_history.ID_GOODS = goods.ID_GOODS)
    INNER JOIN client ON loan_history.ID_GOODS = goods.ID_GOODS);";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}