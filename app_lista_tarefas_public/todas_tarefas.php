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
	
	<div class=" menu">
			<nav>
				<ul class="ul">
					<li class="itens li_hover" id="todas-tarefas">Todas</li>
					<li class="itens">
						Situação
						<ul class="menu-itens">
							<li status-id='2' class="status_li li_hover">Realizada</li>
							<li status-id='1' class="status_li li_hover">Pendente</li>
							<li status-id='3' class="status_li li_hover">Atrasada</li>
						</ul>
					</li>
					<li class="itens">
						Categorias
						<ul class="menu-itens">
							<?php foreach ($categorias as $categ): ?>
								<li categ-id="<?= $categ->id ?>" class="categ_li li_hover"><?= $categ->categ ?></li>
							<?php endforeach ?>
						</ul>
					</li>
					<li class="itens">
						Importancia
						<ul class="menu-itens">
							<li class="importancia_li li_hover" importancia-id='1'>Urgente</li>
							<li class="importancia_li li_hover" importancia-id='2'>Necessário</li>
							<li class="importancia_li li_hover" importancia-id='3'>Posso Fazer Depois</li>
						</ul>
					</li>
				</ul>
			</nav>
	</div>

	<?php include_once './todas.php' ?>

	<?php include_once './components/confirmation_popup.php' ?>

	<?php include_once './components/newtask_popup.php'; ?>
	<div class="response"></div>
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

		$(document).on('click', '#categ-btn', function(e) {
			let categ = $("#categ").val()
			if (categ) {
				$.ajax({
					url: 'categ_controller.php',
					type: 'GET',
					data: {
						categ: categ,
						acao: 'inserir'
					},
					success: function(response) {
						let value = $(response).text()
						console.log(value)
						$('#categ_id').append('<option value="' + value + '">' + categ + '</option>');
					},
					error: function() {
						$('.app').html('Erro ao carregar o conteúdo.');
					}
				});
			}
		})

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

		$('.importancia_li').on('click', function(e) {
			let id = e.currentTarget.getAttribute('importancia-id')

			$.ajax({
				url: 'importancia.php',
				type: 'POST',
				data: {
					id_importancia: id,
				},
				success: function(response) {

					$('.app').html(response);

					console.log(response)

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

		$(document).on('click', '.order-btn', function(e) {
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

		$(document).on('click', '.importancia-p', function(e) {
			e.currentTarget.style.display = 'none';
			let value = $(e.currentTarget).attr('value')
			let select = $(e.currentTarget).siblings('.importancia-select')[0]

			$(select).val(value)
			select.style.display = 'block';
			select.focus()
		})

		$(document).on('blur', '.importancia-select', function(e) {
			e.currentTarget.style.display = 'none';
			let p = $(e.currentTarget).siblings('.importancia-p')[0]
			let value = $(e.currentTarget).val()
			let text = $(this).find('option:selected').text()

			$(p).attr('value', value)
			$(p).text(text)

			p.style.display = 'block';
		})

		$(document).on('click', '.categ-p', function(e) {
			e.currentTarget.style.display = 'none';
			let value = $(e.currentTarget).attr('value')
			let select = $(e.currentTarget).siblings('.categ-select')[0]

			$(select).val(value)
			select.style.display = 'block';
			select.focus()
		})

		$(document).on('blur', '.categ-select', function(e) {
			e.currentTarget.style.display = 'none';
			let p = $(e.currentTarget).siblings('.categ-p')[0]
			let value = $(e.currentTarget).val()
			let text = $(this).find('option:selected').text()

			$(p).attr('value', value)
			$(p).text(text)
			if($(p).text() == '')
				$(p).text('Nenhuma Categoria')	
			
			p.style.display = 'block';
		})

		$(document).on('click','.span-new-categ', function(e) {
			$(e.currentTarget).css('margin-top', '0')
			$(e.currentTarget).css('margin-bottom', '.5rem')
			$('#categ_id').css('display','none')
			$('#categ-label').css('display','none')	
			$('#form-new-categ').css('display', 'flex')
			$('.categ-div').css('height', '103px')
			$('.importancia-div').css('height', '103px')
		})

		$(document).on('click', '#categ-btn', function(e) {
			$('.span-new-categ').css('margin-top', '10px')
			$('.span-new-categ').css('margin-bottom', '0')
			$('#categ_id').css('display','block')
			$('#categ-label').css('display','block')	
			$('#form-new-categ').css('display', 'none')
			$('.categ-div').css('height', 'fit-content')
			$('.importancia-div').css('height', 'fit-content')
		})
	})
</script>
</body>


</html>