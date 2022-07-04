$('#btnNewUser').on('click', function () {
    if($('#UserName').val() !== '' && $('#UserEmail').val() !== '' && $('#UserPassword').val() !== ''){
        $('#formNewUser').submit()
    }else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'você deve preencher todos os campos!',
          })
    }
});

function formSubmit(id) {
    $(`#${id}`).submit()
}


function deleteUser(id,nome)
{
    Swal.fire({
        title: `Tem Certeza que deseja apagar o usuário ${nome}?`,
        showDenyButton: true,
        confirmButtonText: 'Apagar',
        denyButtonText: `Cancelar`,
        icon:'question'
      }).then((result) => {
        if (result.isConfirmed) {
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: `users/delete/${id}`,
               }).done(function(msg){
               
                Swal.fire({
                    title: 'Usuário Apagado com sucesso!',
                    icon:'success',
                    confirmButtonText: 'OK',
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true)
                    }
                  })
           })
        } 
      })
}