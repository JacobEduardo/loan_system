<?php $pagina = isset($_GET['page']) ? strtolower($_GET['page']) : 'inicio'; ?>

<div id="menu"> 
    <ul>
    <li><a> <?php echo $_SESSION['name'] ." " .$_SESSION['last_name']; ?> </a> </li>   
    <li><a class="btn" href="db/close_session.php">Cerrar Sesion </a></li>   
    </ul>
</div>

<div id="sidebar">
    <ul>
        <li><a href="?page=inicio">Inicio</a></li> 
        <li><a href="?page=admin">Administrasion</a></li>  
        <li><a href="#">Ocaso</a></li>
    </ul>
</div>

<div id="pages">
    <?php  
        require_once 'views/' .$pagina .'.php';
    ?>
</div>