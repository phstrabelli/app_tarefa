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
            <div class="categ-title">
                <?php foreach ($categorias as $categ): ?>
                    <?php if ($categ->id == $id): ?>
                        <h4><?= $categ->categ ?></h4>
                    <?php endif ?>
                <?php endforeach ?>
                <form method='post' action="categ_controller.php?acao=remover" id="formRemoveCateg">
                    <input type="hidden" value="<?= $id ?>" name="categ_id">
                    <button class="fas fa-trash-alt  " id="btnDeleteCateg"></button>
                </form>
            </div>
            
            <div class="extra-btns">
				<div id="btnNewTask"> Nova tarefa <span>+</span></div>
	
				<?php require_once './components/order_menu.php';?>
			</div>

            <div class="tarefas">
                <?php require 'sort_tasks.php'; ?>
            </div>
        </div>

    </div>
</div>