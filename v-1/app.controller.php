<?php
    if ( !isset($path_components[$path_index]) ){
        header(HTTP_CODE_400);
        exit();
    }

    switch ($path_components[$path_index]) {
        case 'tareas':
            require_once("");
            break;
        
        case 'usuarios':
            require_once("./v-1/usuarios/controller/usuarios.restcontroller.php");
            break;

        case 'auth':
            require_once("");
            break;
            
        default:
            header(HTTP_CODE_404);
            break;
    }