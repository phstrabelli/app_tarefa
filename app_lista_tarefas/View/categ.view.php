<?php
class CategService
{
    private $conexao;
    private $categ;

    public function __construct(Conexao $conexao, Categ $categ)
    {
        $this->conexao = $conexao->conectar();
        $this->categ = $categ;
    }

    public function inserir($user_id)
    {
        $query = 'insert into tb_categ(categ)values(:categ)';

        $stmt1 = $this->conexao->prepare($query);

        $stmt1->bindValue(':categ', $this->categ->__get('categ'));
        
        $stmt1->execute();


        $query = '
        select *from tb_categ ORDER BY id DESC LIMIT 1
        ';
        $stmt2 = $this->conexao->prepare($query);
        $stmt2->execute();

        $categ = $stmt2->fetch(PDO::FETCH_OBJ)->id;
        

        $query = '
        insert into tb_usuarios_categ(usuario_id, categ_id)values(:user_id, :categ_id)
        ';

        $stmt3 = $this->conexao->prepare($query);
        
        $stmt3->bindValue(':categ_id', $categ);
        $stmt3->bindValue(':user_id', $user_id);
        
        $stmt3->execute();

        return $categ;
    }

    public function recuperar()
    {   
        $query = '
            select 
                user_categ.categ_id, categ.id, categ.categ
            from 
                tb_usuarios_categ as user_categ
                left join tb_categ as categ on(user_categ.categ_id = categ.id) 
            where
                user_categ.usuario_id = :id_user
            ';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id_user', $_SESSION['id']);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
