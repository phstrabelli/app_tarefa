<?php

class UserService
{
    private $conexao;
    private $user;

    public function __construct(Conexao $conexao, User $user)
    {
        $this->conexao = $conexao->conectar();
        $this->user = $user;
    }

    public function inserir()
    {   
        session_start();

        try {
            $query = 'insert into tb_usuarios(username, nome, email, senha)values(:username, :nome, :email, :senha)';

            $stmt = $this->conexao->prepare($query);

            $stmt->bindValue(':username', $this->user->__get('username'));
            $stmt->bindValue(':nome', $this->user->__get('nome'));
            $stmt->bindValue(':email', $this->user->__get('email'));
            $stmt->bindValue(':senha', $this->user->__get('senha'));

            $stmt->execute();

            $_SESSION['return_message'] = 'Usuário cadastrado com sucesso.';
        } catch (PDOException $e) {
            if ($e->getCode() == 23000 && strpos($e->getMessage(), '1062 Duplicate entry') !== false) {
                $_SESSION['return_message'] = "The username you have chosen is already taken. Please choose another one.";
            } else {
                $_SESSION['return_message'] = "An error occurred. Please try again later.";
            }
        }
    }

    public function buscar($username)
    {   
        session_start();

        $query = '
        select 
            *
        from 
            tb_usuarios
        where
            username = :username
        ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':username', $username);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
