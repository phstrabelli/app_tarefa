<?php
session_start();
if (!isset($_SESSION['id']))
	header('Location: index.php')
?>


<?php include_once './components/header.php' ?>
<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1): ?>
	<div id='bg-success' class="bg-success pt-2 text-white d-flex justify-content-center">
		<h5>Tarefa Inserida Com Sucesso</h5>
		<div class="close"></div>
	</div>
<?php endif ?>
<main>
	<?php include_once './components/svg_bg.php' ?>

	<div class="container app">
		<div class="pagina">
			<div class="col-12">
				<h4>Nova tarefa</h4>
				<form method="post" action="tarefa_controller.php?acao=inserir" >
					<div class="form-group">
						<label for="inputNewTask">Descrição da tarefa:</label>
						<input type="text" id='inputNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">

						<label for="obs">Observação:</label>
						<textarea id="obs" name="obs"></textarea>

						<label for="data">Selecione a data:</label>
						<input name='data' id="data">

						<label for="horario">Selecione o horário:</label>
						<input type="time" id="horario" name="horario">
					</div>
					<button class="btn btn-success" id="btnNewTask">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
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
	
</script>
</body>

</html>