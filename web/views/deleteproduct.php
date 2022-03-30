<div id="title_form"><b>Eliminar Cliente</b></div>

<div>
    <FORM onSubmit="return Search(text_input.value)";>
        <div style="float:left;"> Buscar palabra clave:</br>
            <input id="input_keyword" name="text_input" type="text" id="fname" name="input_keyword" onkeyup="Goooo(this.value)">
        </div>
        <div style="margin-left:30px; float:left;"> Entre que fechas:</br>
            <input  id="input_date_start" type="date" id="fname" name="input_date_start" onchange="Gooooo(this.value)">
            <input  id="input_date_end" type="date" id="fname" name="input_date_end" onchange="Gooooo(this.value)"></br>
        </div>
    </FORM>
</div>


<div style="clear: left;" id="table_product">
</div>

<script>
    CreateHtmlTableLoandProggres("","","");

    function Goooo(imput_code){
        input_keyword = document.getElementById("input_keyword").value;
        input_date_start = document.getElementById("input_date_start").value;
        input_date_end = document.getElementById("input_date_end").value;
        console.log(input_keyword);
        console.log(input_date_start);
        console.log(input_date_end);
        CreateHtmlTableLoandProggres(input_keyword, input_date_start, input_date_end);
    }

    function Gooooo(imput_code){
        console.log(imput_code);
    }

    function CreateHtmlTableLoandProggres(input_keyword, imput_date_start, imput_date_end){
        txt = "";

        txt = txt + "<table>";
        txt = txt +  "<thead>";
        txt = txt +  "<tr>";
        txt = txt +  "<th>Rut</th>";
        txt = txt +  "<th>Nombre</th>";
        txt = txt +  "<th>Tipo</th>";
        txt = txt +  "<th>Correo</th>";
        txt = txt +  "</tr>";
        txt = txt +  "</thead>";
        txt = txt +  "<tbody>";

        table = GetAllActiveClient(input_keyword, imput_date_start, imput_date_end);

        document.getElementById("table_product").innerHTML = txt;
    }

    function GetAllActiveClient(input_keyword, imput_date_start, imput_date_end){
        var xhttp = new XMLHttpRequest(); 
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = xhttp.responseText;
                console.log(json);
            }
        };
        xhttp.open("GET", "controllers/deleteproduct.php?code_product=" + input_keyword + "&input_date_start=" + imput_date_start + "&input_date_end=" + imput_date_end, true);
        xhttp.send();
    }
























</script>





<?php
//     if(isset($_GET['pag'])){
//         $pag = $_GET['pag'];
//     }else{
//         $pag = 1;
//     }

//     require_once 'C:\xampp\htdocs\loan_system\web\models\Client.php';
//     CreateHtmlTableLoandProggres($pag);

// function CreateHtmlTableLoandProggres($pag){

//     echo "<table>";
//     echo "<thead>";
//     echo "<tr>";
//     echo "<th>Rut</th>";
//     echo "<th>Nombre</th>";
//     echo "<th>Tipo</th>";
//     echo "<th>Correo</th>";
//     echo "</tr>";
//     echo "</thead>";
//     echo "<tbody>";

//     $table = GetAllActiveClient();

//     $count = count($table);
//     createTable($pag,$table,10);
//     CreateButtonTable($pag,$table,10);
    
// }

// function CreateButtonTable($pag,$table,$multiplicador){
//     $finalpage = $pag * $multiplicador;
//     $startpage = $finalpage - ($multiplicador - 1);

//     if($pag > 1){
//         echo "<a href=index.php?page=loandsinprogress.php&pag=" .($pag -1)  ." ><input id='button_from' type='submit' value='Atras'/></a>";
//     }
//     if( (count($table)) > $finalpage){
//         echo "<a href=index.php?page=loandsinprogress.php&pag=" .($pag +1)  ." ><input id='button_from' type='submit' value='Avanzar'/></a>";
//     }
    
    
// }

// function createTable($pag,$table,$multiplicador){
//     $finalpage = $pag * $multiplicador;
//     $startpage = $finalpage - ($multiplicador - 1);

//     if( (count($table)) < $finalpage){
//         $finalpage = count($table) + 1; 
//     }

//     for( $i = $startpage; $i< $finalpage; $i++){

//         foreach($table[$i] as $row => $value){

//                 echo "<td>";
//                 echo $value;
//                 echo " </td>";
            
//         }
//         echo "</tr>";

//     }
//     echo "</tbody>";
//     echo "</table>";
// }