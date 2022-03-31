<div id="title_form"><b>Eliminar Cliente</b></div>

<div>
    <FORM onSubmit="return Search(text_input.value)" ;>
        <div style="float:left;"> Buscar palabra clave:</br>
            <input id="input_keyword" name="text_input" type="text" id="fname" name="input_keyword" onkeyup="Goooo(this.value)">
        </div>
        <div style="margin-left:30px; float:left;"> Entre que fechas:</br>
            <input id="input_date_start" type="date" id="fname" name="input_date_start" onchange="Goooo(this.value)">
            <input id="input_date_end" type="date" id="fname" name="input_date_end" onchange="Goooo(this.value)"></br>
        </div>
    </FORM>
</div>


<div style="clear: left;" id="table_product">
</div>

<script>
    Goooo("", "", "");

    function Goooo() {
        input_keyword = document.getElementById("input_keyword").value;
        input_date_start = document.getElementById("input_date_start").value;
        input_date_end = document.getElementById("input_date_end").value;
        console.log("a" + input_keyword);
        console.log("b" + input_date_start);
        console.log("c" + input_date_end);

        CreateHtmlTableLoandProggres(input_keyword, input_date_start, input_date_end);
    }

    function CreateHtmlTableLoandProggres(input_keyword, input_date_start, input_date_end) {
        txt = "";
        txt = txt + "<table style='min-width: 700px; margin-top: 60px';>";
        txt = txt + "<thead>";
        txt = txt + "<tr>";
        txt = txt + "<th>Nombre</th>";
        txt = txt + "<th>Codigo</th>";
        txt = txt + "<th>Descripción</th>";
        txt = txt + "<th>Serial</th>";
        txt = txt + "<th>Fecha creacion</th>";
        txt = txt + "</tr>";
        txt = txt + "</thead>";
        txt = txt + "<tbody>";

        direction = "controllers/deleteproduct.php?code_product=" + input_keyword + "&input_date_start=" + input_date_start + "&input_date_end=" + input_date_end;
        FetchServer(direction, function(response) {
            let json = JSON.parse(response);
            let count = Object.keys(json).length;
            console.log(count);

            CreateTable();
            document.getElementById("table_product").innerHTML = txt;
        });


    }

    function CreateTable(json, pagina, ) {

        for (let row in json) {
            txt = txt + "<tr>"
            txt = txt + "<td>" + json[row]['NAME'] + "</td>";
            txt = txt + "<td>" + json[row]['CODE'] + "</td>";
            txt = txt + "<td>" + json[row]['DESCRIPTION'] + "</td>";
            txt = txt + "<td>" + json[row]['SERIAL'] + "</td>";
            txt = txt + "<td>" + json[row]['CREATION_DATE'] + "</td>";
            txt = txt + "</tr>"
        };
    }

    function FetchServer(direction, fn) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = xhttp.responseText;
                fn(response);
            }
        };
        xhttp.open("GET", direction, true);
        xhttp.send();
    }
</script>