<?php
require_once 'C:\xampp\htdocs\loan_system\web\db\ConnectionMySQL.php';

Class Client {
    private $name;
    private $rut;
    private $kind;
    private $status;
    
    function __construct($name, $rut, $kind, $status) {
        $this->name = $name;
        $this->rut = $rut;
        $this->kind = $kind;
        $this->status = $status;
    }
}

function CreateClients($srt){
    $clients = array();
    
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery("SELECT * FROM client WHERE rut LIKE '%$srt%';");
   
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        $clients['AllClients'][] = $row;
    }
    
    $conn->CloseConnection();
    return $clients;
}