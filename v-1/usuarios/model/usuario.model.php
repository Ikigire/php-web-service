<?php
    class Usuario {
        public int $id_usuario;
        public string $nombre;
        public string $email;
        public string $password;

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
    }