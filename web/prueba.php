<form action="#" method="post">
<input type="checkbox" name="check_list[]" value="C/C++"><label>C++</label><br/>
<input type="checkbox" name="check_list[]" value="Java"><label>Java</label><br/>
<input type="checkbox" name="check_list[]" value="PHP"><label>PHP</label><br/>
<input type="checkbox" name="check_list[]" value="jQuery"><label>jQuery</label><br/>
<input type="submit" name="submit" value="Enviar"/>
</form>
<?php
if(isset($_POST['submit'])){//Para ejecutar PHP script en Submit
if(!empty($_POST['check_list'])){
// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
foreach($_POST['check_list'] as $selected){
echo $selected."</br>";
}
}
}
?>