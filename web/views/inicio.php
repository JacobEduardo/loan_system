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

function LoadDebt(name_client) {
    if(srt.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                CreateHtmlDebt(json);
            }
        };
        xhttp.open("GET", "controllers/inicio.php?search_debt=" + name_client, true);
        xhttp.send();
    }else{
        document.getElementById("debt").innerHTML = "";                    
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
        txt = txt +     "<b>" + json[row]['NAME'] + "</b></br>";
        txt = txt +     json[row]['NAME'] + "</br>";
        txt = txt +     json[row]['KIND'] + "</br>";

        txt = txt +     "<div style='text-align: right; margin-top: 10px; margin-bottom: 25px;'>";
        txt = txt +             "<input  id='code' placeholder='Buscar' class='form-control form-text' type='text' size='20' maxlength='150' />";
        txt = txt +             "<input  type='submit' value='Prestar' onclick='LendGood()' />";
        txt = txt +             "<div id='messenger_lend' style='color: rgb(32, 160, 0); vertical-align:top; margin-top: 8px;'>HDMI34 ingresado Exitozamente</div>";
        txt = txt +     "</div>";

        txt = txt +     "<div id='debt' >";
        txt = txt +     "</div>";

        txt = txt + "</div>";
        
        document.getElementById("result_client").innerHTML = txt;
        //LoadDebt(json[row]['NAME']);
    }
}

function CreateHtmlTwoOrMoreClients(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div id=simple_client>";
        txt = txt + "<b>" + json[row]['NAME'] + "</b>";
        txt = txt + "</br>";
        txt = txt + json[row]['RUT'];
        txt = txt + "</div>";
        document.getElementById("result_client").innerHTML = txt;
    }
}

function CreateHtmlDebt(){
    var txt = "";
    txt = txt + "<div style='margin-top: 6px'>"
    txt = txt + "<b>HDMI n°5</b>"
    txt = txt + "<a href='' style='float: right;'>Devolver</a>"

    txt = txt + "</div>";

    document.getElementById("debt").innerHTML = txt;
}

function LendGood(){
    var code = document.getElementById("code").value;
    if(srt.length > 3){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let json = JSON.parse(xhttp.responseText);
                document.getElementById("messenger_lend").innerHTML = "LoadBorrowedGoods"; 
            }
        };
        xhttp.open("GET", "controllers/inicio.php?code_goods=" + code, true);
        xhttp.send();
    }else{
                        
    }
}

</script>