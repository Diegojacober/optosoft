@extends('adminlte::page')

@section('title', 'Criar Nova Receita')

@section('content')

<style>
    .table th, .table td{
        padding: 0.5rem 0.5rem !important;
    }
</style>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="" style="padding: 10px;border:1px outset rgba(0, 0, 0, 0.356);border-radius:25px;background:rgba(214, 214, 214, 0.438)">

            <form action="{{ route('receitas.store') }}" class="p-3 w-100 " id="teste" method="POST">
                @csrf

                <div class="row">
                    <div class="col-8">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="nome" id="nomeC"
                                value="{{ old('nome') }}">
                            <label for="floatingInput">Nome do Paciente</label>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="idade" id="floatingInput"
                                value="{{ old('idade') }}" required>
                            <label for="floatingInput">Idade</label>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <div class="row ml-4">
                        @foreach ($oticas as $i => $otica)
                            @if ($otica->ativo == 0)
                                <div class="col-md-4 col-12 mb-2 fs-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input oticasc" type="checkbox" name="oticas[{{ $otica->id }}]"
                                            value="{{ $otica->id }}"  id="flexSwitchCheckDefault">
                                        <label class="form-check-label"
                                            for="flexSwitchCheckDefault">{{ $otica->nome }}</label>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

                    {{-- <div style="border-radius: 20px;min-width:355px;margin-left:-25px"> --}}
                        <table class="table table-light " class="d-flex justify-content-center align-items-center">
                            <thead class="">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Esférico</th>
                                    <th scope="col">Cilindríco</th>
                                    <th scope="col">Eixo</th>
                                    <th scope="col">A/C</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th id="odCreate">OD</th>
                                    <td>
                                        <select name="od_esferico" class="form-control">


                                            <option>+21,00</option>
                                            <option>+20,75</option>
                                            <option>+20,50</option>
                                            <option>+20,25</option>
                                            <option>+20,00</option>
                                            <option>+19,75</option>
                                            <option>+19,50</option>
                                            <option>+19,25</option>
                                            <option>+19,00</option>
                                            <option>+18,75</option>
                                            <option>+18,50</option>
                                            <option>+18,25</option>
                                            <option>+18,00</option>
                                            <option>+17,75</option>
                                            <option>+17,50</option>
                                            <option>+17,25</option>
                                            <option>+17,00</option>
                                            <option>+16,75</option>
                                            <option>+16,50</option>
                                            <option>+16,25</option>
                                            <option>+16,00</option>
                                            <option>+15,75</option>
                                            <option>+15,50</option>
                                            <option>+15,25</option>
                                            <option>+15,00</option>
                                            <option>+14,75</option>
                                            <option>+14,50</option>
                                            <option>+14,25</option>
                                            <option>+14,00</option>
                                            <option>+13,75</option>
                                            <option>+13,50</option>
                                            <option>+13,25</option>
                                            <option>+13,00</option>
                                            <option>+12,75</option>
                                            <option>+12,50</option>
                                            <option>+12,25</option>
                                            <option>+12,00</option>
                                            <option>+11,00</option>
                                            <option>+10,75</option>
                                            <option>+10,50</option>
                                            <option>+10,25</option>
                                            <option>+10,00</option>
                                            <option>+9,75</option>
                                            <option>+9,50</option>
                                            <option>+9,25</option>
                                            <option>+9,00</option>
                                            <option>+8,75</option>
                                            <option>+8,50</option>
                                            <option>+8,25</option>
                                            <option>+8,00</option>
                                            <option>+7,75</option>
                                            <option>+7,50</option>
                                            <option>+7,25</option>
                                            <option>+7,00</option>
                                            <option>+6,75</option>
                                            <option>+6,50</option>
                                            <option>+6,25</option>
                                            <option>+6,00</option>
                                            <option>+5,75</option>
                                            <option>+5,50</option>
                                            <option>+5,25</option>
                                            <option>+5,00</option>
                                            <option>+4,75</option>
                                            <option>+4,50</option>
                                            <option>+4,25</option>
                                            <option>+4,00</option>
                                            <option>+3,75</option>
                                            <option>+3,50</option>
                                            <option>+3,25</option>
                                            <option>+3,00</option>
                                            <option>+2,75</option>
                                            <option>+2,50</option>
                                            <option>+2,25</option>
                                            <option>+2,00</option>
                                            <option>+1,75</option>
                                            <option>+1,50</option>
                                            <option>+1,25</option>
                                            <option>+1,00</option>
                                            <option>+0,75</option>
                                            <option>+0,50</option>
                                            <option>+0,25</option>
                                            <option value="0" selected>0.00</option>
                                            <option>-0,25</option>
                                            <option>-0,50</option>
                                            <option>-0,75</option>
                                            <option>-1,00</option>
                                            <option>-1,25</option>
                                            <option>-1,50</option>
                                            <option>-1,75</option>
                                            <option>-2,00</option>
                                            <option>-2,25</option>
                                            <option>-2,50</option>
                                            <option>-2,75</option>
                                            <option>-3,00</option>
                                            <option>-3,25</option>
                                            <option>-3,50</option>
                                            <option>-3,75</option>
                                            <option>-4,00</option>
                                            <option>-4,25</option>
                                            <option>-4,50</option>
                                            <option>-4,75</option>
                                            <option>-5,00</option>
                                            <option>-5,25</option>
                                            <option>-5,50</option>
                                            <option>-5,75</option>
                                            <option>-6,00</option>
                                            <option>+6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-6,00</option>
                                            <option>-6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-7,00</option>
                                            <option>-7,25</option>
                                            <option>-7,50</option>
                                            <option>-7,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-9,00</option>
                                            <option>-9,25</option>
                                            <option>-9,50</option>
                                            <option>-9,75</option>
                                            <option>-10,00</option>
                                            <option>-10,25</option>
                                            <option>-10,50</option>
                                            <option>-10,75</option>
                                            <option>-11,00</option>
                                            <option>-11,25</option>
                                            <option>-11,50</option>
                                            <option>-11,75</option>
                                            <option>-12,00</option>
                                            <option>-12,25</option>
                                            <option>-12,50</option>
                                            <option>-12,75</option>
                                            <option>-13,00</option>
                                            <option>-13,25</option>
                                            <option>-13,50</option>
                                            <option>-13,75</option>
                                            <option>-14,00</option>
                                            <option>-14,25</option>
                                            <option>-14,50</option>
                                            <option>-14,75</option>
                                            <option>-15,00</option>
                                            <option>-15,25</option>
                                            <option>-15,50</option>
                                            <option>-15,75</option>
                                            <option>-16,00</option>
                                            <option>-16,25</option>
                                            <option>-16,50</option>
                                            <option>-16,75</option>
                                            <option>-17,00</option>
                                            <option>-17,25</option>
                                            <option>-17,50</option>
                                            <option>-17,75</option>
                                            <option>-18,00</option>
                                            <option>-18,25</option>
                                            <option>-18,50</option>
                                            <option>-18,75</option>
                                            <option>-19,00</option>
                                            <option>-19,25</option>
                                            <option>-19,50</option>
                                            <option>-19,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-22,00</option>
                                            <option>-22,25</option>
                                            <option>-22,50</option>
                                            <option>-22,75</option>
                                            <option>-23,00</option>
                                            <option>-23,25</option>
                                            <option>-23,50</option>
                                            <option>-23,75</option>
                                            <option>-24,00</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="od_cilindrico" class="form-control">

                                            <option value="0" selected>0.00</option>
                                            <option>-0,25</option>
                                            <option>-0,50</option>
                                            <option>-0,75</option>
                                            <option>-1,00</option>
                                            <option>-1,25</option>
                                            <option>-1,50</option>
                                            <option>-1,75</option>
                                            <option>-2,00</option>
                                            <option>-2,25</option>
                                            <option>-2,50</option>
                                            <option>-2,75</option>
                                            <option>-3,00</option>
                                            <option>-3,25</option>
                                            <option>-3,50</option>
                                            <option>-3,75</option>
                                            <option>-4,00</option>
                                            <option>-4,25</option>
                                            <option>-4,50</option>
                                            <option>-4,75</option>
                                            <option>-5,00</option>
                                            <option>-5,25</option>
                                            <option>-5,50</option>
                                            <option>-5,75</option>
                                            <option>-6,00</option>
                                            <option>+6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-6,00</option>
                                            <option>-6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-7,00</option>
                                            <option>-7,25</option>
                                            <option>-7,50</option>
                                            <option>-7,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-9,00</option>
                                            <option>-9,25</option>
                                            <option>-9,50</option>
                                            <option>-9,75</option>
                                            <option>-10,00</option>
                                            <option>-10,25</option>
                                            <option>-10,50</option>
                                            <option>-10,75</option>
                                            <option>-11,00</option>
                                            <option>-11,25</option>
                                            <option>-11,50</option>
                                            <option>-11,75</option>
                                            <option>-12,00</option>
                                            <option>-12,25</option>
                                            <option>-12,50</option>
                                            <option>-12,75</option>
                                            <option>-13,00</option>
                                            <option>-13,25</option>
                                            <option>-13,50</option>
                                            <option>-13,75</option>
                                            <option>-14,00</option>
                                            <option>-14,25</option>
                                            <option>-14,50</option>
                                            <option>-14,75</option>
                                            <option>-15,00</option>
                                            <option>-15,25</option>
                                            <option>-15,50</option>
                                            <option>-15,75</option>
                                            <option>-16,00</option>
                                            <option>-16,25</option>
                                            <option>-16,50</option>
                                            <option>-16,75</option>
                                            <option>-17,00</option>
                                            <option>-17,25</option>
                                            <option>-17,50</option>
                                            <option>-17,75</option>
                                            <option>-18,00</option>
                                            <option>-18,25</option>
                                            <option>-18,50</option>
                                            <option>-18,75</option>
                                            <option>-19,00</option>
                                            <option>-19,25</option>
                                            <option>-19,50</option>
                                            <option>-19,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-22,00</option>
                                            <option>-22,25</option>
                                            <option>-22,50</option>
                                            <option>-22,75</option>
                                            <option>-23,00</option>
                                            <option>-23,25</option>
                                            <option>-23,50</option>
                                            <option>-23,75</option>
                                            <option>-24,00</option>
                                        </select>
                                    </td>
                                    <td>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" aria-label=""
                                                aria-describedby="basic-addon2" name="od_eixo"
                                                value="{{ old('od_eixo') }}">
                                        </div>
                                    </td>

                                    <td>

                                        <div class="mb-3">
                                            <input type="text" class="form-control" aria-label=""
                                                aria-describedby="basic-addon2" name="acd"
                                                value="{{ old('acd') }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>OE</th>
                                    <td>
                                        <select name="oe_esferico" class="form-control">
                                            <option>+21,00</option>
                                            <option>+20,75</option>
                                            <option>+20,50</option>
                                            <option>+20,25</option>
                                            <option>+20,00</option>
                                            <option>+19,75</option>
                                            <option>+19,50</option>
                                            <option>+19,25</option>
                                            <option>+19,00</option>
                                            <option>+18,75</option>
                                            <option>+18,50</option>
                                            <option>+18,25</option>
                                            <option>+18,00</option>
                                            <option>+17,75</option>
                                            <option>+17,50</option>
                                            <option>+17,25</option>
                                            <option>+17,00</option>
                                            <option>+16,75</option>
                                            <option>+16,50</option>
                                            <option>+16,25</option>
                                            <option>+16,00</option>
                                            <option>+15,75</option>
                                            <option>+15,50</option>
                                            <option>+15,25</option>
                                            <option>+15,00</option>
                                            <option>+14,75</option>
                                            <option>+14,50</option>
                                            <option>+14,25</option>
                                            <option>+14,00</option>
                                            <option>+13,75</option>
                                            <option>+13,50</option>
                                            <option>+13,25</option>
                                            <option>+13,00</option>
                                            <option>+12,75</option>
                                            <option>+12,50</option>
                                            <option>+12,25</option>
                                            <option>+12,00</option>
                                            <option>+11,00</option>
                                            <option>+10,75</option>
                                            <option>+10,50</option>
                                            <option>+10,25</option>
                                            <option>+10,00</option>
                                            <option>+9,75</option>
                                            <option>+9,50</option>
                                            <option>+9,25</option>
                                            <option>+9,00</option>
                                            <option>+8,75</option>
                                            <option>+8,50</option>
                                            <option>+8,25</option>
                                            <option>+8,00</option>
                                            <option>+7,75</option>
                                            <option>+7,50</option>
                                            <option>+7,25</option>
                                            <option>+7,00</option>
                                            <option>+6,75</option>
                                            <option>+6,50</option>
                                            <option>+6,25</option>
                                            <option>+6,00</option>
                                            <option>+5,75</option>
                                            <option>+5,50</option>
                                            <option>+5,25</option>
                                            <option>+5,00</option>
                                            <option>+4,75</option>
                                            <option>+4,50</option>
                                            <option>+4,25</option>
                                            <option>+4,00</option>
                                            <option>+3,75</option>
                                            <option>+3,50</option>
                                            <option>+3,25</option>
                                            <option>+3,00</option>
                                            <option>+2,75</option>
                                            <option>+2,50</option>
                                            <option>+2,25</option>
                                            <option>+2,00</option>
                                            <option>+1,75</option>
                                            <option>+1,50</option>
                                            <option>+1,25</option>
                                            <option>+1,00</option>
                                            <option>+0,75</option>
                                            <option>+0,50</option>
                                            <option>+0,25</option>
                                            <option value="0" selected>0.00</option>
                                            <option>-0,25</option>
                                            <option>-0,50</option>
                                            <option>-0,75</option>
                                            <option>-1,00</option>
                                            <option>-1,25</option>
                                            <option>-1,50</option>
                                            <option>-1,75</option>
                                            <option>-2,00</option>
                                            <option>-2,25</option>
                                            <option>-2,50</option>
                                            <option>-2,75</option>
                                            <option>-3,00</option>
                                            <option>-3,25</option>
                                            <option>-3,50</option>
                                            <option>-3,75</option>
                                            <option>-4,00</option>
                                            <option>-4,25</option>
                                            <option>-4,50</option>
                                            <option>-4,75</option>
                                            <option>-5,00</option>
                                            <option>-5,25</option>
                                            <option>-5,50</option>
                                            <option>-5,75</option>
                                            <option>-6,00</option>
                                            <option>+6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-6,00</option>
                                            <option>-6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-7,00</option>
                                            <option>-7,25</option>
                                            <option>-7,50</option>
                                            <option>-7,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-9,00</option>
                                            <option>-9,25</option>
                                            <option>-9,50</option>
                                            <option>-9,75</option>
                                            <option>-10,00</option>
                                            <option>-10,25</option>
                                            <option>-10,50</option>
                                            <option>-10,75</option>
                                            <option>-11,00</option>
                                            <option>-11,25</option>
                                            <option>-11,50</option>
                                            <option>-11,75</option>
                                            <option>-12,00</option>
                                            <option>-12,25</option>
                                            <option>-12,50</option>
                                            <option>-12,75</option>
                                            <option>-13,00</option>
                                            <option>-13,25</option>
                                            <option>-13,50</option>
                                            <option>-13,75</option>
                                            <option>-14,00</option>
                                            <option>-14,25</option>
                                            <option>-14,50</option>
                                            <option>-14,75</option>
                                            <option>-15,00</option>
                                            <option>-15,25</option>
                                            <option>-15,50</option>
                                            <option>-15,75</option>
                                            <option>-16,00</option>
                                            <option>-16,25</option>
                                            <option>-16,50</option>
                                            <option>-16,75</option>
                                            <option>-17,00</option>
                                            <option>-17,25</option>
                                            <option>-17,50</option>
                                            <option>-17,75</option>
                                            <option>-18,00</option>
                                            <option>-18,25</option>
                                            <option>-18,50</option>
                                            <option>-18,75</option>
                                            <option>-19,00</option>
                                            <option>-19,25</option>
                                            <option>-19,50</option>
                                            <option>-19,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-22,00</option>
                                            <option>-22,25</option>
                                            <option>-22,50</option>
                                            <option>-22,75</option>
                                            <option>-23,00</option>
                                            <option>-23,25</option>
                                            <option>-23,50</option>
                                            <option>-23,75</option>
                                            <option>-24,00</option>

                                        </select>
                                    </td>
                                    <td>
                                        <select name="oe_cilindrico" class="form-control">

                                            <option value="0">0.00</option>
                                            <option>-0,25</option>
                                            <option>-0,50</option>
                                            <option>-0,75</option>
                                            <option>-1,00</option>
                                            <option>-1,25</option>
                                            <option>-1,50</option>
                                            <option>-1,75</option>
                                            <option>-2,00</option>
                                            <option>-2,25</option>
                                            <option>-2,50</option>
                                            <option>-2,75</option>
                                            <option>-3,00</option>
                                            <option>-3,25</option>
                                            <option>-3,50</option>
                                            <option>-3,75</option>
                                            <option>-4,00</option>
                                            <option>-4,25</option>
                                            <option>-4,50</option>
                                            <option>-4,75</option>
                                            <option>-5,00</option>
                                            <option>-5,25</option>
                                            <option>-5,50</option>
                                            <option>-5,75</option>
                                            <option>-6,00</option>
                                            <option>+6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-6,00</option>
                                            <option>-6,25</option>
                                            <option>-6,50</option>
                                            <option>-6,75</option>
                                            <option>-7,00</option>
                                            <option>-7,25</option>
                                            <option>-7,50</option>
                                            <option>-7,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-8,00</option>
                                            <option>-8,25</option>
                                            <option>-8,50</option>
                                            <option>-8,75</option>
                                            <option>-9,00</option>
                                            <option>-9,25</option>
                                            <option>-9,50</option>
                                            <option>-9,75</option>
                                            <option>-10,00</option>
                                            <option>-10,25</option>
                                            <option>-10,50</option>
                                            <option>-10,75</option>
                                            <option>-11,00</option>
                                            <option>-11,25</option>
                                            <option>-11,50</option>
                                            <option>-11,75</option>
                                            <option>-12,00</option>
                                            <option>-12,25</option>
                                            <option>-12,50</option>
                                            <option>-12,75</option>
                                            <option>-13,00</option>
                                            <option>-13,25</option>
                                            <option>-13,50</option>
                                            <option>-13,75</option>
                                            <option>-14,00</option>
                                            <option>-14,25</option>
                                            <option>-14,50</option>
                                            <option>-14,75</option>
                                            <option>-15,00</option>
                                            <option>-15,25</option>
                                            <option>-15,50</option>
                                            <option>-15,75</option>
                                            <option>-16,00</option>
                                            <option>-16,25</option>
                                            <option>-16,50</option>
                                            <option>-16,75</option>
                                            <option>-17,00</option>
                                            <option>-17,25</option>
                                            <option>-17,50</option>
                                            <option>-17,75</option>
                                            <option>-18,00</option>
                                            <option>-18,25</option>
                                            <option>-18,50</option>
                                            <option>-18,75</option>
                                            <option>-19,00</option>
                                            <option>-19,25</option>
                                            <option>-19,50</option>
                                            <option>-19,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-20,00</option>
                                            <option>-20,25</option>
                                            <option>-20,50</option>
                                            <option>-20,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-21,00</option>
                                            <option>-21,25</option>
                                            <option>-21,50</option>
                                            <option>-21,75</option>
                                            <option>-22,00</option>
                                            <option>-22,25</option>
                                            <option>-22,50</option>
                                            <option>-22,75</option>
                                            <option>-23,00</option>
                                            <option>-23,25</option>
                                            <option>-23,50</option>
                                            <option>-23,75</option>
                                            <option>-24,00</option>

                                        </select>
                                    </td>
                                    <td>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" aria-label=""
                                                aria-describedby="basic-addon2" name="oe_eixo"
                                                value="{{ old('oe_eixo') }}">
                                           
                                        </div>
                                    </td>

                                    <td>

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" aria-label=""
                                                aria-describedby="basic-addon2" name="ace"
                                                value="{{ old('ace') }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" aria-label=""
                                                aria-describedby="basic-addon2" name="ac"
                                                value="{{ old('ac') }}">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                  {{--   </div> --}}

                <div class="row mt-3">
                    <div class="col-12">
                        <label for="adicao" class="form-label">Adição</label>
                        <select class="form-select" aria-label="Default select example" id="adicao" name="adicao">

                            <option>+10,00</option>
                            <option>+9,75</option>
                            <option>+9,50</option>
                            <option>+9,25</option>
                            <option>+9,00</option>
                            <option>+8,75</option>
                            <option>+8,50</option>
                            <option>+8,25</option>
                            <option>+8,00</option>
                            <option>+7,75</option>
                            <option>+7,50</option>
                            <option>+7,25</option>
                            <option>+7,00</option>
                            <option>+6,75</option>
                            <option>+6,50</option>
                            <option>+6,25</option>
                            <option>+6,00</option>
                            <option>+5,75</option>
                            <option>+5,50</option>
                            <option>+5,25</option>
                            <option>+5,00</option>
                            <option>+4,75</option>
                            <option>+4,50</option>
                            <option>+4,25</option>
                            <option>+4,00</option>
                            <option>+3,75</option>
                            <option>+3,50</option>
                            <option>+3,25</option>
                            <option>+3,00</option>
                            <option>+2,75</option>
                            <option>+2,50</option>
                            <option>+2,25</option>
                            <option>+2,00</option>
                            <option>+1,75</option>
                            <option>+1,50</option>
                            <option>+1,25</option>
                            <option>+1,00</option>
                            <option>+0,75</option>
                            <option>+0,50</option>
                            <option>+0,25</option>
                            <option selected value="0">0</option>

                        </select>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <label for="obs" class="form-label">Observações</label>
                        <textarea id="obs" name="obs" class="form-control">{{ old('obs') }}</textarea>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-6">
                        <button type="submit" class="btn btn-lg btn-info" >Cadastrar</button>
                    </div>
                </div>

            </form>

        </div>


@endsection
