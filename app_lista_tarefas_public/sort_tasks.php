<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_status = isset($_SESSION['id_status']) ? $_SESSION['id_status'] : '';
$id_categ = isset($_SESSION['id_categ']) ? $_SESSION['id_categ'] : '';

$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';

$order = isset($_POST['order']) ? $_POST['order'] : 'dat-asc';

if ($order == 'dat-asc') {
    usort($tarefas, function ($a, $b) {
        return strtotime($a->data . ' ' . $a->horario) - strtotime($b->data . ' ' . $b->horario);
    });
} else if ($order == 'dat-desc') {
    usort($tarefas, function ($a, $b) {
        return strtotime($b->data . ' ' . $b->horario) - strtotime($a->data . ' ' . $a->horario);
    });
} else if ($order == 'az') {
    usort($tarefas, function ($a, $b) {
        return strcmp($a->tarefa, $b->tarefa);
    });
} else if ($order == 'za') {
    usort($tarefas, function ($a, $b) {
        return strcmp($b->tarefa, $a->tarefa);
    });
}

?>

<?php if ($id_status == '' && $id_categ == '') : ?>
    <?php foreach ($tarefas as $tarefa) : ?>
        <?php
        $tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;

        $dataTarefa = new DateTime($tarefaHorario);
        ?>

        <?php require './components/tarefas.php' ?>

    <?php endforeach ?>
<?php endif ?>

<?php if ($id_status != '') : ?>
    <?php foreach ($tarefas as $tarefa) : ?>
        <?php
        date_default_timezone_set('America/Sao_Paulo');

        $currentDateTime = new DateTime();

        $tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;

        $dataTarefa = new DateTime($tarefaHorario);

        $status = $currentDateTime < $dataTarefa ? $tarefa->status : 'atrasado';
        ?>
        <?php if (isset($id_status) && $id_status != 3): ?>
            <?php if ($tarefa->id_status == $id_status) : ?>
                <?php require './components/tarefas.php' ?>
            <?php endif; ?>
        <?php else : ?>
            <?php if ($status == 'atrasado') : ?>
                <?php require './components/tarefas.php' ?>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

<?php if ($id_categ != '') : ?>
    <?php foreach ($tarefas as $tarefa) : ?>
        <?php
        $tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;

        $dataTarefa = new DateTime($tarefaHorario);
        ?>
        <?php if ($tarefa->categ_id == $id_categ) : ?>
            <div class="tarefa" id="tarefaDiv_<?= $tarefa->id ?>">
                <div id='tarefa_<?= $tarefa->id ?>' class="tarefa-title" contenteditable><?= $tarefa->tarefa ?></div>

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
<?php endif ?>