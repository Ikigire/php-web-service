<?php

require_once("./v-1/usuarios/repository/usuario.repository.php");

$usuarioRepo = UsuarioRepository::getInstance();

switch ($request_method) {
    case 'GET':
        if ( isset($path_components[$path_index + 1])) {
            if ($path_components[$path_index + 1] != "byid"){
                header(HTTP_CODE_400);
                break;
            }
            
            $id = $path_components[$path_index + 2];
            // TODO: completar busqueda por ID
            break;
        }
        $usuarios = $usuarioRepo->getAllUsuarios();
        echo json_encode($usuarios);
        break;
    
    default:
        # code...
        break;
}