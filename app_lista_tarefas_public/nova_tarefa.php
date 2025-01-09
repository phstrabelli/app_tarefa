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
				<form method="post" action="tarefa_controller.php?acao=inserir">
					<div class="form-group">
						<label for="inputNewTask">Descrição da tarefa:</label>
						<input type="text" id='inputNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">

						<label for="data">Selecione a data:</label>
						<input type="date" id="data" name="data">

						<label for="horario">Selecione o horário:</label>
						<input type="time" id="horario" name="horario">

						<label for="obs">Observação:</label>
						<textarea id="obs" name="obs"></textarea>

					</div>
					<button class="btn btn-success" id="btnNewTask">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</main>

<script>
	$('#btnNewTask').on('click', (e) => {
		let horario = `${$('#data').val()} ${$('#horario').val()}:00`

		let now = new Date();

		const year = now.getFullYear();
		const month = String(now.getMonth() + 1).padStart(2, '0');
		const day = String(now.getDate()).padStart(2, '0');

		const hours = String(now.getHours()).padStart(2, '0');
		const minutes = String(now.getMinutes()).padStart(2, '0');
		const seconds = String(now.getSeconds()).padStart(2, '0');

		now = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

		const dateObj1 = new Date(now);
		const dateObj2 = new Date(horario);

		if (dateObj1 > dateObj2) {
			e.preventDefault()
		}
	})
</script>
</body>

</html>