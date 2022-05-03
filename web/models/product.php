<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';
require_once 'C:\xampp\htdocs\loan_system\web\models\user.php';

function LendProduct($code_product, $rut_client, $rut_user){
    $id_client = GetIdClientByRut($rut_client);
    $id_user = GetIdUserByRut($rut_user);  
    $id_product = GetIdProductByCode($code_product);
    $id_user_location = GetIdUserLocation($rut_user);

    if(!$id_product){
        return 1;
    };

    $result = ExecuteQueryBoolean("SELECT * FROM `product` WHERE (INVENTORY_STATUS='0') AND (ID_PRODUCT=$id_product)");
    if($result == 1){
        return 1;
    }

    $result2 = ExecuteQueryBoolean("SELECT * FROM product WHERE (CODE='".$code_product ."') AND (ID_LOCATION='" .$id_user_location ."');");
    if($result2 == 0){
        return 4;
    }

    $result = ExecuteQueryBoolean("SELECT * FROM `loan_history` WHERE (STATUS='1') AND (ID_PRODUCT=$id_product)");
    if($result == 1){
        return 2;
    }

    $query = "INSERT INTO loan_history (`ID_PRODUCT`,`ID_USER_START`,`ID_CLIENT`,`STATUS`) values ($id_product,$id_user,$id_client,1);";
    $dasd = ExecuteQuery($query);
    if($dasd == 1){
        return 3;
    }

    return 0;
}

function GetIdProductByCode($code_product){
    $query = "SELECT ID_PRODUCT FROM product WHERE code = '$code_product';";
    $id = ExecuteQueryGetResultLikeString($query);
    return($id);
}

function GetProductAsJSON ($product){
    $query = "SELECT product.NAME, product.DESCRIPTION, product.CODE, location.NAME as NAME_LOCATION FROM product JOIN location ON location.ID_LOCATION = product.ID_LOCATION WHERE code LIKE '$product';";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetProductInLoanAsJSON ($code_product){
    $id_product = GetIdProductByCode($code_product);
    $query = "SELECT loan_history.ID_PRODUCT, loan_history.ID_CLIENT, loan_history.ID_USER_START, loan_history.DATE_START, 
    client.NAME, client.RUT, client.MAIL ,
    product.CREATION_DATE, product.NAME as NAME_PRODUCT, product.DESCRIPTION as DESCRIPTIONPRODUCT, product.CODE as CODEPRODUCT,
    location.NAME as LOCATION_NAME, location.ID_LOCATION
    FROM loan_history 
    JOIN product ON loan_history.ID_PRODUCT = product.ID_PRODUCT 
    JOIN client ON loan_history.ID_CLIENT = client.ID_CLIENT 
    JOIN location ON location.ID_LOCATION = product.ID_LOCATION
    WHERE (loan_history.ID_PRODUCT = $id_product ) AND (loan_history.STATUS = 1);";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function CheckLoan ($code_product){
    $id_client = GetIdProductByCode($code_product);
    $query = "SELECT * FROM loan_history WHERE (ID_PRODUCT = $id_client) AND (STATUS = 1);";
    $result = ExecuteQueryBoolean($query);
    return $result;
}

function CreateProduct($name,$description,$serial,$code,$id_location){
    $query = "INSERT INTO `product`(`NAME`, `SERIAL`, `DESCRIPTION`, `CODE`, `INVENTORY_STATUS`, `ID_LOCATION`) 
    VALUES ('" .$name ."','" .$serial ."','" .$description ."','" .$code ."','1','" .$id_location ."')";
    return ExecuteQuery($query);
}

function DeleteProduct($code_product){
    $query = "UPDATE `product` SET `INVENTORY_STATUS`='0' WHERE `CODE`='" .$code_product ."';";
    $result = ExecuteDelete($query);
    return $result;
}

function GetAllProduct($id_location_user){
    $query = "SELECT * FROM product WHERE product.ID_LOCATION =" .$id_location_user ." AND product.INVENTORY_STATUS = '1' ;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetAllProduct2($code_imput,$id_location_user){
    $query = "SELECT * FROM `product` WHERE code LIKE '%" .$code_imput ."%' AND product.ID_LOCATION ='" 
    .$id_location_user ."' OR name LIKE '%" .$code_imput ."%' AND product.ID_LOCATION ='" .$id_location_user ."' AND product.INVENTORY_STATUS = '1' ;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetAllProduct3($imput_date_start, $imput_date_end,$id_location_user){
    $query = "SELECT * FROM `product` WHERE product.CREATION_DATE BETWEEN '" .$imput_date_start ."' AND '" 
    .$imput_date_end ."' product.ID_LOCATION =" .$id_location_user ." AND product.INVENTORY_STATUS = '1' ;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function GetAllProduct4($code_imput, $imput_date_start, $imput_date_end,$id_location_user){
    $query = "SELECT * FROM `product` WHERE code LIKE '%".$code_imput ."%' AND product.CREATION_DATE BETWEEN '" .$imput_date_start ."' AND '" .$imput_date_end ."' AND product.ID_LOCATION =" .$id_location_user ." OR name LIKE '%" . $code_imput ."%'  AND product.CREATION_DATE BETWEEN '" .$imput_date_start ."' AND '" .$imput_date_end ."' AND product.ID_LOCATION =" .$id_location_user ." AND product.INVENTORY_STATUS = '1' ;";
    $result = ExecuteQueryGetResultLikeArray($query);
    return json_encode($result);
}

function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}