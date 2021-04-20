<?php
require_once 'C:\xampp\htdocs\loan_system\web\views\essential\header.php';
?>

<div>
    <div id="login">
        <form method="POST" action="user_validate.php" name="signup-form">
            <div id='title_form' >Iniciar sesión</div>
            <div class="form-element">
                <label>Username</label> </br>
                <input  style="width: 93%" id="form_imput" type="text" name="user" pleaceholder="ingrese su nombre de usuario"/>
            </div>
            <div class="form-element">
                <label>Password</label> </br>
                <input style="width: 93%"  id="form_imput" type="password" name="password" pleaceholder="ingrese su nombre de contraseña"/>
            </div>
            <div style="text-align:right;">
            <button style="margin-top: 10px;" id="button_from" type="submit" value="Ingresar">Ingresar</button>
            </div>
        </form>
    </div>
</div>