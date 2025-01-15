<?php $id = isset($_POST['id_importancia']) ? $_POST['id_importancia'] : '';

session_start();

$_SESSION['id_status'] = '';
$_SESSION['id_categ'] = '';
$_SESSION['id_importancia'] = $id;

$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';

if($id == 3)
    $titulo = 'Posso Fazer Depois';

if($id == 2)
    $titulo = 'Necessário';

if($id == 1)
    $titulo = 'Urgente';

?>

<div class="container app">
    <div class="pagina col-8">
        <div class="col-12">
            <h4><?= $titulo ?></h4>
            <div id="btnNewTask"> Nova tarefa <span>+</span></div>

            <?php require_once './components/order_menu.php'; ?>

            <div class="tarefas">
                <?php require 'sort_tasks.php'; ?>
            </div>
        </div>

    </div>
</div>