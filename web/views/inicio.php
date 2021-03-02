<h2 id="demo">Sistema de Prestamos</h2>
<FORM METHOD="POST" ACTION="">
    <input id="search"  name="text_input" placeholder="Buscar" type="text" size="20" maxlength="128" onkeyup="loadDoc(this.value)" />
    <input id="seeker_btn" name="search" type="submit" value="Buscar"/>

    <div id="search_result" style="margin-top: 20px;">
    </div>
</FORM>

<div id="result_client">
    
</div>

<script>
    function loadDoc(srt) {
        if(srt.length > 3){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let json = JSON.parse(xhttp.responseText);
                    console.log(json);
                    
                    document.getElementById("result_client").innerHTML = "downloads";
                }
            };
            xhttp.open("GET", "controllers/inicio.php?search=" + srt, true);
            xhttp.send();
        }
    }
</script>