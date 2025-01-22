<!-- <div class="popup formNovaTarefa">
    <form method="post" action="tarefa_controller.php?acao=inserir" class="form-nova-tarefa">
        <div class="form-group">

            <div class="label-input col-12" >
                <label for="inputNewTask" class="inputNewTask-label">Descrição da tarefa:</label>
                <input type="text" id='inp  utNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">
            </div>

            <div class="label-input col-5">
                <label for="data" id="data-label">Selecione a data:</label>
                <input name='data' id="data">
            </div>

            <div class="label-input col-5"> 
                <label for="horario" id="horario-label">Selecione o horário:</label>
                <input type="time" id="horario" name="horario">
            </div>
            
            <div class="label-input col-12"> 
                <label for="obs">Observação:</label>
                <textarea id="obs" name="obs"></textarea>
            </div>


            <div class="task-extras col-12">
                <div class="col-5 categ-div">
                    <label for="categ_id" id="categ-label">Categoria:</label>
                    <select name="categ_id" id="categ_id">
                        <option value="">Nenhuma</option>
                        <?php foreach ($categorias as $categ) : ?>
                            <option value="<?= $categ->id ?>"><?= $categ->categ ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="new-categ">
                        <span class="span-new-categ">Nova categoria +</span>
                        <div id="form-new-categ">
                            <input name='categ' id="categ" type="text">
                            <button type="button" id="categ-btn"></button>
                        </div>
                    </div>
                </div>
                <div class="col-5 importancia-div">
                    <label for="importancia_id">Importancia:</label>
                    <select name="importancia_id" id="importancia_id">
                        <option value="3">Posso Fazer Depois</option>
                        <option value="2">Necessário</option>
                        <option value="1">Urgente</option>
                    </select>
                </div>
            </div>

        </div>
        <button class="btn" id="btnCadastro">Cadastrar</button>
    </form>
</div> -->

<div class="popup formNovaTarefa" id="formNovaTarefa2">
    <form method="post" action="tarefa_controller.php?acao=inserir" class="form-nova-tarefa">
        <div class="form-group-1">
            <div class="label-input col-12">
                <label for="inputNewTask" class="inputNewTask-label">Descrição da tarefa:</label>
                <input type="text" id='inputNewTask' class="form-control" name='tarefa' placeholder="Exemplo: Lavar o carro">
            </div>

            <div class="label-input col-5">
                <label for="data" id="data-label">Selecione a data:</label>
                <input name='data' id="data">
            </div>

            <div class="label-input col-5">
                <label for="horario" id="horario-label">Selecione o horário:</label>
                <input type="time" id="horario" name="horario">
            </div>
        </div>
        
        <div class="form-group-2">
            <div class="label-input col-12"> 
                <label for="obs">Observação:</label>
                <textarea id="obs" name="obs"></textarea>
            </div>
            <div class="task-extras col-12">
                <div class="col-5 categ-div">
                    <label for="categ_id" id="categ-label">Categoria:</label>
                    <select name="categ_id" id="categ_id">
                        <option value="">Nenhuma</option>
                        <?php foreach ($categorias as $categ) : ?>
                            <option value="<?= $categ->id ?>"><?= $categ->categ ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="new-categ">
                        <span class="span-new-categ">Nova categoria +</span>
                        <div id="form-new-categ">
                            <input name='categ' id="categ" type="text">
                            <button type="button" id="categ-btn"></button>
                        </div>
                    </div>
                </div>
                <div class="col-5 importancia-div">
                    <label for="importancia_id">Importancia:</label>
                    <select name="importancia_id" id="importancia_id">
                        <option value="3">Posso Fazer Depois</option>
                        <option value="2">Necessário</option>
                        <option value="1">Urgente</option>
                    </select>
                </div>
                <div class="div">
                    <label for="email_convite">Convidar:</label>
                    <input id='email_convite' name="email_convite" type="email">
                </div>
            </div>

        </div>
        <div class="next-btn">Próximo</div>
        <div class="prev-btn">Voltar</div>
        <button class="btn" id="btnCadastro">Cadastrar</button>
    </form>
</div>