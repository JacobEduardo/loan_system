<?php
    session_start ();
if( isset($_GET['page']) ) {
    require_once('C:\xampp\htdocs\loan_system\web\views\inicio.php');
}

if( isset($_GET['search']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';
    $clients = GetClientsAsJSON($_GET['search']);
    echo $clients;
    exit();
}

if( isset($_GET['search_id']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\client.php';
    $clients = GetClientsByIdAsJSON($_GET['search_id']);
    echo $clients;
    exit();
}

if( isset($_GET['check_product']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';
    $product = CheckLoan($_GET['check_product']);
    echo $product;
    exit();
}

if( isset($_GET['product_inloan']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';
    $product = GetProductInLoanAsJSON($_GET['product_inloan']);
    echo $product;
    exit();
}

if( isset($_GET['code_product']) ) {
    $code_product = $_GET['code_product'];
    $rut_client = $_GET['rut_client'];
    $rut_user = $_SESSION['rut'];
    require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';
    $resutl = LendProduct($code_product,$rut_client,$rut_user);
    echo $resutl;
    exit();
}

if( isset($_GET['id_client']) ) {
    $id_client = $_GET['id_client'];
    require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';
    $debt = GetDebsAsJSON($id_client);
    echo $debt;
    exit();
}

if( isset($_GET['return_code']) ) {
    $return_ID_PRODUCT = $_GET['return_code'];
    require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';
    $debt = ReturnProduct($return_ID_PRODUCT);
    echo $debt;
    exit();
}

if( isset($_GET['search_product_available']) ) {
    require_once 'C:\xampp\htdocs\loan_system\web\models\product.php';
    $product = GetProductAsJSON($_GET['search_product_available']);
    echo $product;
    exit();
}

