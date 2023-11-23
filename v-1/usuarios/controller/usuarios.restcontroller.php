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

    case 'POST':
        $fieldsRequired = ['nombre', 'email', 'password'];

        //Definir variables
        $nombre = '';
        $email = '';
        $password = '';

        $json = file_get_contents('php://input');
        $entrada = json_decode($json, true);
        
        if ($entrada == null){
            header(HTTP_CODE_400);
            break;
        }

        foreach ($fieldsRequired as $key => $value) {
            if ( !isset($entrada[$value]) ){
                header(HTTP_CODE_400);
                exit();
            }
            $$value = $entrada[$value];
            // // $nombre = 
            // // $email = 
            // // $password = 
        }
        $usuario = $usuarioRepo->createUsuario(
            $nombre, 
            $email, 
            $password
        );
        echo json_encode($usuario);
        break;

    case 'PUT':
        # code...
        break;

    case 'DELETE':
        # code...
        break;
    
    default://Este va a reaccionar cono si fuera verbo OPTIONS
        # code...
        break;
}