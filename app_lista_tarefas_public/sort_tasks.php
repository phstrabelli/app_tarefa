<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_status = isset($_SESSION['id_status']) ? $_SESSION['id_status'] : '';
$id_categ = isset($_SESSION['id_categ']) ? $_SESSION['id_categ'] : '';
$id_importancia = isset($_SESSION['id_importancia']) ? $_SESSION['id_importancia'] : '';

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

<?php if ($id_status == '' && $id_categ == '' && $id_importancia == '') : ?>
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
            <?php require './components/tarefas.php' ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

<?php if ($id_importancia != '') : ?>
    <?php foreach ($tarefas as $tarefa) : ?>
        <?php
        $tarefaHorario = $tarefa->data . ' ' . $tarefa->horario;

        $dataTarefa = new DateTime($tarefaHorario);
        ?>
        <?php if ($tarefa->importancia_id == $id_importancia) : ?>
            <?php require './components/tarefas.php' ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

