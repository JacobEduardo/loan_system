<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

function GetIdUserByRut($rut_user)
{
    $id_client = CreateConexionAndExecute("SELECT ID_CLIENT FROM client WHERE Rut = '$rut_user'");
    return $id_client;
}
