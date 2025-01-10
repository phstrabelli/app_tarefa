<?php

session_start();
if (!isset($_SESSION['id']))
	header('Location: index.php');

$acao = 'recuperar';
require 'tarefa_controller.php';
?>

<?php include_once './components/header.php' ?>

<main>
	<?php include_once './components/svg_bg.php' ?>

	<div class="menu">
		<nav>
			<ul class="ul">
				<li class="itens">Todas</li>
				<li class="itens">
					Situação
					<ul class="menu-itens">
						<li>Realizada</li>
						<li>Pendente</li>
						<li>Atrasada</li>
					</ul>
				</li>
				<li class="itens">
					Categorias
					<ul class="menu-itens">
						<li>Estudos</li>
						<li>Trabalho</li>
						<li>Lazer</li>
					</ul>
				</li>
				<li class="itens">
					Importancia
					<ul class="menu-itens">
						<li>Urgente</li>
						<li>Necessário</li>
						<li>Posso Fazer Depois</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
	<div class="container app">
		<div class="pagina col-8">
			<div class="col-12">
				<h4>Tarefas pendentes</h4>
				<div id="btnNewTask"> Nova tarefa <span>+</span></div>	

				<div class="tarefas">
					<?php
					usort($tarefas, function ($a, $b) {
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
								<div id='tarefa_<?= $tarefa->id ?>' class="tarefa-title" contenteditable ><?= $tarefa->tarefa ?></div>
								
								<div class="tarefa-obs">
									<p id='tarefaObs_<?= $tarefa->id ?>' class="content-tarefa-obs" contenteditable><?= $tarefa->obs ?></p>
								</div>

								<div class="tarefa-data">
									<input id='tarefaData_<?= $tarefa->id ?>' type="text" class='calendario' value="<?= $tarefa->data ?>">
									<input id='tarefaHorario_<?= $tarefa->id ?>' type="time" id="horario" name="horario" class='horario' value="<?= date('H:i', strtotime($tarefa->horario)) ?>">
								</div>


								<div class="tarefa-options">
									<div class="pontinhos"><img src="./img/mostrar-mais-botao-com-tres-pontos.png" alt=""></div>
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
	<?php include_once './components/newtask_popup.php' ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
	const datePicker = flatpickr('#data', {
		minDate: "today",
		clickOpens: true,
		altFormat: "F j, Y",
		dateFormat: "Y-m-d",
		altInput: true,
	})
	const timePicker = flatpickr('#horario', {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i",
		time_24hr: true
	})
	const calendario = flatpickr('.calendario', {
		minDate: "today",
		clickOpens: true,
		altFormat: "F j, Y",
		dateFormat: "Y-m-d",
		altInput: true,
	})

	$('#btnNewTask').on('click', () => {
		$('#formNovaTarefa').fadeToggle()
	})

	$('#formNovaTarefa').on('click', () => {
		$('#formNovaTarefa').fadeToggle()
	})

	$('.form-nova-tarefa').on('click', function(e) {
		e.stopPropagation();
	});
</script>
</body>


</html>