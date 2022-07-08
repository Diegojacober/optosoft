$(document).ready(function () {

    $('#selectOtica').on('change', function (e) {
        e.preventDefault()
        if ($('#selectOtica').val() == 'selecionar') {
            $("#searchReceita").data("otica", '00');
            $('#receitas').html('')
            Swal.fire(
                'Selecione uma ótica',
                'Primeiro selecione uma ótica para ver as receitas',
                'info'
            )
        } else {
            let loading = '  <div class="card text-center w-100" aria-hidden="true">' +
                '<div class="card-body">' +
                '<h5 class="text-center placeholder-glow">' +
                '<span class="placeholder col-6"></span>' +
                '</h5>' +
                '<p class="card-text placeholder-glow">' +
                '<span class="placeholder col-4"></span>' +
                '</p>' +
                '<a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>' +
                '</div>' +
                '</div>' +
                '  <div class="card text-center w-100" aria-hidden="true">' +
                '<div class="card-body">' +
                '<h5 class="text-center placeholder-glow">' +
                '<span class="placeholder col-6"></span>' +
                '</h5>' +
                '<p class="card-text placeholder-glow">' +
                '<span class="placeholder col-4"></span>' +
                '</p>' +
                '<a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>' +
                '</div>' +
                '</div>' +
                '  <div class="card text-center w-100" aria-hidden="true">' +
                '<div class="card-body">' +
                '<h5 class="text-center placeholder-glow">' +
                '<span class="placeholder col-6"></span>' +
                '</h5>' +
                '<p class="card-text placeholder-glow">' +
                '<span class="placeholder col-4"></span>' +
                '</p>' +
                '<a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>' +
                '</div>' +
                '</div>'
            $('#receitas').html(loading)
            let otica = $('#selectOtica').val()

            $.ajax({
                type: 'GET',
                url: `receitas/getOtica/${otica}`,
                dataType: 'json',
                success: dados => {
                    $('#receitas').fadeOut()
                    $('#receitas').html('')
                    $("#searchReceita").data("otica", otica);
                    let total = dados.data[0].qntdReceitas
                    let paginas = Math.round(total / 55)
                    dados.data.forEach(e => {
                        let botaoVer = `<a href="#" class="btn btn-primary" onclick="abrirReceita('${e.is_opto}','${e.id}','${e.nome}','${e.idade}','${e.data_formatada}','${e.od_esferico}','${e.od_esferico}','${e.od_eixo}','${e.oe_esferico}','${e.oe_esferico}','${e.oe_eixo}','${e.adicao}','${e.obs}')">Ver Receita <i class="fa-solid fa-eye"></i></a>`
                        let div = `<div class="card text-center w-100" id="receita${e.id}">` +
                            '<div class="card-body">' +
                            `<h5 class="text-center">${e.nome}</h5>` +
                            `<p class="card-text">${e.data_formatada}</p>` + botaoVer + '</div>' + '</div>'

                        $("#receitas").append(div)

                    });

                    let items = ''
                    for (let index = 0; index <= paginas; index++) {
                        items += `<li class="page-item"><a class="page-link" onclick="paginacaoDeReceitas(${otica},${index})" href="#">${index}</a></li>`
                    }

                    let divPagination = '<nav aria-label="Page navigation example">' +
                        '<ul class="pagination">' +
                        '<li class="page-item">' +
                        '<a class="page-link" href="#" aria-label="Previous">' +
                        '<span aria-hidden="true">&laquo;</span>' +
                        '</a>' +
                        '</li>' +
                        items +
                        '<li class="page-item">' +
                        '<a class="page-link" href="#" aria-label="Next">' +
                        '<span aria-hidden="true">&raquo;</span>' +
                        '</a>' +
                        '</li>' +
                        '</ul>' +
                        '</nav>'
                    $("#receitas").append(divPagination)
                    $("#receitas").hide()
                    $("#receitas").fadeIn(500);
                },
                error: erro => {
                    Swal.fire(
                        'Erro',
                        'A ótica não foi encontrada, contate o suporte para mais informações',
                        'error'
                    )
                }

            })

        }



    })



    $('#searchReceita').on('click', function (e) {

        if ($("#searchReceita").data("otica") == '00') {
            Swal.fire(
                'Selecione uma ótica',
                'Primeiro selecione uma ótica para fazer uma pesquisa',
                'info'
            )
        } else {
            $('#search').modal('show')
        }



    })

    $('#btnSearch').on('click', function (e) {

        let otica = $("#searchReceita").data("otica")
        let nome = $('#pesquisaText').val()
        if (nome == '') {
            return Swal.fire(
                'Vazio',
                'Preenche o nome para pesquisar',
                'error'
            )
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search').modal('hide')
        $("#searchResult").html('')
        $.ajax({
            type: 'POST',
            url: 'receitas/searchreceita',
            data: `otica_id=${otica}&nome=${nome}`,
            dataType: 'json',
            success: dados => {
                if (dados.length == 0) {
                    return Swal.fire(
                        'Pesquisa',
                        `Nenhuma receita foi encontrada com o nome de ${nome}`,
                        'info'
                    )
                }

                dados.forEach((e) => {

                    let footer = ''
                        
                    if(e.is_opto == 1){

                        footer = 
                        '<div class="card-footer">'+
                        ` <div class="row">` +
                        `<div class="col-4">` +
                        `<a href="#" class="btn btn-primary" onclick="editarReceita('${e.id}','${e.nome}','${e.idade}','${e.update_at}','${e.od_esferico}','${e.od_esferico}','${e.od_eixo}','${e.oe_esferico}','${e.oe_esferico}','${e.oe_eixo}','${e.adicao}','${e.obs}')"><i class="fa-solid fa-file-pen" ></i> Editar</a>` +
                        `</div>` +
                        `<div class="col-4">` +
                        `<a href="#" class="btn btn-secondary">Imprimir</a>` +
                        `</div>` +
                        `<div class="col-4">` +
                        `<a href="#" class="btn btn-danger" onclick="apagarReceita(${e.id})"><i class="fa-solid fa-eraser"></i> Apagar</a>` +
                        `</div>` +
                        ` </div>` +
                        `</div>` +
                        ` </div>`+
                        '</div>'

                    }else {
                        footer = 
                        '<div class="card-footer">'+
                        ` <div class="row">` +
                        `<div class="col-12">` +
                        `<a href="#" class="btn btn-block btn-secondary">Imprimir</a>` +
                        `</div>` +
                        ` </div>` +
                        `</div>` +
                        ` </div>`+
                        '</div>'
                    }

                    let cardSearch = `<div class="card" style="
                    border: 0.8px outset gray;
                ">`+
                        `<div class="card-body">` +
                        `<h5 class="text-center">${e.nome}</h5>` +
                        `<p class="text-center fs-6">${e.data_formatada}</p>` +
                        `<div class="row mt-3">` +
                        ` <div class="table-responsive" style="border-radius: 20px">` +
                        ` <table class="table table-light table-bordered">` +
                        `  <thead class="">` +
                        ` <tr>` +
                        ` <th scope="col"></th>` +
                        `<th scope="col">Esférico</th>` +
                        `<th scope="col">Cilindríco</th>` +
                        `<th scope="col">Eixo</th>` +
                        `</tr>` +
                        `</thead>` +
                        `<tbody>` +
                        ` <tr>` +
                        ` <th scope="row">OD</th>` +
                        ` <td> ${e.od_esferico} </td>` +
                        `<td> ${e.od_cilindrico} </td>` +
                        ` <td> ${e.od_eixo}° </td>` +
                        `</tr>` +
                        `<tr>` +
                        `<th scope="row">OE</th>` +
                        ` <td> ${e.oe_esferico}  </td>` +
                        ` <td> ${e.oe_cilindrico} </td>` +
                        `  <td> ${e.oe_eixo}° </td>` +
                        ` </tr>` +
                        `</tbody>` +
                        `</table>` +
                        `</div>` +
                        `<h6 class="mb-3">Adição: ${e.adicao}</h6>` +
                        `<textarea cols="30" rows="5" class="form-control mt-2" readonly>${e.obs}</textarea>` +
                        ` </div>` +
                        
                        footer

                    $("#searchResult").append(cardSearch)

                })

                $('#modalResults').modal('show')

            },
            error: erro => {
                console.log(erro)
            }

        })
        $('#pesquisaText').val('')
    })

});

function abrirReceita(isOpto, id, nome, idade, update_at, od_esferico, od_cilindrico, od_eixo, oe_esferico, oe_cilindrico, oe_eixo, adicao, obs) {
    if (isOpto == 1) {
        oe_eixo = (oe_eixo !== ' ') ? `${oe_eixo}°` : oe_eixo
        od_eixo = (od_eixo !== ' ') ? `${od_eixo}°` : od_eixo
        modal = `<div class="modal fade" id="modal${id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">` +
            '<div class="modal-dialog modal-dialog-centered">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            `<h5 class="modal-title" id="staticBackdropLabel">${nome}</h5>` +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '</div>' +
            '<div class="modal-body">' +
            `<div class="card-body">` +
            `<h5 class="text-center">${nome}</h5>` +
            `<p class="text-center fs-6">${update_at}</p>` +
            `<div class="row mt-3">` +
            ` <div class="table-responsive" style="border-radius: 20px">` +
            ` <table class="table table-light table-bordered">` +
            `  <thead class="">` +
            ` <tr>` +
            ` <th scope="col"></th>` +
            `<th scope="col">Esférico</th>` +
            `<th scope="col">Cilindríco</th>` +
            `<th scope="col">Eixo</th>` +
            `</tr>` +
            `</thead>` +
            `<tbody>` +
            ` <tr>` +
            ` <th scope="row">OD</th>` +
            ` <td> ${od_esferico} </td>` +
            `<td> ${od_cilindrico} </td>` +
            ` <td> ${od_eixo} </td>` +
            `</tr>` +
            `<tr>` +
            `<th scope="row">OE</th>` +
            ` <td> ${oe_esferico}  </td>` +
            ` <td> ${oe_cilindrico} </td>` +
            `  <td> ${oe_eixo} </td>` +
            ` </tr>` +
            `</tbody>` +
            `</table>` +
            `</div>` +
            ` </div>` +
            `<h6 class="mb-3">Adição: ${adicao}</h6>` +
            `<textarea cols="30" rows="5" class="form-control mt-2" readonly>${obs}</textarea>` +
            '</div>' +
            '<div class="row p-4 mt-3">' +
            '<div class="col-4">' +
            `<a class="btn btn-sm btn-info" onclick="editarReceita('${id}','${nome}','${idade}','${update_at}','${od_esferico}','${od_esferico}','${od_eixo}','${oe_esferico}','${oe_esferico}','${oe_eixo}','${adicao}','${obs}')"><i class="fa-solid fa-file-pen" ></i> Editar</a>` +
            '</div>' +
            '<div class="col-4">' +
            '<a class="btn btn-sm btn-secondary"><i class="fa-solid fa-print"></i> Imprimir</a>' +
            '</div>' +
            '<div class="col-4">' +
            `<a class="btn btn-sm btn-danger" onclick="apagarReceita(${id})"><i class="fa-solid fa-eraser"></i> Apagar</a>` +
            `</div>` +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'

        $(".content-wrapper").append(modal);
    } else {
        modal = `<div class="modal fade" id="modal${id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">` +
            '<div class="modal-dialog modal-dialog-centered">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            `<h5 class="modal-title" id="staticBackdropLabel">${nome}</h5>` +
            '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
            '</div>' +
            '<div class="modal-body">' +
            `<div class="card-body">` +
            `<h5 class="text-center">${nome}</h5>` +
            `<p class="text-center fs-6">${update_at}</p>` +
            `<div class="row mt-3">` +
            ` <div class="table-responsive" style="border-radius: 20px">` +
            ` <table class="table table-light table-bordered">` +
            `  <thead class="">` +
            ` <tr>` +
            ` <th scope="col"></th>` +
            `<th scope="col">Esférico</th>` +
            `<th scope="col">Cilindríco</th>` +
            `<th scope="col">Eixo</th>` +
            `</tr>` +
            `</thead>` +
            `<tbody>` +
            ` <tr>` +
            ` <th scope="row">OD</th>` +
            ` <td> ${od_esferico} </td>` +
            `<td> ${od_cilindrico} </td>` +
            ` <td> ${od_eixo} </td>` +
            `</tr>` +
            `<tr>` +
            `<th scope="row">OE</th>` +
            ` <td> ${oe_esferico}  </td>` +
            ` <td> ${oe_cilindrico} </td>` +
            `  <td> ${oe_eixo} </td>` +
            ` </tr>` +
            `</tbody>` +
            `</table>` +
            `</div>` +
            ` </div>` +
            `<h6 class="mb-3">Adição: ${adicao}</h6>` +
            `<textarea cols="30" rows="5" class="form-control mt-2" readonly>${obs}</textarea>` +
            '</div>' +
            '<div class="row p-4 mt-3">' +
            '<div class="col-12">' +
            '<a class="btn btn-block btn-secondary"><i class="fa-solid fa-print"></i> Imprimir</a>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'

        $(".content-wrapper").append(modal);
    }

    $(`#modal${id}`).modal('show')
}

function editarReceita(id, nome, idade, update_at, od_esferico, od_cilindrico, od_eixo, oe_esferico, oe_cilindrico, oe_eixo, adicao, obs) {

    let modalAtualizar =
        `<div class="modal fade" id="modalEdit${id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">` +
        '<div class="modal-dialog modal-dialog-centered">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        `<h5 class="modal-title" id="staticBackdropLabel">${nome}</h5>` +
        '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
        '</div>' +
        '<div class="modal-body">' +

        `<div class="row">` +
        `    <div class="col-8">` +
        `   <div class="form-floating">` +
        `      <input type="text" class="form-control" id="updateNome${id}" name="floatingInput"` +
        `      value="${nome}">` +
        ` <label for="floatingInput">Nome do Paciente</label>` +
        ` </div>` +
        ` </div>` +
        `<div class="col-4">` +
        `   <div class="form-floating">` +
        `   <input type="text" class="form-control" id="updateIdade${id}" name="floatingInput"` +
        `   value="${idade}">` +
        ` <label for="floatingInput">Idade</label>` +
        ` </div>` +
        `</div>` +
        ` </div>` +
        `<div class="row mt-3">` +
        ` <div class="table-responsive" style="border-radius: 20px">` +
        `   <table class="table table-light ">` +
        `  <thead class="">` +
        `  <tr>` +
        `   <th scope="col"></th>` +
        ` <th scope="col">Esférico</th>` +
        `<th scope="col">Cilindríco</th>` +
        ` <th scope="col">Eixo</th>` +
        `     </tr>` +
        ` </thead>` +
        ` <tbody>` +
        `   <tr>` +
        `   <th scope="row">OD</th>` +
        `   <td> <input type="text" class="form-control" id="updateOd_esferico${id}" name="od_esferico" value="${od_esferico}"> </td>` +
        `   <td> <input type="text" class="form-control" id="updateOd_cilindrico${id}" name="od_cilindrico" value="${od_cilindrico}"> </td>` +
        `   <td> <input type="text" class="form-control" id="updateOd_eixo${id}" name="od_eixo" value="${od_eixo}"> </td>` +
        `  </tr>` +
        `  <tr>` +
        `  <th scope="row">OE</th>` +
        `   <td> <input type="text" class="form-control" id="updateOe_esferico${id}" name="oe_esferico" value="${oe_esferico}"> </td>` +
        `   <td> <input type="text" class="form-control" id="updateOe_cilindrico${id}" name="oe_cilindrico" value="${oe_cilindrico}"> </td>` +
        `   <td> <input type="text" class="form-control" id="updateOe_eixo${id}" name="oe_eixo" value="${oe_eixo}"> </td>` +
        ` </tr>` +
        `    </tbody>` +
        ` </table>` +
        ` </div>` +
        `  </div>` +
        `   <div class="row mt-3">` +
        `  <div class="col-12">` +
        ` <label for="adicao" class="form-label">Adição</label>` +
        ` <input type="text" id="updateAdicao${id}" class="form-control" value="${adicao}">` +
        `  </div>` +
        `  </div>` +
        `  <div class="row mt-4">` +
        ` <div class="col-12">` +
        ` <label for="obs" class="form-label">Observações</label>` +
        `<textarea id="updateObs${id}" name="obs" class="form-control">${obs}</textarea>` +
        ` </div>` +
        `</div` +
        `</div>` +
        '</div>' +
        '<div class="modal-footer">' +
        `<div class="row">` +
        `<div class="col-12"> <a href="#" class="btn btn-block btn-primary" onclick="update(${id})">Salvar</a> </div>` +
        `<div/>` +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>'

    $('#modalResults').modal('hide')
    $(`#modal${id}`).modal('hide')
    $(".content-wrapper").append(modalAtualizar);
    $(`#modalEdit${id}`).modal('show')
}

function update(id)
{
    let nome = $(`#updateNome${id}`).val()
    let idade = $(`#updateIdade${id}`).val()
    let od_esferico = $(`#updateOd_esferico${id}`).val()
    let od_cilindrico = $(`#updateOd_cilindrico${id}`).val()
    let od_eixo = $(`#updateOd_eixo${id}`).val()
    let oe_esferico = $(`#updateOe_esferico${id}`).val()
    let oe_cilindrico = $(`#updateOe_cilindrico${id}`).val()
    let oe_eixo = $(`#updateOe_eixo${id}`).val()
    let adicao = $(`#updateAdicao${id}`).val()
    let obs = $(`#updateObs${id}`).val()
    if(nome == '' || idade == ''){
        Swal.fire({
            title: 'Preencha os Campos obrigatórios!',
            icon: 'error',
            confirmButtonText: 'OK',
        })
    }else{
        $(`#modalEdit${id}`).modal('hide')
        $(`#modalEdit${id}`).remove()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            data: `nome=${nome}&idade=${idade}&od_esferico=${od_esferico}&od_cilindrico=${od_cilindrico}&od_eixo=${od_eixo}&oe_esferico=${oe_esferico}&oe_cilindrico=${oe_cilindrico}&oe_eixo=${oe_eixo}&adicao=${adicao}&obs=${obs}`,
            url: `receitas/update/${id}`,
        }).done(function (msg) {
            if(msg.message == 'error') {
                Swal.fire({
                    title: 'Não foi possivel concluir a atualização',
                    text: 'Contate o suporte para solucionar o problema',
                    icon: 'error',
                    confirmButtonText: 'OK',
                })
            } else {
                Swal.fire({
                    title: 'Receita atualizada com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload(true)
                    }
                })
            }
        })
    }
}

function apagarReceita(id) {
    Swal.fire({
        title: 'Tem certeza que deseja excluir a receita?',
        showDenyButton: true,
        confirmButtonText: 'Sim',
        denyButtonText: `Cancelar`,
        icon: 'warning',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method: "POST",
                url: `receitas/delete/${id}`,
            }).done(function (msg) {
                Swal.fire({
                    title: 'Receita apagada com sucesso!',
                    icon: 'success',
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

function paginacaoDeReceitas(id, page) {
    $.ajax({
        type: 'GET',
        url: `receitas/getOtica/${id}/?page=${page}`,
        dataType: 'json',
        success: dados => {

            $('#receitas').fadeOut()
            $('#receitas').html('')
            $("#searchReceita").data("otica", id);
            let total = dados.data[0].qntdReceitas
            let paginas = Math.round(total / 55)
            dados.data.forEach(e => {
                let div = `<div class="card text-center w-100" id="receita${e.id}">` +
                    '<div class="card-body">' +
                    `<h5 class="text-center">${e.nome}</h5>` +
                    `<p class="card-text">${e.data_formatada}</p>` +
                    '<a href="#" class="btn btn-primary"' +
                    '>Ver Receita <i class="fa-solid fa-eye"></i></a>' +
                    '</div>' +
                    '</div>'

                $("#receitas").append(div)

            });

            let items = ''
            for (let index = 0; index <= paginas; index++) {
                items += `<li class="page-item"><a class="page-link" onclick="paginacaoDeReceitas(${id},${index})" href="#">${index}</a></li>`
            }

            let divPagination = '<nav aria-label="Page navigation example">' +
                '<ul class="pagination">' +
                '<li class="page-item">' +
                '<a class="page-link" href="#" aria-label="Previous">' +
                '<span aria-hidden="true">&laquo;</span>' +
                '</a>' +
                '</li>' +
                items +
                '<li class="page-item">' +
                '<a class="page-link" href="#" aria-label="Next">' +
                '<span aria-hidden="true">&raquo;</span>' +
                '</a>' +
                '</li>' +
                '</ul>' +
                '</nav>'
            $("#receitas").append(divPagination)
            $("#receitas").hide()
            $("#receitas").fadeIn(500);
        },
        error: erro => {
            Swal.fire(
                'Erro',
                'Falha na paginação',
                'error'
            )
        }

    })

}