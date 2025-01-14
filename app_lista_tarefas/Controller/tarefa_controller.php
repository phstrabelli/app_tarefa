<?php

require_once "../app_lista_tarefas/Model/tarefa.model.php";
require_once "../app_lista_tarefas/View/tarefa.view.php";
require_once "../app_lista_tarefas/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {   
    session_start();

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);
    $tarefa->__set('data', $_POST['data']);
    $tarefa->__set('horario', $_POST['horario']);
    $tarefa->__set('obs', $_POST['obs']);
    $tarefa->__set('categ_id', $_POST['categ_id']);
    $tarefa->__set('id_user', $_SESSION['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();


    header('Location: todas_tarefas.php');

} else if ($acao == 'recuperar') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->recuperar();

}  else if($acao == 'atualizarStatus' || $acao == 'atualizarStatusPendente') {

    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->atualizarStatus($_GET['id']);
    
} else if($acao == 'remover') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->remover($_GET['id']);

} else if($acao == 'editar_titulo') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefa = $_GET['tarefa'];
    $id = $_GET['id'];
    $tarefas = $tarefaService->atualizar_titulo($tarefa, $id);

} else if($acao == 'editar_obs') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefa = $_GET['tarefa'];
    $id = $_GET['id'];
    $tarefas = $tarefaService->atualizar_obs($tarefa, $id);

} else if($acao == 'editar_data') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefa = $_GET['tarefa'];
    $id = $_GET['id'];
    $tarefas = $tarefaService->atualizar_data($tarefa, $id);

} else if($acao == 'editar_horario') {
    $tarefa = new Tarefa();

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefa = $_GET['tarefa'];
    $id = $_GET['id'];
    $tarefas = $tarefaService->atualizar_horario($tarefa, $id);

}