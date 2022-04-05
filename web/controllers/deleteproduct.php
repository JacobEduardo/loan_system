<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';

if( isset( $_GET['code_product']) ) {
    $code_product = $_GET['code_product'];
    $input_date_start  = $_GET['input_date_start'];
    $input_date_end = $_GET['input_date_end'];

    if(!empty($code_product) && !empty($input_date_start) && !empty($input_date_end) ){
        $product = GetAllProduct4($code_product,$input_date_start,$input_date_end);
        echo $product;
        die;
    }elseif (!empty($input_date_start) && !empty($input_date_end) ){
        $product = GetAllProduct3($input_date_start,$input_date_end);
        echo $product;
        die;
    }elseif (!empty($code_product) ){
        $product = GetAllProduct2($code_product);
        echo $product;
        die;
    }else{
        $product = GetAllProduct();
        echo $product;
        die;
    }
    die;
}