$('#teste').on('submit', (e) => {
    let nome = $('#nomeC').val()
    var checkBoxes = document.querySelectorAll(".oticasc");
    var selecionados = 0;
    checkBoxes.forEach(function (el) {
        if (el.checked) {
            selecionados++;
        }
    });
   

    if(nome.length <= 3) {
        e.preventDefault()
        $('#nomeC').css({'border':'1px solid red'})
        return Swal.fire({
             title: 'O nome deve ser maior que 3 caracteres',
             icon: 'error',
             confirmButtonText: 'OK',
         })
    }
    if(selecionados == 0) {
        e.preventDefault()
       return Swal.fire({
            title: 'Você deve selecionar pelo menos uma ótica',
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }

    e.submit()
    
})
