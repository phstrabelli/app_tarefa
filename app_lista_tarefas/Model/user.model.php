<?php
class User {
    private $id;
    private $username;
    private $nome;
    private $email;
    private $senha;

    public function __get($attr) {
        return $this->$attr;
    }
    public function __set($attr, $value) {
        return $this->$attr = $value;
    }
}
