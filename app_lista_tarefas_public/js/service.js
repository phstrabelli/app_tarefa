function editar(id, texto, event) {
    let tarefa = '#tarefa_' + id
    $(event.target).css('pointer-events', 'none')
    let form = document.createElement('form');
    form.action = 'tarefa_controller.php?acao=atualizar';
    form.method = 'POST';
    $(form).addClass('row form')

    let inputTarefa = document.createElement('input');
    inputTarefa.type = 'text';
    inputTarefa.id = 'tarefa';
    inputTarefa.name = 'form-control';
    inputTarefa.value = texto
    $(inputTarefa).addClass('col-9 form-control')

    let inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = id
    $(inputId).hide()


    let submitButton = document.createElement('input');
    submitButton.type = 'submit';
    $(submitButton).addClass('col-3 btn btn-info editBtn');
    $(submitButton).text('Atualizar')

    $(form).append(inputTarefa)
    $(form).append(inputId)
    $(form).append(submitButton)

    $(tarefa).html(form)


    // $(tarefa).before(form)

}

function remove(id, action) {
    $('#confirmationPopup').fadeIn();

    $('#yesBtn').on('click', () => {
        checkAndRemove(id,action)
        $('#confirmationPopup').fadeOut();
    })

    $('#noBtn').on('click', () => {
        $('#confirmationPopup').fadeOut();
    })
}

function checkAndRemove(id, action) {
    $.ajax({
        type: 'GET',
        url: 'tarefa_controller.php',
        data: {
            id: id,
            acao: action,
        },


        success: dados => {

            if (action == 'atualizarStatus') {
                let statusDiv = '#status_' + id
                let statusText = dados == 1 ? '(pendente)' : '(realizado)'

                $text = $(statusDiv).text() == '(pendente)' ? '(realizado)' : '(pendente)'

                $(statusDiv).text($text)
            }
            if (action == 'remover' || action == 'atualizarStatusPendente') {
                let tarefaDiv = '#tarefaDiv_' + id
                $(tarefaDiv).attr('style', 'display: none !important');
            }
        },
        error: erro => {
            console.log('erro')
        }
    })

}