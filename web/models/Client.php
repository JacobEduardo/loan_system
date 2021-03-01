<?php
    Class Clients {
        
    }
    
    Class Client {
        private $name;
        private $rut;
        private $permitis;
        private $id_location;
        private $last_name;
        private $nickname;
        
        
        function __construct($name, $rut, $permitis, $id_location, $last_name, $nickname) {
            $this->name = $name;
            $this->rut = $rut;
            $this->permitis = $permitis;
            $this->id_location = $id_location;
            $this->last_name = $last_name;
            $this->nickname = $nickname;
        }

        function getName() {
            return $this->name;
        }

        function getRut() {
            return $this->rut;
        }

        function getPermitis() {
            return $this->permitis;
        }

        function getId_location() {
            return $this->id_location;
        }

        function getLast_name() {
            return $this->last_name;
        }

        function getNickname() {
            return $this->nickname;
        }
    }  
?>