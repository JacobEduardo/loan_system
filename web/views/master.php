<?php $pagina = isset($_GET['page']) ? strtolower($_GET['page']) : 'inicio'; ?>

<div id="master">
    <div id="menu"> 
        <ul>
        <li><a> <?php echo $_SESSION['name'] ." " .$_SESSION['rut']; ?> </a> </li>   
        <li><a class="btn" href="db/close_session.php">Cerrar Sesion </a></li>   
        </ul>
    </div>
    <div id='sidebar_pages' class="flex-container">
        <div id="sidebar">
            <ul>
                <li><a href="?page=inicio">Inicio</a></li> 
                <li><a href="?page=admin">Administrasion</a></li>  
                <li><a href="#">Ocaso</a></li>
            </ul>
        </div>

        <div id="pages">
            <div  style="padding: 20px;">
                <?php  
                    require_once 'views/' .$pagina .'.php';
                ?>
            </div>
        </div>
    </div>
</div>