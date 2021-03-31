<?php  require_once 'C:\xampp\htdocs\loan_system\web\controllers\createuser.php'; ?>

<form onSubmit="return AddUser()"; >
    <div id='title_form'><b>Agregar Usuario</b><br></div>

    <label for="fname">Nombre:</label><br>
    <input size="35" type="text" id="form_imput" name="fname" value=""><br>
    <label for="lname">Apellidos:</label><br>
    <input size="35" type="text" id="form_imput" name="lname" value=""><br>
    <label for="lname">RUT:</label><br>
    <input size="35" type="text" id="form_imput" name="lname" value=""><br>
    <label for="lname">Nombre de Usuario:</label><br>
    <input size="35" type="text" id="form_imput" name="lname" value=""><br>
    <label for="lname">Contraseña:</label><br>
    <input size="35" type="text" id="form_imput" name="lname" value=""><br><br>

    <div id='sub_title_form'><b>Lugar</b><br></div>
    <?php  
        CreateSelecLocation();
    ?>

    <div id='sub_title_form'><b>Permisos</b><br></div>
    <?php  
        CreateCheckBoxs();
    ?>

    <br>
    <input type="submit" value="Submit">
</form>

<script>
Check();
function Check() {
    document.getElementById("1.1").checked = true;
}

</script>

<?php
function CreateCheckBoxs(){
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
                $txt1 = $txt1 ."<input type='checkbox' id='" .$row['MENU_CODE'] ."' name='vehicle1' value='Bike'><label for='vehicle1'>" .$row['MENU_NAME'] ."</label><br>";
            }
        }
        
        if($num == 2){
            if($y == 1){
                $txt2 = $txt2 ."<b>" .$row['MENU_NAME'] ."</b><br>";
                $y = 0;
            }else{
                $txt2 = $txt2 ."<input type='checkbox' id='vehicle1' name='vehicle1' value='Bike'><label for='vehicle1'>" .$row['MENU_NAME'] ."</label><br>";
            }
        }
        
        if($num == 3){
            if($z == 1){
                $txt3 = $txt3 ."<b>" .$row['MENU_NAME'] ."</b><br>";
                $z = 0;
            }else{
                $txt3 = $txt3 ."<input type='checkbox' id='vehicle1' name='vehicle1' value='Bike'><label for='vehicle1'>" .$row['MENU_NAME'] ."</label><br>";
            }
        }

    }
    echo $txt1;
    echo $txt2;
    echo $txt3;
}

function CreateSelecLocation(){
    echo "<select id='select' name='locations'>";
    $location =  GetAllLocation();
    foreach($location as $row){
        echo "<option>" .$row['NAME'] ."</option>";
    }
    echo "</select><BR><BR>";
}