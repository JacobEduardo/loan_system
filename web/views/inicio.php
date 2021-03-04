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
    if(Object.keys(json).length == 1 ){
        CreatHtmlAllCliesnt(json);
    }
    if(Object.keys(json).length > 1 ){
        CreatHtmlAllCliesnt(json);
    }
}

function CreatHtmlOneClient(json){
    let txt = "";
    for(let row in json) {
        txt = txt + "<div id=simple_client>";
        txt = txt + "<b>" + json[row]['NAME'] + "</b>";
        txt = txt + "</br>";
        txt = txt + json[row]['RUT'];
        txt = "<input id='search'  name='t' placeholder='Buscar' type='text' size='20' maxlength='128' onkeyup='SearchClient(this.value)" />
        txt = txt + "</div>"; 
        document.getElementById("result_client").innerHTML = txt;
    }   
}

function CreatHtmlAllCliesnt(json){
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

</script>