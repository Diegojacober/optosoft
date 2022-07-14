@extends('adminlte::page')

@section('title', 'Agenda')

@section('calendarJS')
<script src="{{ asset('/assets/calendar.js') }}"></script>
@endsection

@section('content')

    <style>
        #loading {
            display: none;
            position: absolute;
            top: 5px;
            right: 10px;
        }

        #calendar {
            max-width: 720px;
            margin: 0px auto;
            padding: 0px 10px;
        }

        #calendar a {
            text-decoration: none;
            color: black;
        }
    </style>

    <div id='loading'>loading...</div>
    <div id='calendar'></div>


    <div class="modal fade " id="novaConsulta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agendar Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if (count($oticasU) > 0)
                    <form id="formNovaConsulta">
                        @csrf

                        <div class="row mb-4">
                            @foreach ($oticasU as $otica)
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="oticaR" data-id="{{$otica->id}}">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      {{$otica->nome}}
                                    </label>
                                  </div>
                            </div>
                            @endforeach
                        </div>
                       
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="">
                                    <label for="title">Nome do Paciente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="idade" id="idade"
                                        placeholder="">
                                    <label for="idade">Idade do Paciente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="telefone" id="telefone"
                                            placeholder="">
                                        <label for="telefone">Telefone do Paciente</label>
                                    </div>
                                <div id="phoneHelp" class="form-text ml-1">Esta Informação não estará disponível para o
                                    optometrista.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-2 form-label">Anotação:</label>
                            <div class="col-sm-10">
                                <input type="text" name="anotacao" class="form-control" id="anotacao"
                                    placeholder="Deixe uma anotação para o optometrista caso queira">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 form-label">Dia e Horário:</label>
                            <div class="col-sm-9">
                                <input type="text" name="start" required class="form-control" id="start" readonly>
                            </div>
                        </div>

                        <input type="text" name="end" required class="form-control d-none" id="end" readonly>

                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" id="btnNovaConsulta" class="btn btn-primary btn-block">Confirmar</button>
                            </div>
                        </div>

                    </form>
                    @else
                        <h4 align="center" class="m-4">Você não tem nenhuma ótica ativa para agendar consultas</h4>
                    @endif
                   

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade " id="seeExame" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Informações do Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
        
                    <dl class="row">
                        <dt class="col-sm-3">Nome:</dt>
                        <dd class="col-sm-9" id="name"></dd>
                    </dl>

                    <dl class="row">
                        <dt class="col-sm-3">Idade:</dt>
                        <dd class="col-sm-9" id="idade"></dd>
                    </dl>

                    <dl class="row">
                        <dt class="col-sm-3">Dia e Horário:</dt>
                        <dd class="col-sm-9" id="start"></dd>
                    </dl>

                    @if ($user->is_optometrist !== 1)
                    <dl class="row">
                        <dt class="col-sm-3">Telefone:</dt>
                        <dd class="col-sm-9" id="phone"></dd>
                    </dl>
                    @endif

                    <dl class="row">
                        <dt class="col-sm-3">Anotações:</dt>
                        <dd class="col-sm-9" id="anotacoes"></dd>
                    </dl>

                    <dl class="row">
                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9 d-flex align-items-center" id="status">
                            <select name="statusConsulta" id="statusConsulta" class="form-control">
                            <option value="pending" id="pending">🟡 Aguardando confirmação </option>
                            <option value="confirmed" id="confirmed" selected="false">🟢 Confirmado </option>
                            <option value="canceled" id="canceled">🔴 Cancelado </option>
                            </select>
                        </dd>
                    </dl>

                    <button id="saveStatus" class="btn btn-block btn-primary text-light">Salvar Alterações</button>
                </div>
            </div>
        </div>
    </div>
@endsection
