<div id="title_form"><b>Deudas Vijentes</b></div>

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page']
    }else{
        $page = 1;
    }
    require_once 'C:\xampp\htdocs\loan_system\web\models\history.php';
    CreateHtmlTableLoandProggres();

function CreateHtmlTableLoandProggres(){
    require_once 'C:\xampp\htdocs\loan_system\web\controllers\loandsinprogress.php';
    $table = GetAllLoandsProgress();

    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Fecha inicio</th>";
    echo "<th>Cliente</th>";
    echo "<th>Codigo Producto</th>";
    echo "<th>Iniciador</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $count = count($table);
    createTable($page,$table);

    $pag = 1;
    if($count > $pag ){
        echo "<div> Avanzar </div>";
    }

}

function createTable($page,$table){

    $finalpage = $page * 30;
    $startpage = $finalpage - 29;

    if((count($table)> $finalpage){
        $finalpage = count($table); 
    }

    for( $i = $startpage; $i< $finalpage; $i++){
        echo "<tr>";

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