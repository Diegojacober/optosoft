$('#formSugestion').on('submit',(e) => {
    e.preventDefault();
    let body = $('#bodySuggestion').val()
    if(body == ''){
       return Swal.fire({
            title: 'Campo Vazio',
            text: 'Você deve preencher o campo para enviar uma sugestão',
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        data: `body=${body}`,
        url: `suggestion/new`,
    }).done(function (msg) {
        if(msg.message == 'error') {
            Swal.fire({
                title: 'Não foi possivel enviar a sugestão',
                text: 'Tente novamente mais tarde, se o problema persistir, contate o suporte',
                icon: 'error',
                confirmButtonText: 'OK',
            })
        } else {
            Swal.fire({
                title: 'Sugestão enviada com sucesso!',
                text: 'Obrigado pelo seu feedback, faremos o possível para melhorar sua experiência',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#bodySuggestion').val('')
                }
            })
        }
    })

})