<div id="title_form"><b>Eliminar Cliente</b></div>

<div id="from_table">
    <FORM onSubmit="return Search(text_input.value)" ;>
        <div style="float:left;"> Buscar palabra clave:</br>
            <input id="input_keyword" name="text_input" type="text" id="fname" name="input_keyword" onkeyup="LoadTable(this.value)">
        </div>
    </FORM>
</div>

<div style="clear: left;" id="table_product">
</div>
<div style="" id="button_table">
</div>
<div style="max-width: 530px;" id="delete_product">
</div>

<script>
    LoadTable();

    function LoadTable() {
        var page_number = getParameterByName('page_number');
        if (page_number == "") {
            page_number = 1;
        }
        page_number = parseInt(page_number);

        if ( getParameterByName('input_keyword') != "" ) {
            //es para mantener la tabla despues del cambio de pagina
            document.getElementById("input_keyword").value = getParameterByName('input_keyword');
        }
        input_keyword = document.getElementById("input_keyword").value;

        CreateHtmlTableClients(input_keyword);
    }

    function CreateHtmlTableClients(input_keyword) {
        var txt = "";
        txt = txt + "<table style='min-width: 700px; margin-top: 60px';>";
        txt = txt + "<thead>";
        txt = txt + "<tr>";
        txt = txt + "<th>RUT</th>";
        txt = txt + "<th>Nombre</th>";
        txt = txt + "<th>Tipo</th>";
        txt = txt + "<th>Correo</th>";
        txt = txt + "</tr>";
        txt = txt + "</thead>";
        txt = txt + "<tbody>";

        direction = "controllers/.php?input_keyword=" + input_keyword ;
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
            let  fechaend = new Date(json[i]['CREATION_DATE']);
            var funt = "DeleteProduct('" + json[i]['CODE'] + "')"
            html = html + "<tr onclick=" + funt + ">"
            html = html + "<td>" + json[i]['NAME'] + "</td>";
            html = html + "<td>" + json[i]['CODE'] + "</td>";
            html = html + "<td>" + json[i]['DESCRIPTION'] + "</td>";
            html = html + "<td>" + json[i]['SERIAL'] + "</td>";
            html = html + "<td>" + fechaend.getDate() +"/"+ (fechaend.getMonth() + 1) +"/"+ fechaend.getFullYear() +" "+ fechaend.getHours() +":"+ fechaend.getMinutes() + "</td>";
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

    function DeleteProduct(code_product) {
        FetchServer("controllers/inicio.php?check_product=" + code_product, function(response) {
            console.log("asdasdas response" + response);
            if (response == 1) {
                CreateHtmlProductInLoan(code_product);
            }
            if (response == 0) {
                console.log("asdasdasgggggggggggg");
                CreateHtmlProductAvailable(code_product);
            }
        });
    }

    function CreateHtmlProductInLoan(code_product) {
        FetchServer("controllers/inicio.php?product_inloan=" + code_product, function(response) {
            var txt = "";
            let json = JSON.parse(response);
            for (let row in json) {
                txt = txt + "<div id='client' style='padding: 20px; padding-bottom: 50px; border: 1pt solid #dadce0;'>";
                txt = txt + "<div id='title_product_inloan'> <b> Eliminar Activo </b> </div>";
                txt = txt + "<div style='margin-bottom: 5px;' >" + json[row]['CODEPRODUCT'] + " - " + json[row]['DESCRIPTIONPRODUCT'] + "</div>";
                txt = txt + "<div style='margin-bottom: 5px;' >Fecha de Creación:" + json[row]['CREATION_DATE'] + "</div>";
                txt = txt + "<a style='float: left;  color: crimson;'>El activo  esta en prestamo y no se puede eliminar</a>  <input id='button_from' style='float:right; background-color: #cbcbcb;' type='submit' value='Eliminar'></div>";
                txt = txt + "</div>";

                document.getElementById("table_product").innerHTML = "";
                document.getElementById("button_table").innerHTML = "";
                document.getElementById("from_table").innerHTML = "";
                document.getElementById("delete_product").innerHTML = txt;
            }
        });
    }

    function CreateHtmlProductAvailable(code_product) {
        FetchServer("controllers/inicio.php?search_product_available=" + code_product, function(response) {
            console.log("asdasd estoy aqui 2" + response);
            var txt = "";
            var json = JSON.parse(response);
            for (let row in json) {
                txt = txt + "<div id='client' style='padding: 20px; padding-bottom: 50px; border: 1pt solid #dadce0;'>";
                txt = txt + "<div id='title_product_inloan'> <b> Eliminar Activo </b> </div>";
                txt = txt + "<div style='margin-bottom: 5px;' >" + json[row]['CODE'] + " - " + json[row]['DESCRIPTION'] + "</div>";
                txt = txt + "<div style='margin-bottom: 5px;' >Fecha de Creación:" + json[row]['CREATION_DATE'] + "</div>";
                txt = txt + "<a style='float: left;'></a>  <input id='button_from' style='float:right; background-color: #c71818;' type='submit' value='Eliminar' onclick=FinishDeleteProduct('" + json[row]['ID_PRODUCT'] + "') /></div>";
                txt = txt + "</div>";
                console.log("asdasd estoy aqui 3");
                document.getElementById("table_product").innerHTML = "";
                document.getElementById("button_table").innerHTML = "";
                document.getElementById("from_table").innerHTML = "";
                document.getElementById("delete_product").innerHTML = txt;
                console.log("asdasd estoy aqui 4");
            }
        });
    }

    function FinishDeleteProduct(id_product){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = xhttp.responseText;
                if(response = 1 ){
                    document.getElementById("delete_product").innerHTML = "Activo Eliminado Correctamente";
                }else{
                    document.getElementById("delete_product").innerHTML = "Hubo un problema y no se pudo eliminar";
                }
            }
        };
        xhttp.open("GET", "controllers/deleteproduct.php?delete_product=" + id_product, false);
        xhttp.send();    
    }

</script>       