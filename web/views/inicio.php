<h2 id="demo">Sistema de Prestamos</h2>
<FORM METHOD="POST" ACTION="">
    <input id="search"  name="text_input" placeholder="Buscar" type="text" size="20" maxlength="128" onkeyup="SearchClient(this.value)" />
    <input id="seeker_btn" name="search" type="submit" value="Buscar"/>
    <div id="search_result" style="margin-top: 20px;">
    </div>
</FORM>

<div id="result_client">
    
</div>

<script>

function SearchClient(srt) {
    if(srt.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                console.log(Object.keys(json).length);
                console.log(json);
                CreatHtmlClient(json);
            }
        };
        xhttp.open("GET", "controllers/inicio.php?search=" + srt, true);
        xhttp.send();
    }else{
        document.getElementById("result_client").innerHTML = "";                    
    }
}

function CreatHtmlClient(json){
      let count = Object.keys(json).length;
    if(count == 1 ){
        console.log("---222");
        CreateHtmlOneClient(json);
    } 
    if(count > 1 ){
        CreateHtmlTwoOrMoreClients(json);
        console.log("++++111");
    }
}

function CreateHtmlOneClient(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div id=one_client>";
        txt = txt +     "<div style='margin-top: 5px; margin-bottom: 5px; padding: 20px; color:#ffffff; background-color: #0079eb;   width: 200px;  margin: 0 auto;'>";
        txt = txt +         "<div id='name_client'>" + "<b>" + json[row]['NAME'] + "</b>" + "</div>";
        txt = txt +         "<div id='rut_client'>" + json[row]['RUT'] + "</div>";
        txt = txt +         "<div id='kind_client'>" + json[row]['KIND'] + "</div>";
        txt = txt +     "</div>";

        txt = txt +     "<div style='text-align: right; margin-top: 10px; margin-bottom: 25px;'>";
        txt = txt +             "<input  id='code_goods' placeholder='Buscar' class='form-control form-text' type='text' size='20' maxlength='150' />";
        txt = txt +             "<input  type='submit' value='Prestar' onclick='LendGoods()' />";
        txt = txt +             "<div id='messenger_lend'></div>";
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
        txt = txt + "<div id=simple_client>";
        txt = txt + "<b>" + json[row]['NAME'] + "</b>";
        txt = txt + "</br>";
        txt = txt + json;
        txt = txt + "</div>";
        document.getElementById("result_client").innerHTML = txt;
    }
}

function LoadDebt(id_client) {
    if(id_client.length > 0){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                console.log(json);
                CreateHtmlDebt(json);
            }
        };
        xhttp.open("GET", "controllers/inicio.php?id_client=" + id_client, true);
        xhttp.send();
    }else{
        //document.getElementById("").innerHTML = "";                    
    }
}

function CreateHtmlDebt(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div style='margin-top: 6px'>";
        txt = txt + "<b>" + json[row]['ID_GOODS'] + "</b>";
        txt = txt + "<a href='' style='float: right;'>Devolver</a>";
        txt = txt + "</div>";
    }
    document.getElementById("debt").innerHTML = txt;
}

function LendGoods(){
    let code_goods = document.getElementById("code_goods").value;
    let rut_client = document.getElementById("rut_client").innerHTML;

    if(code_goods.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json =  JSON.parse(xhttp.responseText);
                console.log(json);
                var txt = "";
                txt = txt + "<div style='margin-top: 10px; margin-bottom: 5px;'>" + json.Mensaje + "</div>";  
                if(json.Id = 1){
                    txt = "<div style='margin-top: 5px; margin-bottom: 5px; background-color: #be0000; padding: 5px;  padding-right: 10px;'>" + json.Mensaje + "</div>";   
                }            
                document.getElementById("messenger_lend").innerHTML = txt; 
            }
        };
        xhttp.open("GET", "controllers/inicio.php?code_goods=" + code_goods + "&rut_client=" + rut_client, true);
        xhttp.send();
    }else{
     
    }
}

</script>