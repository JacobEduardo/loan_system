<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\user.php';

function LendGoods($code_goods, $rut_client, $rut_user){
    $id_client = GetIdClientByRut($rut_client);
    $id_user = GetIdUserByRut($rut_user);  
    $id_good = GetIdGoodsByCode($code_goods);

    if(!$id_good){
        return 1;
    }

    $result = ExecuteQueryBoolean("SELECT * FROM `loan_history` WHERE (STATUS='1') AND (ID_GOODS=$id_good)");
    if($result == 1){
        return 2;
    }

    $query = "INSERT INTO loan_history (`ID_GOODS`,`ID_USER_START`,`ID_CLIENT`,`STATUS`) values ($id_good,$id_user,$id_client,1);";
    $dasd = ExecuteQuery($query);
    if($dasd == 1){
        return 3;
    }
    return 0;
}

function GetIdGoodsByCode($code_goods){
    $query = "SELECT ID_GOODS FROM goods WHERE code = '$code_goods';";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}

function GetProductAsJSON ($product){
    $query = "SELECT * FROM goods WHERE code LIKE '$product';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}


function GetProductInLoanAsJSON ($code_product){
    $id_product = GetIdGoodsByCode($code_product);
    $query = "SELECT loan_history.ID_GOODS, loan_history.ID_CLIENT, loan_history.ID_USER_START, loan_history.DATE_START, client.NAME, client.RUT, goods.DESCRIPTION as DESCRIPTIONPRODUCT, goods.CODE as CODEPRODUCT FROM loan_history JOIN goods ON loan_history.ID_GOODS = goods.ID_GOODS JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT WHERE (loan_history.ID_GOODS = $id_product ) AND (loan_history.STATUS = 1);";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function CheckLoan ($code_product){
    $id_client = GetIdGoodsByCode($code_product);
    $query = "SELECT * FROM loan_history WHERE (ID_GOODS = $id_client) AND (STATUS = 1);";
    $result = ExecuteQueryBoolean($query);
    return $result;
}
