<?php 

    session_start ();
            
    if(isset($_SESSION['nickname'])){
        include("controllers/master.php");
    }else{
        include("controllers/login.php");
    }
    
?>