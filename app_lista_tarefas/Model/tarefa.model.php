<?php 
class Tarefa {
    private $id;
    private $id_status;
    private $tarefa;
    private $data_cadastro;
    private $id_user;
    private $horario;
    private $data;
    private $obs;

    public function __get($attr) {
        return $this->$attr;
    }
    public function __set($attr, $value) {
        return $this->$attr = $value;
    }
}
?>