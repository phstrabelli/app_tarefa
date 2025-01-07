<?php
session_start();
if (!isset($_SESSION['id']))
	header('Location: index.php')
?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App Lista Tarefas</title>

	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="./js/others.js"></script>
</head>

<body>
	<?php include_once './components/header.php' ?>
	<?php if (isset($_GET['inclusao']) && $_GET['inclusao'] == 1): ?>
		<div id='bg-success' class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Tarefa Inserida Com Sucesso</h5>
			<div class="close"></div>
		</div>
	<?php endif ?>
	<div class="container app">
		<div class="pagina">
			<div class="col-12">
				<h4>Nova tarefa</h4>

				<form method="post" action="tarefa_controller.php?acao=inserir">
					<div class="form-group">
						<label>Descrição da tarefa:</label>
						<input type="text" id='inputNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">
					</div>

					<button class="btn btn-success" id="btnNewTask">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>