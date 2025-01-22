<?php
$currentPage = basename($_SERVER['PHP_SELF'])

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="./js/service.js"></script>
    <script src="./js/others.js"></script>
    <script src="./js/calendar.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body>
    <header class="header-tarefa container">
        <div id="logout">
            <form action="user_controller.php?acao=deslogar" method="post"">
                <button ></button>
            </form>
        </div>

        <div class=" menu-burguer d-lg-none">
                <span></span>
                <span></span>
                <span></span>
        </div>

        <div class="off-screen-menu d-lg-none">
            <div class="menu-hidden">
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
                        <li class="itens">
                            Conjuntas
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>