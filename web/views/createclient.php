<?php  require_once 'C:\xampp\htdocs\loan_system\web\controllers\createproduct.php'; 
    if(isset($_GET['result'])){
        $result = $_GET['result'];
        if ($result == 2){
            echo "<div style='color:red; margin-bottom:15px;' >Rellene todos los campos</div>";
        }elseif($result == 1){
            echo "<div style='color:green; margin-bottom:10px;'>Cliente ingresado exitosamente</div>";
        }elseif($result == 0){
            echo "<div style='color:red; margin-bottom:10px;'>Error</div>";
        }
    }   
?>

<form METHOD="POST" ACTION="controllers\createclient.php"; >
    <div id='title_form'><b>Agregar Cliente</b><br></div>

    <label for="fname">Nombre:</label><br>
    <input size="35" type="text" id="form_imput" name="name" value=""><br>
    <label for="lname">Rut:</label><br>
    <input size="35" type="text" id="form_imput" name="rut" value=""><br>
    <label for="fname">Correo:</label><br>
    <input size="35" type="text" id="form_imput" name="mail" value=""><br><br>

    <div id='sub_title_form'><b>Tipo</b><br></div>

    <select id='select' name='kind'>";
        <option value='Administrativo'>Administrativo</option>";
        <option value='Docente'>Docente</option>";
        <option value='Alumno'>Alumno</option>";
    </select><BR>
    <br>
    <input id="button_from" type="submit" value="Enviar" name="send">
</form>

