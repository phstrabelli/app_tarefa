
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

                $text = $(statusDiv).text() == '(pendente)'   || $(statusDiv).text() == '(atrasado)' ? '(realizado)' : '(pendente)'

                $(statusDiv).text($text)
            }
            if (action == 'remover' || action == 'atualizarStatusPendente') {
                let tarefaDiv = '#tarefaDiv_' + id
                // $(tarefaDiv).attr('style', 'display: none !important');
            }
        },
        error: erro => {
            console.log('erro')
        }
    })

}

$(document).ready(function () {
    $(document).on('blur','.tarefa-title', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'titulo'
        let tarefa = $(e.currentTarget).text()

        if ($(e.currentTarget).text().trim() === '') {
            $(e.currentTarget).addClass('empty');
        }

        editar(id,acao,tarefa)
    }); 

    $(document).on('blur','.content-tarefa-obs', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'obs'
        let tarefa = $(e.currentTarget).text()

        editar(id,acao,tarefa)
    }); 

    $(document).on('change','.calendario', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'data'
        let tarefa = $(e.currentTarget).val()
        
        editar(id,acao,tarefa)
    }); 

    $(document).on('change', '.horario', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'horario'
        let tarefa = $(e.currentTarget).val()
                
        editar(id,acao,tarefa)
    }); 



    function editar(id, acao, tarefa) {
        $.ajax({
            type: 'GET',
            url: 'tarefa_controller.php',
            data: {
                id: id,
                acao: `editar_${acao}` ,
                tarefa: tarefa,
            },
    
    
            success: dados => {
                console.log(dados)
            },
            error: erro => {
                console.log(erro)
            }
        })
    }
    placeHolder()

    function placeHolder() {
        $('.tarefa-title').each(function () {
            let $this = $(this);
            
            if ($this.text().trim() === '') {
            $this.addClass('empty');
            }

        $this.on('blur', function() {
            console.log('ada')
            if ($this.text().trim() === '') {
                $this.addClass('empty');
            } else {
                $this.removeClass('empty');
            }
        });
        })
        
    }
})