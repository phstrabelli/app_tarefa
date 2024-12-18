<?php

require_once "../app_lista_tarefas/Model/tarefa.model.php";
require_once "../app_lista_tarefas/View/tarefa.view.php";
require_once "../app_lista_tarefas/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {   
    session_start();

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefa->__set('id_user', $_SESSION['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();


    header('Location: nova_tarefa.php?inclusao=1');

} else if ($acao == 'recuperar') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->recuperar();

} else if($acao == 'atualizar') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefa = $_POST;
    $tarefas = $tarefaService->atualizar($tarefa);

    header('Location: todas_tarefas.php?alteracao=1');

} else if($acao == 'atualizarStatus' || $acao == 'atualizarStatusPendente') {

    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->atualizarStatus($_GET['id']);
    
} else if($acao == 'remover') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->remover($_GET['id']);
}
