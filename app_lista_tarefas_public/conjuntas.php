<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$acao = 'recuperar';
require 'tarefa_controller.php';
require_once 'categ_controller.php';

?>

<?php foreach ($convites as $convite) : ?>
    <?php
    if ($convite->importancia_id == 3)
        $importancia = 'Posso Fazer Depois';

    if ($convite->importancia_id == 2)
        $importancia = 'Necessário';

    if ($convite->importancia_id == 1)
        $importancia = 'Urgente';
    ?>
    <?php if ($convite->status != 0) : ?>
        <div class="tarefa" id="tarefaDiv_<?= $convite->id_tarefa ?>">
            <div id='tarefa_<?= $convite->id_tarefa ?>' class="tarefa-title"><?= $convite->tarefa ?></div>

            <div class="tarefa-obs">
                <p id='tarefaObs_<?= $convite->id_tarefa ?>' class="content-tarefa-obs"><?= $convite->obs ?></p>
            </div>

            <div class="tarefa-data">
                <input id='tarefaData_<?= $convite->id_tarefa ?>' type="text" value="<?= $convite->data ?>">
                <input id='tarefaHorario_<?= $convite->id_tarefa ?>' type="time" id="horario" name="horario" value="<?= date('H:i', strtotime($convite->horario)) ?>">
            </div>

            <div class="tarefa-options">
                <div class="pontinhos"><img src="./img/mostrar-mais-botao-com-tres-pontos.png" alt=""></div>
                <div class="icons">
                    <i class="fas fa-trash-alt  " onclick="remove(<?= $convite->id_conjunto ?>, 'removerInvite')">Excluir</i>
                    <i class="fas fa-check-square  " onclick="checkAndRemoveInvite(<?= $convite->id_conjunto ?>, '<?= $convite->id_status != '' ? 'atualizarStatusPendenteInvite' : 'atualizarStatus' ?>')">Concluido</i>
                </div>
            </div>
            <div class="tarefa-extras">
                <p class="importancia" value='<?= $convite->importancia_id ?>'><?= isset($importancia) ? $importancia : '' ?></p>
                <p class="categ" value='<?= $convite->categ_id ?>'><?= isset($categ) && !is_null($categ) && !is_object($categ) ? $categ : 'Nenhuma Categoria' ?></p>
            </div>
            <p>Tarefa de: <?= $convite->username ?></p>

        </div>
    <?php endif; ?>
<?php endforeach; ?>