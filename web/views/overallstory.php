<div id="title_form"><b>Deudas Vigentes</b></div>
<div id="table_overall_history" ></div>

<script>
CrearTableGlobalHistory();
function CrearTableGlobalHistory (){
    var txt = "";
    txt = txt + "<table id='AllHisotry'>";
    txt = txt + "<thead>";
    txt = txt + "<tr>";
    txt = txt + "<th>Codigo</th>";
    txt = txt + "<th>Fecha inicio</th>";
    txt = txt + "<th>Presta</th>";
    txt = txt + "<th>Cliente</th>";
    txt = txt + "<th>Rut</th>";
    txt = txt + "<th>Correo</th>";
    txt = txt + "<th>Fecha Entrega</th>";
    txt = txt + "<th>Recibe</th>";
    txt = txt + "</tr>";
    txt = txt + "</thead>";
    txt = txt + "<tbody>";

    txt = txt + "<tr>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='hisotiral_code_product' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: -webkit-fill-available;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "<td style='padding: 4px' ><input  type='text' style='width: 100px;' name='nombre'' id='nombre1' /></td>";
    txt = txt + "</tr>";

    document.getElementById("table_overall_history").innerHTML = txt;
    var imput_code_product = document.getElementById("hisotiral_code_product").innerHTML.value;
    console.log(imput_code_product);
    CreateTableOverallHistory(imput_code_product);
}

function CreateTableOverallHistory(imput_code_product){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let json = xhttp.responseText;
            console.log(json);
        }
    };
    xhttp.open("GET", "controllers/loandsinprogress.php?code_product=" + imput_code_product, false);
    xhttp.send();
}

</script>
