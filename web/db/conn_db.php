<?php 
    function search_in_goods($text,$conn){
        return basic_query("SELECT * FROM goods WHERE code LIKE '%$text%';", $conn);
    }

    function search_in_client($text,$conn){
        return basic_query("SELECT * FROM client WHERE rut LIKE '%$text%';", $conn);
    }

    function basic_query($query,$conn){
        $query = $query;
        $query_result = mysqli_query($conn,$query);  
        return $query_result;
    }
?>