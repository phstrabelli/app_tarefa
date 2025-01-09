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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <header id="tarefa-header">

        <nav class="container d-none d-md-flex">
            <div class="menu">
                <ul>
                    <li><a href="index.php" class="<?php echo ($currentPage == 'tarefas_pendentes.php') ? 'active' : ''; ?>">Tarefas pendentes</a></li>
                    <li><a href="nova_tarefa.php" class="<?php echo ($currentPage == 'nova_tarefa.php') ? 'active' : ''; ?>">Nova tarefa</a></li>
                    <li><a href="todas_tarefas.php" class="<?php echo ($currentPage == 'todas_tarefas.php') ? 'active' : ''; ?>">Todas tarefas</a></li>
                </ul>
            </div>
            <div id="logout">
                <form action="user_controller.php?acao=deslogar" method="post"">
                <button ></button>
            </form>
        </div>
    </nav>

    <div class=" container d-md-none">
                    <div id="burguer-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
            </div>
    </header>