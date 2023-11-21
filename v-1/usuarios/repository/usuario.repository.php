<?php
require_once("./v-1/usuarios/model/usuario.model.php");

class UsuarioRepository
{
    private static $_intance = [];

    private static $TABLENAME = "usuarios";

    private mysqli $mysqli;

    private function __construct()
    {
        $host = $_ENV['DB_HOST'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];
        $this->mysqli = new mysqli($host, $user, $password, $database);
        $this->createTable();
    }

    public static function getInstance(): UsuarioRepository {
        $class = static::class;
        if (!isset($_intance[$class])) {
            $_intance[$class] = new static();
        }

        return $_intance[$class];
    }

    public function getMysqli(): mysqli {
        return $this->mysqli;
    }

    private function createTable(): void {
        $table = $this::$TABLENAME;
        $query = "
            CREATE TABLE IF NOT EXISTS $table(
                id_usuario bigint NULL AUTO_INCREMENT,
                nombre varchar(255) NOT NULL,
                email varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                PRIMARY KEY (id_usuario),
                UNIQUE (email)
            )
        ";

        $sentencia = $this->mysqli->prepare($query);

        $sentencia->execute();

        $sentencia->close();
    }

    public function getAllUsuarios(): array {
        $query = "SELECT * FROM {$this::$TABLENAME}";

        $sentencia = $this->mysqli->prepare($query);

        $usuarios = array();
        
        $sentencia->execute();

        $sentencia->bind_result($id, $nombre, $email, $password);

        while ($sentencia->fetch()) {
            $usuario = new Usuario($id, $nombre, $email, $password);
            $usuarios[] = $usuario;
        }

        return $usuarios;
    }

    public function getUsuarioById(int $id): Usuario {

    }

    public function createUsuario(Usuario $usuario): Usuario {

    }

    public function editUsuario(Usuario $usuario): Usuario {

    }

    public function deleteUsario(int $id): Usuario {

    }
}
