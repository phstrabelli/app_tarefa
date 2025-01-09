<?php

session_start();
if (!isset($_SESSION['id']))
	header('Location: index.php');

$acao = 'recuperar';
require 'tarefa_controller.php';
?>

<?php include_once './components/header.php' ?>

<?php if (isset($_GET['alteracao']) && $_GET['alteracao'] == 1): ?>
	<div id='bg-success' class="bg-success pt-2 text-white d-flex justify-content-center">
		<h5>Alteração Realizada Com Sucesso</h5>
		<div class="close"></div>
	</div>
<?php endif ?>

<main>
	<?php include_once './components/svg_bg.php' ?>

	<div class="container app">
		<div class="pagina col-8">
			<div class="col-12">
				<h4>Tarefas pendentes</h4>
				<div class="tarefas">
					<?php 
						usort($tarefas, function($a, $b) {
							return strtotime($a->data . ' ' . $a->horario) - strtotime($b->data . ' ' . $b->horario);
						});
					?>
					<?php foreach ($tarefas as $tarefa) : ?>
						<?php
							date_default_timezone_set('America/Sao_Paulo');

							$currentDateTime = new DateTime();

							$tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;

							$dataTarefa = new DateTime($tarefaHorario);

							$status = $currentDateTime < $dataTarefa ? $tarefa->status : 'atrasado';
						?>
						<?php if ($tarefa->status == 'pendente' && $status != 'atrasado') : ?>
							<div class="tarefa" id="tarefaDiv_<?= $tarefa->id ?>">
								<div id='tarefa_<?= $tarefa->id ?>' class="tarefa-title" contenteditable><?= $tarefa->tarefa ?></div>
								<div class="tarefa-data">
									<p id='tarefaData_<?= $tarefa->id ?>'><?= date('H:i', strtotime($tarefa->horario)) ?></p>
									<p id='tarefaHorario_<?= $tarefa->id ?>'>
										<?php
										$data = new DateTime($tarefa->data);
										echo $data->format('d/m/Y');
										?>
									</p>
								</div>
								<div class="tarefa-obs">
									<p id='tarefaObs_<?= $tarefa->id ?>' class="content-tarefa-obs" contenteditable><?= $tarefa->obs?></p>
								</div>

								<div class="tarefa-options">
									<div class="pontinhos"><img  src="./img/mostrar-mais-botao-com-tres-pontos.png" alt=""></div>
									<div class="icons">
										<i class="fas fa-trash-alt  " onclick="remove(<?= $tarefa->id ?>, 'remover')">Excluir</i>
										<i class="fas fa-check-square  " onclick="checkAndRemove(<?= $tarefa->id ?>, 'atualizarStatusPendente')">Concluido</i>
									</div>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>

		</div>
	</div>
	<?php include_once './components/confirmation_popup.php' ?>
</main>
</body>


</html>