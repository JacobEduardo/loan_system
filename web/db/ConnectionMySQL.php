<?php
class ConnectionMySQL{
private $host;
private $user;
private $password;
private $database;
private $conn;

    public function __construct(){ 
        $this->host="localhost";
        $this->user="root";
        $this->password="";
        $this->database="loan_system_management";
    }

    public function CreateConnection(){
    // Metodo que crea y retorna la conexion a la BD.
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
    }
    
    public function CloseConnection(){
        $this->conn->close();
    }
    
    public function ExecuteQuery($sql){
        $result = $this->conn->query($sql);
        return $result;
    }
    
    public function GetCountAffectedRows(){
        return $this->conn->affected_rows;
    }

    public function GetRows($result){
        return $result->fetch_row();
    }

    public function SetFreeResult($result){
        $result->free_result();
    }
    
    function ExecuteQueryReturnAsArray($query){
        $arr = array();
        $result = $this->conn->query($query);  
        $i=1;
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
            $arr[$i] = $row;
            $i++;
        }
        return $arr;
    }
    
}

function ExecuteQueryBoolean($sql){
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery($sql);
    if(!empty($result) AND mysqli_num_rows($result) == 1){
        return 1;
    }else{
        return 0;
    }
}

function  ExecuteQueryGetResultLikeArray($query){
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQueryReturnAsArray($query);
    $conn->CloseConnection();
    return $result;
}
    
function ExecuteQuery($query){
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery($query);
    $conn->CloseConnection();
    return $result;
}
    
function ExecuteQueryGetResultLikeString($query){
    $id = "";
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery($query);
        while ($fila = $result->fetch_row()) {
            $id = $fila[0];
        }
    $conn->CloseConnection();
    return($id);
}

function ExecuteQuerySimple($query){
    $conn = new ConnectionMySQL();
    $conn->CreateConnection();
    $result = $conn->ExecuteQuery($query);
    $conn->CloseConnection();
}