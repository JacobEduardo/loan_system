<?php

require_once 'C:\xampp\htdocs\loan_system\web\views\essential\header.php';

require_once 'C:\xampp\htdocs\loan_system\web\views\master.php';

require_once 'C:\xampp\htdocs\loan_system\web\views\essential\footer.php';


function GetMenu($permit_user){
    $permit = $permit_user;
    require_once 'C:\xampp\htdocs\loan_system\web\models\permits.php';
    $permits = GetAllPermits($permit);
    return $permits;
    exit();
}
    