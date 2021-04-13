<div id="title_form"><b>Sistema de Prestamos</b></div>
<FORM onSubmit="return Search(text_input.value)";>
    <input name="text_input" placeholder="Buscar" type="text" size="20" maxlength="128" onkeyup="Search(this.value)" />
    <input name="search" type="submit" value="Buscar"/>
    <div id="search_result" style="margin-top: 20px;">
    </div>
</FORM>

<div id="result_client">
</div>

<div id="result_product">
</div>

<script>

function Search(srt){
    SearchClient(srt);
    SearchProduct(srt);
    return false;
}

function SearchClientById(srt){
    FetchServer("controllers/inicio.php?search_id=",srt,function(response){
        let json = JSON.parse(response);
        console.log(Object.keys(json).length);
        console.log(json);
        CreatHtmlClientSearch(json);
    });
}


function SearchClient(srt){
    FetchServer("controllers/inicio.php?search=",srt,function(response){
        let json = JSON.parse(response);
        console.log(Object.keys(json).length);
        console.log(json);
        CreatHtmlClientSearch(json);
    });
}

function CreatHtmlClientSearch(json){
    let count = Object.keys(json).length;
    if(count == 1 ){
        CreateHtmlOneClient(json);
    } 
    if(count > 1 ){
        CreateHtmlTwoOrMoreClients(json);
    }if(count == 0 ){
        document.getElementById("result_client").innerHTML = "";
    }
}

function SearchProduct(data_entered){
        FetchServer("controllers/inicio.php?check_product=",data_entered,function(response){
        if(response == 1){
            document.getElementById("result_product").innerHTML = "";
            CreateHtmlProductInLoan(data_entered);
        }if(response == 0){
            document.getElementById("result_product").innerHTML = "";
            CreateHtmlProductAvailable(data_entered);
        }
    });
}

function CreateHtmlProductInLoan (data_entered){
    FetchServer("controllers/inicio.php?product_inloan=",data_entered,function(response){
        let json = JSON.parse(response);
        let txt = "";
        for(let row in json){
            txt = txt + "<div id=one_product>";
            txt = txt +     "<div id='client' style='padding: 20px';>";
            txt = txt +         "<div>" + "<b>" + json[row]['CODEPRODUCT'] +"</b>" + "</div>";
            txt = txt +         "<div>" + json[row]['DESCRIPTIONPRODUCT'] + "</div>";
            txt = txt +         "<div>" + "<b>" + json[row]['NAME'] +"</b>" + "</div>";           
            txt = txt +         "<div>" + json[row]['DATE_START'] + 
                                "<input  style='float:right' type='submit' value='Devolver' onclick=ReturnProduct('"+
                                 json[row]['ID_PRODUCT'] + "','" + json[row]['ID_CLIENT'] + "','" + json[row]['CODEPRODUCT'] +"') /></div>";   
            txt = txt +     "</div>";
            txt = txt + "</div>";
            document.getElementById("result_product").innerHTML = txt;
        }
    });
}

function CreateHtmlProductAvailable (data_entered){
    FetchServer("controllers/inicio.php?search_product_available=",data_entered,function(response){
        let json = JSON.parse(response);
        let count = Object.keys(json).length;
        let txt = "";
        for(let row in json){
            txt = txt + "<div id=one_product>";
            txt = txt +     "<div id='client' style='padding: 20px';>";
            txt = txt +         "<div id='name_product'>" + "<b>" + json[row]['NAME'] + "</b>" + "</div>";
            txt = txt +         "<div id='code_product'>" + json[row]['CODE'] + "</div>";
            txt = txt +         "<div id='code_product'> Disponible </div>";
            txt = txt +     "</div>";
            txt = txt + "</div>";
            document.getElementById("result_product").innerHTML = txt;
        }
    });
}

function CreateHtmlOneClient(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div id=one_client>";
        txt = txt +     "<div id='client' style='padding: 20px';>";
        txt = txt +         "<div id='name_client'>" + "<b>" + json[row]['NAME'] + "</b>" + "</div>";
        txt = txt +         "<div id='rut_client'>" + json[row]['RUT'] + "</div>";
        txt = txt +         "<div id='kind_client'>" + json[row]['KIND'] + "</div>";
        txt = txt +     "</div>";

        txt = txt +     "<div style='text-align: right; padding: 10px;'>";
        let funt =        "return " +  "LendProduct(" + json[row]['ID_CLIENT'] + ");"
        txt = txt +     "<form  method='post' onSubmit='" + funt +"') >";
        txt = txt +         "<input  id='code_product' placeholder='Buscar' class='form-control form-text' type='text' size='20' maxlength='150' />";
        txt = txt +         "<input  type='submit' value='Prestar' />";
        txt = txt +     "</form>";
        txt = txt +         "<div id='messenger_lend'></div>";
        txt = txt +     "</div>";

        txt = txt +     "<div id='debt' >";
        txt = txt +     "</div>";

        txt = txt + "</div>";

        document.getElementById("result_client").innerHTML = txt;
        console.log("id:" + json[row]['ID_CLIENT']);
        LoadDebt(json[row]['ID_CLIENT']);
    }
}

function CreateHtmlTwoOrMoreClients(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div onclick='SearchClientById(" + json[row]['ID_CLIENT'] + ")' id=simple_client>";
        txt = txt + "<b>" + json[row]['NAME'] + "</b></br>";
        txt = txt + json[row]['RUT'] ;
        txt = txt + "</br>";
        txt = txt + "</div>";
        document.getElementById("result_client").innerHTML = txt;
    }
}

function LoadDebt(id_client) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let json = JSON.parse(xhttp.responseText);
            console.log(json);
            document.getElementById("debt").innerHTML = "werwer";
            CreateHtmlDebt(json);
            console.log("dentro de LoadDebt");
        }
    };
    xhttp.open("GET", "controllers/inicio.php?id_client=" + id_client, true);
    xhttp.send();
    console.log("Final de LoadDebt");
}

function CreateHtmlDebt(json){
    let count = Object.keys(json).length;
    let txt = "";
    if(count > 0){
        txt = txt + "<div id='id='sub_title_form' style='padding: 15px' ><b>Productos en deuda:</b></div>";
    }
    for(let row in json) {
        txt = txt + "<div id=simple_debt>";
        txt = txt +     "<div style='padding: 8px 20px 8px 20px;';>";
        txt = txt +         "<b>" + json[row]['CODE'] + "</b></br>";
        txt = txt +         json[row]['DATE_START']; 
        txt = txt +         "<input  style='float: right' type='submit' value='Devolver' onclick=ReturnPRODUCT('"+ json[row]['ID_PRODUCT'] + "','" + json[row]['ID_CLIENT'] +"') />";
        txt = txt +     "</div>";
        txt = txt + "</div>";
    }
    document.getElementById("debt").innerHTML = txt;
    console.log("deb");
    console.log(json);
}

function ReturnPRODUCT(ID_PRODUCT, id_client){
    console.log(ID_PRODUCT);
    console.log(id_client);
    if(ID_PRODUCT.length > 0){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                LoadDebt(id_client);
            }
        };
        xhttp.open("GET", "controllers/inicio.php?return_code=" + ID_PRODUCT, true);
        xhttp.send();
    }
}

function ReturnProduct(ID_PRODUCT, id_client, code_product){
    console.log(ID_PRODUCT);
    console.log(id_client);
    if(ID_PRODUCT.length > 0){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                CreateHtmlProductAvailable(code_product);
            }
        };
        xhttp.open("GET", "controllers/inicio.php?return_code=" + ID_PRODUCT, true);
        xhttp.send();
    }
}

function LendProduct(id_client){
    let code_product = document.getElementById("code_product").value;
    let rut_client = document.getElementById("rut_client").innerHTML;
    console.log("code_product: " + code_product);
    console.log("rut_client: " + rut_client);
    console.log("id_client: " + id_client);

    if(code_product.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let result =  xhttp.responseText;
                var txt = "";
                console.log("valor prestamo: " + result + " fin valor");
                
                if(result == 1){
                    txt = "<div ";   
                }
                if(result == 2){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; padding: 5px; color: red; padding-right: 10px;'>El producto se encuentra en prestamo</div>";   
                }   
                if(result == 3){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; padding: 5px; color: green; padding-right: 10px;'>Prestamo exitoso</div>";   
                }   
                if(result == 4){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; padding: 5px; color: orange; padding-right: 10px;'>No pertenece a este lugar</div>";   
                }  
                if(result == 5){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; padding: 5px; color: orange; padding-right: 10px;'>Producto eliminado</div>";   
                } 
                if(result == 0){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; padding: 5px;  padding-right: 10px;'>Error</div>";   
                }               
                document.getElementById("messenger_lend").innerHTML = txt; 
            }
        };
        xhttp.open("GET", "controllers/inicio.php?code_product=" + code_product + "&rut_client=" + rut_client, true);
        xhttp.send();
    }
    LoadDebt(id_client);
    console.log("id_client: " + id_client);
    return false;
}

function FetchServer(direction,srt,fn){
    if(srt.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = xhttp.responseText;
                fn(response);
            }
        };
        xhttp.open("GET", direction + srt, true);
        xhttp.send();
    }else{
        document.getElementById("result_product").innerHTML = "";
        document.getElementById("result_client").innerHTML = "";
    }
}


</script>