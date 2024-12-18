$(document).ready(function () {
    $(".close").on("click", () => {
        $("#bg-success").attr("style", "display: none !important");

    });

    $('#btnNewTask').on('click', (e) => {
        
        let value = $('#inputNewTask').val().trim(); 
        
        if (value.length === 0) {
            e.preventDefault(); 
            alert('Preencha o campo corretamente'); 
        }
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
});
