<?php 
require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';

if( isset( $_GET['input_keyword']) ) {
    $input_keyword = $_GET['input_keyword'];

    if (!empty($input_keyword) ){
        $result = GetFilteredClients($input_keyword);
        echo $result;
        die;
    }else{
        $result = GetAllActiveClient();
        echo $result;
        die;
    }
    die;
}

if( isset( $_GET['rut_client']) ) {
    $rut = $_GET['rut_client'];
    $result = GetClientsAsJSON($rut);
    echo $result;
    die;
}

if( isset( $_GET['rut_client_delete']) ) {
    $result = DeleteClient($_GET['rut_client_delete']);
    echo $result;
    die;
}