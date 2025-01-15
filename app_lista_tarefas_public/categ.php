<?php $id = isset($_POST['id_categ']) ? $_POST['id_categ'] : '';

session_start();

$_SESSION['id_status'] = '';
$_SESSION['id_importancia'] = '';
$_SESSION['id_categ'] = $id;

$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';
?>

<div class="container app">
    <div class="pagina col-8">
        <div class="col-12">
            <?php foreach ($categorias as $categ): ?>
                <?php if ($categ->id == $id): ?>
                    <h4><?= $categ->categ ?></h4>
                <?php endif ?>
            <?php endforeach ?>
            <div id="btnNewTask"> Nova tarefa <span>+</span></div>

            <?php require_once './components/order_menu.php';?> 

            <div class="tarefas">
                <?php require 'sort_tasks.php';?>
            </div>
        </div>

    </div>
</div>