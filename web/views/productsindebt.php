<div id="title_form"><b>Deudas Vigentes</b></div>

<?php
    if(isset($_GET['pag'])){
        $pag = $_GET['pag'];
    }else{
        $pag = 1;
    }

    require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';
    CreateHtmlTableLoandProggres($pag);

function CreateHtmlTableLoandProggres($pag){

    require_once 'C:\xampp\htdocs\loan_system\web\controllers\loandsinprogress.php';
    $table = GetAllLoandsProgress();

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Fecha inicio</th>";
    echo "<th>Cliente</th>";
    echo "<th>Rut</th>";
    echo "<th>Correo</th>";
    echo "<th>Codigo Producto</th>";
    echo "<th>Iniciador</th>";
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
        echo "<tr onclick=document.location='index.php?page=inicio.php&code=" .$table[$i]['CODE']  ."'>";

        $k = 1;
        foreach($table[$i] as $row => $value){
            if ($k == 1){
                echo "<td>";
                echo date("jS F, Y h:i:s A" , strtotime($value) );
                echo " </td>";
                $k = 0;
            }else{
                echo "<td>";
                echo $value;
                echo " </td>";
            }
        }
        echo "</tr>";

    }
    echo "</tbody>";
    echo "</table>";
}