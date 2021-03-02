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
   
    $i=1;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $clients[$i] = $row;
        $i++;
    }
    
    $conn->CloseConnection();
    return json_encode($clients);
}