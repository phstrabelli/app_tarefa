<?php
session_start();

if (!isset($_SESSION['id']))
	header('Location: index.php');

$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';
?>

<?php include_once './components/header.php' ?>

<main>
	<div id="logout">
		<form action="user_controller.php?acao=deslogar" method="post"">
            <button ></button>
        </form>
    </div>

	<?php include_once './components/svg_bg.php' ?>

	<form method="post" action="categ_controller.php?acao=inserir">
		<input name='categ' id="categ" type="text">
		<button>ada</button>
	</form>
	
	<div class="menu">
		<nav>
			<ul class="ul">
				<li class="itens" id="todas-tarefas">Todas</li>
				<li class="itens">
					Situação
					<ul class="menu-itens">
						<li status-id='2' class="status_li">Realizada</li>
						<li status-id='1' class="status_li">Pendente</li>
						<li status-id='3' class="status_li">Atrasada</li>
					</ul>
				</li>
				<li class="itens">
					Categorias
					<ul class="menu-itens">
						<?php foreach ($categorias as $categ): ?>
							<li categ-id="<?= $categ->id ?>" class="categ_li"><?= $categ->categ ?></li>
						<?php endforeach ?>
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

	<?php include_once './todas.php' ?>

	<?php include_once './components/confirmation_popup.php' ?>

	<?php include_once './components/newtask_popup.php'; ?>

</main>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
	$(document).ready(function() {
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

		$(document).on('click', '#btnNewTask', () => {
			$('#formNovaTarefa').fadeToggle()
		})

		$(document).on('click', '#formNovaTarefa', () => {
			$('#formNovaTarefa').fadeToggle()
		})

		$(document).on('click', '.form-nova-tarefa', function(e) {
			e.stopPropagation();
		});


		$('.categ_li').on('click', function(e) {
			let id = e.currentTarget.getAttribute('categ-id')

			$.ajax({
				url: 'categ.php',
				type: 'POST',
				data: {
					id_categ: id,
				},
				success: function(response) {

					$('.app').html(response);

					flatpickr('.calendario', {
						minDate: "today",
						clickOpens: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
						altInput: true
					});
				},
				error: function() {
					$('.app').html('Erro ao carregar o conteúdo.');
				}
			});
		})

		$('.status_li').on('click', function(e) {
			let id = e.currentTarget.getAttribute('status-id')

			$.ajax({
				url: 'status.php',
				type: 'POST',
				data: {
					id: id,
				},
				success: function(response) {

					$('.app').html(response);

					flatpickr('.calendario', {
						minDate: "today",
						clickOpens: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
						altInput: true
					});
				},
				error: function() {
					$('.app').html('Erro ao carregar o conteúdo.');
				}
			});
		})

		$('#todas-tarefas').on('click', function(e) {
			$.ajax({
				url: 'todas.php',
				type: 'POST',
				success: function(response) {

					$('.app').html(response);

					flatpickr('.calendario', {
						minDate: "today",
						clickOpens: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
						altInput: true
					});
				},
				error: function() {
					$('.app').html('Erro ao carregar o conteúdo.');
				}
			});
		})

		$(document).on('click', '.order-btn', function (e) {
			let order = e.currentTarget.id
			let tarefas = <?php echo json_encode($tarefas); ?>	
			
			$.ajax({
				url: 'sort_tasks.php',
				type: 'POST',
				data: {
					tarefas: tarefas,
					order: order,
				},
				success: function(response) {
					$('.tarefas').html(response)
					flatpickr('.calendario', {
						minDate: "today",
						clickOpens: true,
						altFormat: "F j, Y",
						dateFormat: "Y-m-d",
						altInput: true
					});
				},
				error: function() {
					$('.app').html('Erro ao carregar o conteúdo.');
				}
			});
		})
	})
</script>
</body>


</html>