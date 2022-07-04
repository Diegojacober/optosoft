$('#inativos').hide()
$('#ativos').fadeIn()

$('#btn-ativos').on('click', () => {
    $('#inativos').hide()
    $('#ativos').fadeIn()
})

$('#btn-inativos').on('click', () => {
    $('#ativos').hide()
    $('#inativos').fadeIn()
})

$('#cadaOtica').on('click', function () {
    if($('#cadNome').val() !== '' && $('#cadCidade').val() !== ''){
        $('#formOtica').submit()
    }else {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'você deve preencher todos os campos!',
          })
    }
});

function editOtica(id,nome,cidade) 
{
    $('#editNomeOtica').val(nome) 
    $('#editCidadeOtica').val(cidade) 
    $('#formEditOtica').attr('action',function (index,oldValue){  
    return '/opto/oticas/edit/'+id })
    $('#modalEditOtica').modal('show')   
}
$('#btnEditOtica').on('click', function () {
    $('#formEditOtica').submit()
});