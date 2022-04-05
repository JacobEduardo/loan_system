<div id="title_form"><b>Eliminar Activos</b></div>

<div>
    <FORM onSubmit="return Search(text_input.value)" ;>
        <div style="float:left;"> Buscar palabra clave:</br>
            <input id="input_keyword" name="text_input" type="text" id="fname" name="input_keyword" onkeyup="LoadTable(this.value)">
        </div>
        <div style="margin-left:30px; float:left;"> Entre que fechas:</br>
            <input id="input_date_start" type="date" id="fname" name="input_date_start" onchange="LoadTable(this.value)">
            <input id="input_date_end" type="date" id="fname" name="input_date_end" onchange="LoadTable(this.value)"></br>
        </div>
    </FORM>
</div>


<div style="clear: left;" id="table_product">
</div>
<div style="" id="button_table">
</div>

<script>
    LoadTable();

    var page_number = 1;

    function LoadTable() {
        var page_number = getParameterByName('page_number');
        if (page_number == "") {
            page_number = 1;
        }
        page_number = parseInt(page_number);
        if (getParameterByName('input_keyword') != "") {
            document.getElementById("input_keyword").value = getParameterByName('input_keyword');
        }
        if (getParameterByName('input_date_start') != "") {
            document.getElementById("input_date_start").value = getParameterByName('input_date_start');
        }
        if (getParameterByName('input_date_end') != "") {
            document.getElementById("input_date_end").value = getParameterByName('input_date_end');
        }
        input_keyword = document.getElementById("input_keyword").value;
        input_date_start = document.getElementById("input_date_start").value;
        input_date_end = document.getElementById("input_date_end").value;

        CreateHtmlTableLoandProggres(input_keyword, input_date_start, input_date_end, page_number);
    }

    function CreateHtmlTableLoandProggres(input_keyword, input_date_start, input_date_end, page_number) {
        var txt = "";
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
            let quantity_result = Object.keys(json).length;
            console.log(quantity_result);
            console.log(json);

            txt2 = CreateTable(page_number, quantity_result, json, 20);
            txt3 = CreateButton(page_number, quantity_result);

            document.getElementById("table_product").innerHTML = txt + txt2;
            document.getElementById("button_table").innerHTML = txt3;
        });
    }


    function CreateButton(page_number, quantity_result) {
        var html = "";
        if (page_number > 1) {
            html = html + "<a href=index.php?page=deleteproduct.php&page_number=" + (page_number - 1) + "&input_keyword=" + document.getElementById("input_keyword").value + "&input_date_start=" + document.getElementById("input_date_start").value + "&input_date_end=" + document.getElementById("input_date_end").value + "><input id='button_from' type='submit' value='Atras'/></a>";
        } else {
            html = html + "<a ><input id='button_from_disable' type='submit' value='Atras'/></a>";
        }
        if (quantity_result > (page_number * 20)) {
            html = html + "<a href=index.php?page=deleteproduct.php&page_number=" + (page_number + 1) + "&input_keyword=" + document.getElementById("input_keyword").value + "&input_date_start=" + document.getElementById("input_date_start").value + "&input_date_end=" + document.getElementById("input_date_end").value + "><input id='button_from' type='submit' value='Avanzar'/></a>";
        } else {
            html = html + "<a ><input id='button_from_disable' type='submit' value='Avanzar'/></a>";
        }

        return html;
    }

    function CreateTable(page_number, quantity_result, json, multiplier) {
        var html = "";
        var i = ((page_number * multiplier) - 19);
        var last_result = page_number * multiplier;
        console.log("i= " + i);

        if (last_result > quantity_result) {
            last_result = quantity_result;
        }
        console.log("last_result= " + last_result);

        for (i; i <= last_result; i++) {
            var funt = "DeleteProduct('" + json[i]['CODE'] + "')"
            html = html + "<tr onclick="+ funt +">"
            html = html + "<td>" + json[i]['NAME'] + "</td>";
            html = html + "<td>" + json[i]['CODE'] + "</td>";
            html = html + "<td>" + json[i]['DESCRIPTION'] + "</td>";
            html = html + "<td>" + json[i]['SERIAL'] + "</td>";
            html = html + "<td>" + json[i]['CREATION_DATE'] + "</td>";
            html = html + "</tr>"
        }

        return html;
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

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function DeleteProduct(data_entered) {
        FetchServer("controllers/inicio.php?check_product=" + data_entered, function(response) {
            if (response == 1) {
                document.getElementById("table_product").innerHTML = "111";
                CreateHtmlProductInLoan(data_entered);
            }
            if (response == 0) {
                document.getElementById("table_product").innerHTML = "0000";
                CreateHtmlProductAvailable(data_entered);
            }
        });
    }
</script>