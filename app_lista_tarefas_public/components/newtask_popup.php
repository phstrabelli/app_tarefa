
<div class="popup" id='formNovaTarefa'>
    <form method="post" action="tarefa_controller.php?acao=inserir" class="form-nova-tarefa">
        <div class="form-group">
            <label for="inputNewTask">Descrição da tarefa:</label>
            <input type="text" id='inputNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">

            <label for="data">Selecione a data:</label>
            <input name='data' id="data">

            <label for="horario">Selecione o horário:</label>
            <input type="time" id="horario" name="horario">

            <label for="obs">Observação:</label>
            <textarea id="obs" name="obs"></textarea>

            <label for="categ_id">Categoria:</label>
            <select name="categ_id" id="categ_id">
                <option value="">Nenhuma</option>
                <?php foreach ($categorias as $categ) : ?>
                    <option value="<?= $categ->id?>"><?= $categ->categ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button class="btn btn-success" id="btnNewTask">Cadastrar</button>
    </form>
</div>