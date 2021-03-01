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
            $this->database="loan_system";
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
        /* Metodo que retorna la cantidad de filas
         afectadas con el ultimo query realizado.*/
            return $this->conn->affected_rows;
        }

        public function GetRows($result){
        /*Metodo que retorna la ultima fila
         de un resultado en forma de arreglo.*/
            return $result->fetch_row();
        }

        public function SetFreeResult($result){
        //Metodo que libera el resultado del query.
            $result->free_result();
        }
    
    }


