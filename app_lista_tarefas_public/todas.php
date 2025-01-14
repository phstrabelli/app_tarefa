<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$_SESSION['id_status'] = '';
$_SESSION['id_categ'] = '';


$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';



?>
<div class="container app">
	<div class="pagina col-8">
		<div class="col-12">
			<h4>Todas as tarefas</h4>
			<div id="btnNewTask"> Nova tarefa <span>+</span></div>

			<?php require_once './components/order_menu.php';?>
			
			<div class="tarefas">
				<?php
					require 'sort_tasks.php';
				?>
			</div>
		</div>

	</div>
</div>