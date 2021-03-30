<?php $pagina = isset($_GET['page']) ? strtolower($_GET['page']) : 'inicio'; ?>

<div id="master">
    <div id="menu"> 
        <ul>
        <li><a> <?php echo $_SESSION['name'] ." " .$_SESSION['last_name']; ?> </a> </li>   
        <li><a class="btn" href="db/close_session.php">Cerrar Sesion </a></li>   
        </ul>
    </div>
    <div id='sidebar_pages' class="flex-container">
        <div id="sidebar">
            <ul id="left_menu">
                
                <?php

                    CreateMenu();

                ?>

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

<?php

function CreateMenu(){
    $permits = GetMenu($_SESSION['permits']);
    $x = 1;
    $y = 1;
    $z = 1;
    $txt1 = "";
    $txt2 = "";
    $txt3 = "";
    foreach($permits as $row){
        $num = substr($row['MENU_CODE'] , 0, 1);

        if($num == 1){
            while($x == 1){
                $txt1 = $txt1 ."<li><a class='active'>Inicio</a></li>";
                $x = 0;
            }
            $txt1 = $txt1 ."<li><a href=" .$row['MENU_CODE'] .">" .$row['MENU_NAME'] .'</a></li>' ;
        }

        if($num == 2){
            while($y == 1){
                $txt2 = $txt2 ."<li><a class='active'>Historial</a></li>" ;
                $y = 0;
            }
            $txt2 = $txt2 ."<li><a href=" .$row['MENU_CODE'] .">" .$row['MENU_NAME'] .'</a></li>' ;
        }
        
        if($num == 3){
            while($z == 1){
                $txt3 = $txt3 ."<li><a class='active'>Administracion</a></li>" ;
                $z = 0;
            }
            $txt3 = $txt3 ."<li><a href=" .$row['MENU_CODE'] .">" .$row['MENU_NAME'] .'</a></li>' ;
        }
    }
    echo $txt1;
    echo $txt2;
    echo $txt3;
}
