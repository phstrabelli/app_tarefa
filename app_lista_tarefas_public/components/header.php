<?php
$currentPage = basename($_SERVER['PHP_SELF'])
?>
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

    <div class="container d-md-none">
        <div id="burguer-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>