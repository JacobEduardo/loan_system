<div id="title_form"><b>Eliminar Cliente</b></div>

<?php
    if(isset($_GET['pag'])){
        $pag = $_GET['pag'];
    }else{
        $pag = 1;
    }

    require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
    CreateHtmlTableLoandProggres($pag);

function CreateHtmlTableLoandProggres($pag){

    //require_once 'C:\xampp\htdocs\loan_system\web\controllers\Client.php';
    $table = GetAllActiveClient();

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Rut</th>";
    echo "<th>Nombre</th>";
    echo "<th>Tipo</th>";
    echo "<th>Correo</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $count = count($table);
    createTable($pag,$table,10);
    CreateButtonTable($pag,$table,10);
    
}

function CreateButtonTable($pag,$table,$multiplicador){
    $finalpage = $pag * $multiplicador;
    $startpage = $finalpage - ($multiplicador - 1);

    if($pag > 1){
        echo "<a href=index.php?page=loandsinprogress.php&pag=" .($pag -1)  ." ><input id='button_from' type='submit' value='Atras'/></a>";
    }
    if( (count($table)) > $finalpage){
        echo "<a href=index.php?page=loandsinprogress.php&pag=" .($pag +1)  ." ><input id='button_from' type='submit' value='Avanzar'/></a>";
    }
    
    
}

function createTable($pag,$table,$multiplicador){
    $finalpage = $pag * $multiplicador;
    $startpage = $finalpage - ($multiplicador - 1);

    if( (count($table)) < $finalpage){
        $finalpage = count($table) + 1; 
    }

    for( $i = $startpage; $i< $finalpage; $i++){

        foreach($table[$i] as $row => $value){

                echo "<td>";
                echo $value;
                echo " </td>";
            
        }
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";
}