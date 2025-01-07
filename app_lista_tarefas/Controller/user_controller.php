<?php
require_once "../app_lista_tarefas/Model/user.model.php";
require_once "../app_lista_tarefas/View/user.view.php";
require_once "../app_lista_tarefas/conexao.php";


$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
    $user = new User();
    $conexao = new Conexao();

    $senha = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user->__set('username', $_POST['username']);
    $user->__set('senha', $senha);
    $user->__set('email', $_POST['email']);
    $user->__set('nome', $_POST['nome']);

    $userService = new UserService($conexao, $user);

    $message = $userService->inserir();
    if($_SESSION['cadastro'] === 1) {
        header('Location: cadastro.php?inclusao=1');
    }
    if($_SESSION['cadastro'] === 0) {
        header('Location: cadastro.php?inclusao=0');
    }
} else if ($acao == 'buscar') {
    session_start();
    $user = new User();
    $conexao = new Conexao();

    $userService = new UserService($conexao, $user);
    $userData = $userService->buscar($_POST['username']);
    
    if (password_verify($_POST['password'], $userData->senha)) {
        $_SESSION['id'] = $userData->id;
        header('Location: tarefas_pendentes.php')   ;
    } else {
        header('Location: index.php?busca=0');
    }
} else if ($acao == 'deslogar') {
    session_start();

    session_unset();

    header('Location: index.php');
}
