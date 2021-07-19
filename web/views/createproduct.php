<?php  require_once 'C:\xampp\htdocs\loan_system\web\controllers\createproduct.php'; 
    if(isset($_GET['result'])){
        $result = $_GET['result'];
        if ($result == 2){
            echo "<div style='color:red;margin-bottom:15px;' >Rellene todos los campos</div>";
        }elseif($result == 1){
            echo "<div style='color:green;margin-bottom:10px;'>Producto ingresado exitosamente</div>";
        }elseif($result == 0){
            echo "<div style='color:red;margin-bottom:10px;'>Error</div>";
        }
    }   
?>

<form METHOD="POST" ACTION="controllers\createproduct.php"; >
    <div id='title_form'><b>Agregar Producto</b><br></div>

    <label for="fname">Nombre:</label><br>
    <input size="35" type="text" id="form_imput" name="name" value=""><br>
    <label for="lname">Descripcion:</label><br>
    <input size="35" type="text" id="form_imput" name="description" value=""><br>
    <label for="lname">Serial:</label><br>
    <input size="35" type="text" id="form_imput" name="serial" value=""><br>
    <label for="lname">Code:</label><br>
    <input size="35" type="text" id="form_imput" name="code" value=""><br>

    <div id='sub_title_form'><b>Lugar</b><br></div>
    <?php  
        CreateHtmlSelecLocation();
    ?>

    <br>
    <input id="button_from" type="submit" value="Enviar" name="send">
</form>

<?php

//Codigo PHP

function CreateHtmlSelecLocation(){
    echo "<select id='select' name='location'>";
    $location =  GetAllLocation();
    foreach($location as $row){
        echo "<option value='".$row['ID_LOCATION'] ."'>" .$row['NAME'] ."</option>";
    }
    echo "</select><BR>";
}
