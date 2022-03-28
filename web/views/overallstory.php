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
    $table = GetAllHistory();

    echo "<table id='AllHisotry'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Codigo</th>";
    echo "<th>Fecha inicio</th>";
    echo "<th>Presta</th>";
    echo "<th>Cliente</th>";
    echo "<th>Rut</th>";
    echo "<th>Correo</th>";
    echo "<th>Fecha Entrega</th>";
    echo "<th>Recibe</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    echo "<tr>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    echo "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    echo "</tr>";

    $count = count($table);
    createTable($pag,$table,20);
    CreateButtonTable($pag,$table,20);
    
}

function CreateButtonTable($pag,$table,$multiplicador){
    $finalpage = $pag * $multiplicador;
    $startpage = $finalpage - ($multiplicador - 1);

    if($pag > 1){
        echo "<a href=index.php?page=overallstory.php&pag=" .($pag -1)  ." ><input id='button_from' type='submit' value='Atras'/></a>";
    }
    if( (count($table)) > $finalpage){
        echo "<a href=index.php?page=overallstory.php&pag=" .($pag +1)  ." ><input id='button_from' type='submit' value='Avanzar'/></a>";
    }

}

function createTable($pag,$table,$multiplicador){
    $finalpage = $pag * $multiplicador;
    $startpage = $finalpage - ($multiplicador - 1);

    if( (count($table)) < $finalpage){
        $finalpage = count($table) + 1; 
    }

    for( $i = $startpage; $i< $finalpage; $i++){
        echo "<tr>";

        $k = 1;
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