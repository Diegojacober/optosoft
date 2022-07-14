@extends('adminlte::page')

@section('title', 'Optosoft')

@section('content')

    @if ($user->is_optometrist == 1)
        <div class="row pt-4">
            <div class="col-lg-6 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalConsultasHoje}}</h3>
                        <p>Consultas Confirmadas (hoje)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <a href="{{route('agenda.index')}}" class="small-box-footer">Mais Informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>



            <div class="col-lg-6 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$totalReceitasHoje}}</h3>
                        <p>Pacientes Atendidos (hoje)</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-person-circle-check"></i>
                    </div>
                    <a href="{{route('receitas.index')}}" class="small-box-footer">Mais Informações <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Usuários
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <thead>

                                    </thead>
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <th scope="row"><img style="border-radius: 10%" class="" width="50"
                                                    height="50"
                                                    src="https://ui-avatars.com/api/?name={{ $usuario->name }}&rounded=true&background=random"
                                                    alt="{{ $usuario->name }}"></th>
                                            <td class="pt-4">{{ $usuario->name }}</td>
                                            <td class="pt-4">
                                                @if ($usuario->status == 1)
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="mr-2"
                                                            style="width: 20px;height:20px;border-radius:15px;background:green">
                                                        </div>
                                                        <div>Online</div>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="mr-2"
                                                            style="width: 20px;height:20px;border-radius:15px;background:red">
                                                        </div>
                                                        <div>Offline</div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-8">

                <div class="card">
                    <div class="card-header">
                        Sugestão ou Reclamação
                    </div>
                    <div class="card-body">
                        <form id="formSugestion">
                            <p class="small">Escreva uma sugestão de funcionalidade para o sistema ou uma reclamação.</p>
                            <textarea style="resize: none" name="sugestion" id="bodySuggestion" class="form-control" rows="5"></textarea>
                            <button type="submit" class="btn btn-outline-dark mt-3">Enviar</button>
                        </form>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-4">
                <div class="info-box mb-3 bg-dark">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuários</span>
                        <span class="info-box-number">{{$totalUsuarios}}</span>
                    </div>

                </div>

                <div class="info-box mb-3 bg-light">
                    <span class="info-box-icon"><i class="fa-solid fa-file-circle-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Receitas</span>
                        <span class="info-box-number">{{$totalReceitas}}</span>
                    </div>

                </div>

                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fa-solid fa-glasses"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Óticas</span>
                        <span class="info-box-number">{{$totalOticas}}</span>
                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
