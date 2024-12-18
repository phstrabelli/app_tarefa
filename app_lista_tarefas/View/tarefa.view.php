<?php
class TarefaService
{
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir()
    {
        $query = 'insert into tb_tarefas(tarefa, id_user)values(:tarefa, :id_user)';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id_user', $this->tarefa->__get('id_user'));

        $stmt->execute();
    }
    public function recuperar()
    {   
        $query = '
            select 
                t.id, t.id_user, s.status, t.tarefa
            from 
                tb_tarefas as t
                left join tb_status as s on(t.id_status = s.id) 
            where
                t.id_user = :id_user
            ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id_user', $_SESSION['id']);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizar($post)
    {
        $query = '
            update 
                tb_tarefas
            set
                tarefa = :tarefa
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $post['form-control']);
        $stmt->bindValue(':id', $post['id']);

        $stmt->execute();
    }
    public function atualizarStatus($id)
    {
        $queryBusca = '
            select
                *
            from
                tb_tarefas
            where
                id = :id';

        $stmt = $this->conexao->prepare($queryBusca);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_OBJ)->id_status;


        $id_status = $status == 1 ? 2 : 1;

        $queryUpdate = '
            update 
                tb_tarefas
            set
                id_status = :id_status
            where
                id = :id';

        $stmt = $this->conexao->prepare($queryUpdate);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':id_status', $id_status);
        $stmt->execute();

        $response = $id_status;

        echo json_encode($response);
    }
    public function remover($id)
    {
        $query = '
            update 
                tb_tarefas
            set
                id_status = 0
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $response = $id;
        echo json_encode($response);
    }
}
