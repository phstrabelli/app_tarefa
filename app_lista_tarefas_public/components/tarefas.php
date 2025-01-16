<?php
if ($tarefa->importancia_id == 3) {
}
$importancia = 'Posso Fazer Depois';

if ($tarefa->importancia_id == 2)
    $importancia = 'Necessário';

if ($tarefa->importancia_id == 1)
    $importancia = 'Urgente';


foreach ($categorias as $categoria) {
    if ($tarefa->categ_id == $categoria->categ_id) {
        $categ = $categoria->categ;
    }
}

$id_status = isset($_SESSION['id_status']) ? $_SESSION['id_status'] : '';
?>


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
            <i class="fas fa-check-square  " onclick="checkAndRemove(<?= $tarefa->id ?>, '<?= $id_status != '' ? 'atualizarStatusPendente' : 'atualizarStatus'?>')">Concluido</i>
        </div>
    </div>
    <div class="tarefa-extras">
        <p class="importancia-p" value='<?= $tarefa->importancia_id ?>'><?= isset($importancia) ? $importancia : '' ?></p>
        <select name="importancia-select" class="importancia-select" id='tarefaImportancia_<?= $tarefa->id ?>'>
            <option value="3">Posso Fazer Depois</option>
            <option value="2">Necessário</option>
            <option value="1">Urgente</option>
        </select>
        <p class="categ-p" value='<?= $tarefa->categ_id ?>'><?= isset($categ) && !is_null($categ) && !is_object($categ) ? $categ : 'Nenhuma Categoria' ?></p>
        <select name="categ-select" class="categ-select" id='tarefaCateg_<?= $tarefa->id ?>'> 
            <option value="">Nenhuma Categoria</option>
            <?php foreach ($categorias as $categ) : ?>
                <option value="<?= $categ->id ?>"><?= $categ->categ ?></option>
            <?php endforeach ?>
        </select>
    </div>

</div>