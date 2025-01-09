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
		<div class="pagina">
			<div class="col-12">
				<h4>Todas tarefas</h4>
				<div class="tarefas">
					<?php foreach ($tarefas as $tarefa) : ?>
						<?php if ($tarefa->status != 0) : ?>
							<div class="tarefa" id="tarefaDiv_<?= $tarefa->id ?>">
								<div id='tarefa_<?= $tarefa->id ?>' class="tarefa-title">
									<?php
										date_default_timezone_set('America/Sao_Paulo');
										$currentDateTime = new DateTime();
										$tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;
										$dataTarefa = new DateTime($tarefaHorario);
										if ($currentDateTime > $dataTarefa && $tarefa->status == 'pendente') {
											$status = 'atrasado';
										} else {
											$status = $tarefa->status;
										}
									?>
									<?= $tarefa->tarefa ?> <span id='status_<?= $tarefa->id ?>' class="status">(<?= $status ?>)</span>
								</div>
								<div class="tarefa-data">
									<p><?= date('H:i', strtotime($tarefa->horario)) ?></p>
									<p>
										<?php
										$data = new DateTime($tarefa->data);
										echo $data->format('d/m/Y');
										?>
									</p>
								</div>
								<div>
									<i class="fas fa-trash-alt fa-lg text-danger" onclick="remove(<?= $tarefa->id ?>, 'remover')"></i>
									<i class="fas fa-edit fa-lg text-info " onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>',event)"></i>
									<i class="fas fa-check-square fa-lg text-success" onclick="checkAndRemove(<?= $tarefa->id ?>, 'atualizarStatus')"></i>
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