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

    public static function getInstance(): UsuarioRepository
    {
        $class = static::class;
        if (!isset($_intance[$class])) {
            $_intance[$class] = new static();
        }

        return $_intance[$class];
    }

    public function getMysqli(): mysqli
    {
        return $this->mysqli;
    }

    private function createTable(): void
    {
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

    public function getAllUsuarios(): array
    {
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
        $query = "SELECT * FROM {$this::$TABLENAME} WHERE id_usuario = ?";

        $sentencia = $this->mysqli->prepare($query);
        $sentencia->bind_param(
            "i",
            $id
        );

        if ( !$sentencia->execute() ){
            return null;
        }

        $sentencia->bind_result($id, $nombre, $email, $password);

        if ( !$sentencia->fetch() ){
            return null;
        }
        $usuario = new Usuario($id, $nombre, $email, $password);
        
        return $usuario;
    }

    public function createUsuario(string $nombre, string $email, string $password ): Usuario{
        $this->mysqli->begin_transaction();
        $query = 
        "INSERT INTO {$this::$TABLENAME}
            (nombre, email, password) 
        VALUES( ? , ? , ?)";

        $sentencia = $this->mysqli->prepare($query);

        $sentencia->bind_param(
            "sss", 
            $nombre, 
            $email, 
            $password
        );

        if (!$sentencia->execute()) {
            $this->mysqli->rollback();
            return null;
        }
        $newUsuario = new Usuario(-1, $nombre, $email, $password);

        $newUsuario->setIdUsuario($this->mysqli->insert_id);
        $this->mysqli->commit();
        return $newUsuario;
    }

    public function editUsuario(Usuario $usuario): void
    {
    }

    public function deleteUsario(int $id): void
    {
    }
}
