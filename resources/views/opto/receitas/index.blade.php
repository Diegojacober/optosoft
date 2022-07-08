@extends('adminlte::page')

@section('title', 'Receitas')

@section('content')

    <h1 class="pt-4 display-5" align="center"> Listagem de Receitas </h1>

    <div class="p-2 m-4" style="">
        <div class="row ml-4">

            <div class="col-2">
                <a class=" btn btn-s btn-info" id="searchReceita" data-otica="00">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>

            <div class="ml-2 col-9">
                <select class="form-select" name="selectOtica" id="selectOtica" aria-label="Example select with button addon">
                    <option selected value="selecionar">Selecionar...</option>
                    @foreach ($oticas as $otica)
                        @if ($otica->ativo == 0)
                            <option value="{{ $otica->id }}">{{ $otica->nome }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
           
            


        </div>
    </div>


    

    <div class="modal fade" id="search" tabindex="-1" aria-labelledby="search" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="search">Pesquisar Receita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" name="nome" id="pesquisaText">
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSearch" class="btn btn-block btn-success">Pesquisar</button>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade" id="modalResults" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalResults" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalResults">Resultado da Pesquisa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="searchResult">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="fluid-container" id="receitas">


    </div>



@endsection
