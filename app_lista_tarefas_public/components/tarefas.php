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