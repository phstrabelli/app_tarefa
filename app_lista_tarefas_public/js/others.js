$(document).ready(function () {
    $(".close").on("click", () => {
        $("#bg-success").attr("style", "display: none !important");

    });

    $(document).on('click','.editBtn', (e)=> {
        let element = $(e.target)
        let form = element.parent();
        let formData = form.serializeArray();
        
        let value = formData.find(item => item.name === 'form-control').value;

        if(value.length === 0 ) {
            e.preventDefault()
            alert('Preencha o campo corretamente'); 
        }
        
    })

    $(document).on('click','.tarefa', (e)=> {
        $('.tarefa').removeClass('active');
        $(e.currentTarget).addClass('active')
        
    })

    $(document).on('click','.pontinhos', (e)=> {
        let icons = $(e.currentTarget).next();
        e.stopPropagation();
        
        if (icons.is(':visible')) {
            icons.animate({ opacity: 0 , height: '0px' }, 200, function() {
                icons.hide(); 
            });
        } else {
                icons.css('display','flex')
                icons.css('justify-content','space-between')
                icons.css('flex-flow','column')
                icons.show().animate({ opacity: 1 , height: '70px' }, 200);
        }
    })

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.tarefa').length) {
            $('.tarefa').removeClass('active');
        }
        if (!$(e.target).closest('.icons').length) {
            $('.icons').animate({ opacity: 0 , height: '0px' }, 500, function() {
                $('.icons').hide(); 
            });
        }
    });
    

    $(document).on('click','.tarefa-title', (e)=>{
        $(e.currentTarget).removeClass('empty')
    })
});

