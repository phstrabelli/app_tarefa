function remove(id, action) {
    $('#confirmationPopup').fadeIn();

    $('#yesBtn').on('click', () => {
        checkInvites(id,action)
        $('#confirmationPopup').fadeOut();
    })

    $('#noBtn').on('click', () => {
        $('#confirmationPopup').fadeOut();
    })
}

function checkInvites(id, action, checkAction) {
    $.ajax({
        type: 'GET',
        url: 'tarefa_controller.php',
        data: {
            id: id,
            acao: action,
        },

        success: dados => {

            console.log(dados);
            
            if(dados != '') {
                $('#confirmationInvitePopup').fadeIn();

                $('#yesBtnInvite').on('click', () => {
                    checkAndRemove(id, 'atualizarStatusPendente')
                    $('#confirmationInvitePopup').fadeOut();
                })

                $('#noBtnInvite').on('click', () => {
                    $('#confirmationInvitePopup').fadeOut();
                })
            }
            else {
                console.log('checkAction');
                
                checkAndRemove(id, checkAction);
            }

        },
        error: erro => {
            console.log('erro')
        }
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

function checkAndRemoveInvite(id, action) {

    console.log(id);
    
    $.ajax({
        type: 'GET',
        url: 'tarefa_controller.php',
        data: {
            id: id,
            acao: action,
        },


        success: dados => {
            console.log(dados);
            
            if (action == 'removerInvite' || action == 'atualizarStatusPendenteInvite') {
                let tarefaDiv = '#tarefaDiv_' + id
                $(tarefaDiv).attr('style', 'display: none !important');
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

        if ($(e.currentTarget).text().trim() === '') {
            $(e.currentTarget).addClass('empty-obs');
        }
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

    $(document).on('change', '.importancia-select', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'importancia'
        let importancia = $(e.currentTarget).val()

        editar(id,acao, importancia)
    })

    $(document).on('change', '.categ-select', function(e) {

        let str = e.currentTarget.id;
        let id = str.split('_')[1];
        let acao = 'categ'
        let categ = $(e.currentTarget).val()

        editar(id,acao, categ)
    })



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

        })

        $('.content-tarefa-obs').each(function () {
            let $this = $(this);
            
            if ($this.text().trim() === '') {
            $this.addClass('empty-obs');
            }
        })
    }
})