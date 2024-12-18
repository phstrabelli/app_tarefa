<?php

session_start();
if (!isset($_SESSION['id'])) 	
	header('Location: index.php');

$acao = 'recuperar';
require 'tarefa_controller.php';
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
	<script src="./js/service.js"></script>
	<script src="./js/others.js"></script>
</head>

<body>
	<?php include_once './components/header.php'?>
	<?php if (isset($_GET['alteracao']) && $_GET['alteracao'] == 1): ?>
		<div id='bg-success' class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Alteração Realizada Com Sucesso</h5>
			<div class="close"></div>
		</div>
	<?php endif ?>
	<div class="container app">
		<div class="row">
			<div class="col-md-3 menu">
				<ul class="list-group">
					<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
					<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
					<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
				</ul>
			</div>

			<div class="col-md-9">
				<div class="container pagina">
					<div class="row">
						<div class="col">
							<h4>Tarefas pendentes</h4>
							<hr />
							<?php foreach ($tarefas as $tarefa) : ?>
								<?php if ($tarefa->status == 'pendente') : ?>
									<div class="row mb-3 d-flex align-items-center tarefa" id="tarefaDiv_<?= $tarefa->id ?>">
										<div class="col-sm-9" id='tarefa_<?= $tarefa->id ?>'><?= $tarefa->tarefa ?></div>
										<div class="col-sm-3 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remove(<?= $tarefa->id ?>, 'remover')"></i>
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>',event)"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick="checkAndRemove(<?= $tarefa->id ?>, 'atualizarStatusPendente')"></i>
										</div>
									</div>
								<?php endif ?>
							<?php endforeach ?>
						</div>
					</div>
					<div id="confirmationPopup" class="popup">
						<div class="popup-content">
							<p>Are you sure you want to proceed?</p>
							<button id="yesBtn">Yes</button>
							<button id="noBtn">No</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>


</html>