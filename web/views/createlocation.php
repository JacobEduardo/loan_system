<?php  require_once 'C:\xampp\htdocs\loan_system\web\controllers\createlocation.php'; 
    if(isset($_GET['result'])){
        $result = $_GET['result'];
        if ($result == 2){
            echo "<div style='color:red; margin-bottom:15px;' >Rellene todos los campos</div>";
        }elseif($result == 1){
            echo "<div style='color:green; margin-bottom:10px;'>local ingresado exitosamente</div>";
        }elseif($result == 0){
            echo "<div style='color:red; margin-bottom:10px;'>Error</div>";
        }
    }   
?>

<form METHOD="POST" ACTION="controllers\createlocation.php"; >
    <div id='title_form'><b>Agregar Local</b><br></div>

    <label for="fname">Nombre:</label><br>
    <input size="35" type="text" id="form_imput" name="name" value=""><br>

    <input id="button_from" type="submit" value="Enviar" name="send">
</form>

