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