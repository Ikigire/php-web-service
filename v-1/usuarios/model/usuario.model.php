<?php
   class Usuario {
    private int $id_usuario;
    private string $nombre;
    private string $email;
    private string $password;

    public function __construct(
        int $id_usuario = -1,
        string $nombre,
        string $email,
        string $password
    ) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    // Métodos get y set para id_usuario

    public function getIdUsuario(): int {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): void {
        $this->id_usuario = $id_usuario;
    }

    // Métodos get y set para nombre

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    // Métodos get y set para email

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    // Métodos get y set para password

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}