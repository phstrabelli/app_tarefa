<?php
require_once "../app_lista_tarefas/Model/categ.model.php";
require_once "../app_lista_tarefas/View/categ.view.php";
require_once "../app_lista_tarefas/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    session_start();

    $categ = new Categ();

    $categ->__set('categ', $_GET['categ']);
    $user_id = $_SESSION['id'];

    $conexao = new Conexao();

    $categService = new CategService($conexao, $categ);
    
    $new_categ = $categService->inserir($user_id);

?>
    <div><?= $new_categ ?></div>
<?php
}else if ($acao == 'recuperar') {
    $categ = new Categ();

    $conexao = new Conexao();

    $categService = new CategService($conexao, $categ);

    $categorias = $categService->recuperar();
} else if ($acao == 'remover') {
    session_start();

    $categ = new Categ();

    $conexao = new Conexao();

    $categService = new CategService($conexao, $categ);

    $categService->remover($_POST['categ_id']);

    header('Location: todas_tarefas.php');
}
