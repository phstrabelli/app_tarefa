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
        $query = 'insert into tb_tarefas(tarefa, id_user,data,horario, obs, categ_id, importancia_id)values(:tarefa, :id_user, :data, :horario, :obs,:categ_id, :importancia_id)';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id_user', $this->tarefa->__get('id_user'));
        $stmt->bindValue(':data', $this->tarefa->__get('data'));
        $stmt->bindValue(':horario', $this->tarefa->__get('horario'));
        $stmt->bindValue(':obs', $this->tarefa->__get('obs'));
        $stmt->bindValue(':categ_id', $this->tarefa->__get('categ_id'));
        $stmt->bindValue(':importancia_id', $this->tarefa->__get('importancia_id'));

        $stmt->execute();

        return $this->conexao->lastInsertId();

    }
    public function recuperar()
    {
        $query = '
            select 
                t.id, t.id_user, s.status, t.tarefa, t.data, t.horario,t.obs, t.categ_id, t.id_status, t.importancia_id
            from 
                tb_tarefas as t
                left join tb_status as s on(t.id_status = s.id) 
            where
                t.id_user = :id_user AND t.id_status != 0 
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
    public function atualizar_titulo($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                tarefa = :tarefa    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':tarefa', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
    public function atualizar_obs($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                obs = :obs    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':obs', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
    public function atualizar_data($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                data = :data    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':data', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
    public function atualizar_horario($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                horario = :horario    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':horario', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    public function atualizar_importancia($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                importancia_id = :importancia    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':importancia', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }
    public function atualizar_categ($tarefa, $id)
    {
        $query = '
            update 
                tb_tarefas
            set
                categ_id = :categ    
            where
                id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':categ', $tarefa);
        $stmt->bindValue(':id', $id);

        $stmt->execute();
    }

    public function convidar($email, $tarefa)
    {
        $query = '
        select
                *
            from
                tb_usuarios
            where
                email = :email';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        $query2 = 'insert into tb_tarefas_conjuntas( id_usuario_recebe, id_tarefa)values( :id_recebe, :id_tarefa)';

        $stmt2 = $this->conexao->prepare($query2);

        $stmt2->bindValue(':id_recebe', $stmt->fetch(PDO::FETCH_OBJ)->id);
        $stmt2->bindValue(':id_tarefa', $tarefa);

        $stmt2->execute();
    }

    public function recuperar_notificacao() {
        $query = '
            select 
                *   
            from 
                tb_tarefas_conjuntas as t
                left join tb_tarefas on(t.id_tarefa = tb_tarefas.id) 
                left join tb_usuarios on(tb_usuarios.id = tb_tarefas.id_user) 
            where
                t.id_usuario_recebe = :id_user AND t.status != 0 
            ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id_user', $_SESSION['id']);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizarStatusInvite($id)
    {

        $queryBusca = '
            select
                *
            from
                tb_tarefas_conjuntas
            where
                id_conjunto = :id';

        $stmt = $this->conexao->prepare($queryBusca);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $status = $stmt->fetch(PDO::FETCH_OBJ)->status;


        $id_status = $status == 1 ? 2 : 1;

        $queryUpdate = '
            update 
                tb_tarefas_conjuntas
            set
                status = :id_status
            where
                id_conjunto = :id';

        $stmt = $this->conexao->prepare($queryUpdate);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':id_status', $id_status);
        $stmt->execute();

        $response = $id_status;

        echo json_encode($response);
    }
    public function removerInvite($id)
    {
        $query = '
            update 
                tb_tarefas_conjuntas
            set
                status = 0
            where
                id_conjunto = :id';

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $response = $id;
        echo json_encode($response);
    }
    public function verificarConvites($id)
    {
        $queryBusca = '
            select
                *
            from
                tb_tarefas_conjuntas
            where
                id_tarefa = :id 
            AND 
                status = 1';

        $stmt = $this->conexao->prepare($queryBusca);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return print_r($stmt->fetch(PDO::FETCH_OBJ));

    }
}
