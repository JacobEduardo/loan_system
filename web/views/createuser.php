<?php  require_once 'C:\xampp\htdocs\loan_system\web\controllers\createuser.php'; 
    if(isset($_GET['result'])){
        $result = $_GET['result'];
        if ($result == 2){
            echo "<div style='color:red;margin-bottom:15px;' >Rellene todos los campos</div>";
        }elseif($result == 1){
            echo "<div style='color:green;margin-bottom:10px;'>Usuario ingresado exitosamente</div>";
        }elseif($result == 0){
            echo "<div style='color:red;margin-bottom:10px;'>Error</div>";
        }elseif($result == 4){
            echo "<div style='color:red; margin-bottom:10px;'>Nombre de usuario ya en uso</div>";
        }elseif($result == 5){
            echo "<div style='color:red; margin-bottom:10px;'>Rut de usuario ya en uso</div>";
        }
    }   
?>

<form METHOD="POST" ACTION="controllers\createuser.php"; >
    <div id='title_form_two'><b>Agregar Usuario</b><br></div>

    <label for="fname">Nombre:</label><br>
    <input size="35" type="text" id="form_imput" name="name" value=""><br>
    <label for="lname">RUT:</label><br>
    <input size="35" type="text" id="form_imput" name="rut" value=""><br>
    <label for="lname">Nombre de Usuario:</label><br>
    <input size="35" type="text" id="form_imput" name="user_name" value=""><br>
    <label for="lname">Contraseña:</label><br>
    <input size="35" type="text" id="form_imput" name="password" value=""><br><br>

    <div id='sub_title_form'><b>Lugar</b><br></div>
    <?php  
        CreateHtmlSelecLocation();
    ?>

    <div id='sub_title_form'><b>Permisos</b><br></div>
    <?php  
        CreateHtmlCheckBoxs();
    ?>

    <br>
    <input id="button_from" type="submit" value="Enviar" name="send">
</form>

<script>
    Check();
    function Check() {
        document.getElementById("1.1").checked = true;
    }
</script>

<?php

//Codigo PHP
function CreateHtmlCheckBoxs(){
    $permits = GetAllPermit();
    $x = 1;
    $y = 1;
    $z = 1;
    $txt1 = "";
    $txt2 = "";
    $txt3 = "";
    foreach($permits as $row){
        $num = substr($row['MENU_CODE'] , 0, 1);

        if($num == 1){
            if($x == 1){
                $txt1 = $txt1 ."<div id='sub_title_form'><b>" .$row['MENU_NAME'] ."</b><br></div>";
                $x = 0;
            }else{
                $txt1 = $txt1 ."<input type='checkbox' id='" .$row['MENU_CODE'] ."' name='check_list[]' value='" .$row['MENU_CODE'] ."'><label>".$row['MENU_NAME'] ."</label><br/>";
            }
        }
        
        if($num == 2){
            if($y == 1){
                $txt2 = $txt2 ."<b>" .$row['MENU_NAME'] ."</b><br>";
                $y = 0;
            }else{
                $txt2 = $txt2 ."<input type='checkbox' name='check_list[]' value='" .$row['MENU_CODE'] ."'><label>".$row['MENU_NAME'] ."</label><br/>";
            }
        }
        
        if($num == 3){
            if($z == 1){
                $txt3 = $txt3 ."<b>" .$row['MENU_NAME'] ."</b><br>";
                $z = 0;
            }else{
                $txt3 = $txt3 ."<input type='checkbox' name='check_list[]' value='" .$row['MENU_CODE'] ."'><label>".$row['MENU_NAME'] ."</label><br/>";
            }
        }

    }
    echo $txt1;
    echo $txt2;
    echo $txt3;
}


function CreateHtmlSelecLocation(){
    echo "<select id='select' name='location'>";
    $location =  GetAllLocation();
    foreach($location as $row){
        echo "<option value='".$row['ID_LOCATION'] ."value='".$row['ID_LOCATION'] ."'>" .$row['NAME'] ."</option>";
    }
    echo "</select><BR><BR>";
}
