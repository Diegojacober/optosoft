document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        locale: 'pt-br',
        //   initialDate: '2022-02-01',
        initialView: 'Semana',
        dayMaxEventRows: true,
        selectable: true,
        longPressDelay: 1,
        editable: false,
        views: {
            Semana: {
                type: 'timeGrid',
                dayMaxEventRows: 3,
                duration: { days: 4 },
                allDaySlot: false
            },
            timeGridDay: {
                allDaySlot: false
            }
        },
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'Semana,timeGridDay,listYear'
        },
        events: {
            url: "/agenda/events",
            textColor: 'black',
        },
        loading: function (bool) {
            document.getElementById('loading').style.display =
                bool ? 'block' : 'none';
        },
        select: function (info) {
            const date = new Date().toLocaleString();
            if (info.start.toLocaleString() < date) {
                Swal.fire(
                    'Horário Inválido',
                    'Não é possível marcar consultas no passado',
                    'error'
                )
            } else {
                $('#novaConsulta').modal('show')
                $('#novaConsulta #start').val(info.start.toLocaleString())
                $('#novaConsulta #end').val(info.end.toLocaleString())

                $('#novaConsulta #start').mask('00/00/0000 00:00:00');
                $('#novaConsulta #end').mask('00/00/0000 00:00:00');
            }
        },
        eventClick: function (info) {
            $('#seeExame #start').text(info.event.start.toLocaleString())
            $('#seeExame #name').text(info.event.title)
            $('#seeExame #phone').text(info.event._def.extendedProps.telefone)
            $('#seeExame #anotacoes').text(info.event._def.extendedProps.anotacao)
            $('#seeExame #idade').text(info.event._def.extendedProps.idade)
            

            $("#statusConsulta option[value='pending']").removeAttr('selected')
            $("#statusConsulta option[value='confirmed']").removeAttr('selected')
            $("#statusConsulta option[value='canceled']").removeAttr('selected')
            $("#seeExame #saveStatus").attr("disabled","disabled")
            if(info.event._def.ui.backgroundColor == '#FFD700') {
                $("#statusConsulta option[value='pending']").attr("selected", "selected");
            }else if(info.event._def.ui.backgroundColor == '#32CD32') {
                $("#statusConsulta option[value='confirmed']").attr("selected", "selected");
            }else if(info.event._def.ui.backgroundColor == '#FF0000') {
                $("#statusConsulta option[value='canceled']").attr("selected", "selected");
            }

            $('#seeExame').modal('show')

            $('#seeExame #statusConsulta').on('change',() => {
                $("#seeExame #saveStatus").removeAttr("disabled")
            })

            $('#seeExame #saveStatus').on('click', () => {
                let idConsulta = info.event.id
                let NovaCor = $('#statusConsulta').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    data: `id=${idConsulta}&status=${NovaCor}`,
                    url: `agenda/setstatus`,
                }).done(function (msg) {
                    if (msg.message == 'error') {
                        Swal.fire({
                            title: 'Não foi possivel atualizar o status',
                            text: 'Contate o suporte para solucionar o problema',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        })
                    }
                    else {
                        Swal.fire({
                            title: 'Status atualizado com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true)
                            }
                        })
                    }
                })
            })

            
        },
        businessHours: {
            daysOfWeek: [1, 2, 3, 4, 5, 6],
            startTime: '07:00',
            endTime: '22:00',
        }
    });

    calendar.render();
});

$('#formNovaConsulta').on('submit', (e) => {
    e.preventDefault()
    let title = $('#novaConsulta #title').val()
    let idade = $('#novaConsulta #idade').val()
    let telefone = $('#novaConsulta #telefone').val()
    let anotacao = $('#novaConsulta #anotacao').val()
    let start = $('#novaConsulta #start').val()
    let end = $('#novaConsulta #end').val()
    let color = '#FFD700'
    let radios = $("input[name='oticaR']:checked").val()

    if (title == '' || idade == '' || telefone == '' || radios == undefined) {
        Swal.fire(
            'Campo Vazio',
            'Você deve preencher o nome, idade e telefone',
            'warning'
        )
    } else {
        let oticaId = $("input[name='oticaR']:checked").data('id')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            method: "POST",
            data: `otica_id=${oticaId}&title=${title}&idade=${idade}&telefone=${telefone}&anotacao=${anotacao}&start=${start}&end=${end}&color=${color}`,
            url: `agenda/new`,
        }).done(function (msg) {
            if (msg.message == 'error') {
                Swal.fire({
                    title: 'Não foi possivel agendar uma nova consulta',
                    text: 'Contate o suporte para solucionar o problema',
                    icon: 'error',
                    confirmButtonText: 'OK',
                })
            } else if (msg.message == 'exists') {
                Swal.fire({
                    title: 'Não foi possivel agendar uma nova consulta',
                    text: 'Já existe outra consulta agendada neste horário',
                    icon: 'error',
                    confirmButtonText: 'OK',
                })
            }
            else {
                Swal.fire({
                    title: 'Consulta agendada com sucesso!',
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
})

