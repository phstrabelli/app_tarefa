<?php 
$id = isset($_POST['id']) ? $_POST['id'] : '';

session_start();

$_SESSION['id_status'] = $id;
$_SESSION['id_categ'] = '';

$acao = 'recuperar';
require 'tarefa_controller.php';

if($id == 1) {
    $titulo = 'pendentes';
}
if($id == 2) {
    $titulo = 'realizadas';
}
if($id == 3) {
    $titulo = 'atrasadas';
}

?>

<div class="container app">
    <div class="pagina col-8">
        <div class="col-12">
            <h4>Tarefas <?= $titulo?></h4>
            
            <div id="btnNewTask"> Nova tarefa <span>+</span></div>

            <?php require_once './components/order_menu.php';?>

            <div class="tarefas">
                <?php require 'sort_tasks.php'; ?> 
            </div>
        </div>

    </div>
</div>
