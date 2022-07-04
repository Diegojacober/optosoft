@extends('adminlte::page')

@section('title', 'Meus Usuários')

@section('content')

    <h1 class="pt-4 display-5" align="center"> Meus Usuários <a data-bs-toggle="modal" data-bs-target="#newUSer" href="#"
            class="btn btn-sm btn-secondary">Novo<i class="ml-2 fa-solid fa-circle-plus"></i></a></h1>

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

    <div class="table-responsive">
        <table class="table table-hover mt-5">
            <tbody>
                <thead>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ultimo Acesso</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row"><img style="border-radius: 10%" class="" width="50" height="50"
                                src="https://ui-avatars.com/api/?name={{ $user->name }}&rounded=true&background=random"
                                alt="{{ $user->name }}"></th>
                        <td class="pt-4">{{ $user->name }}</td>
                        <td class="pt-4">{{ $user->email }}</td>
                        <td class="pt-4">{{ date('d/m/Y H:i:s', strtotime($user->last_access)) }}</td>
                        <td class="pt-4"><a class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#permissions-{{$user->id}}" href="#" ><i
                                    class="fa-solid fa-circle-check"></i> Permissões</a></td>
                        <td class="pt-4"><a class="btn btn-sm text-light" style="background: #06283D" href="{{route('user.profile.edit',$user->id)}}"><i
                                    class="fa-solid fa-pen-to-square"></i> Editar</a></td>
                        <td class="pt-4"><a href="#" onclick="deleteUser({{$user->id}},'{{$user->name}}')" id="userDelete" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i> Apagar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="py-4">
        {{ $users->links() }}
    </div>

    @foreach ($users as $user)
        {{-- permissões --}}
        <div class="modal fade" id="permissions-{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="staticBackdropLabel">Permissões de {{$user->name}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('permissions.store',$user->id) }}" id="permissionsForm-{{$user->id}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <div class="row ml-4">
                                    @foreach ($oticas as $i => $otica)
                                    @if ($otica->ativo == 0)
                                        <div class="col-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    name="oticas[{{$otica->id}}]" value="{{ $otica->id }}"
                                                    id="switch{{$user->id}}{{$otica->id}}" 
                                                    @foreach ($user->permissoes as $permissao)
                                                        @if ($permissao->otica_id == $otica->id)
                                                            @checked(true)
                                                        @endif
                                                    @endforeach>
                                                <label class="form-check-label"
                                                    for="switch{{$user->id}}{{$otica->id}}">{{ $otica->nome }}</label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="formSubmit('permissionsForm-{{$user->id}}')">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- novo usuário --}}
    <div class="modal fade" id="newUSer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="staticBackdropLabel">Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" id="formNewUser" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nome</label>
                            <input type="text" id="UserName" name="name" class="form-control"
                                placeholder="Digite o nome do novo usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Email</label>
                            <input type="email" id="UserEmail" name="email" class="form-control"
                                placeholder="Digite o email do usuário" required>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Senha</label>
                            <input type="password" id="UserPassword" name="password" class="form-control"
                                placeholder="Digite uma senha para acesso" required>
                        </div>

                        <div class="mb-3">
                            <div class="row ml-4">
                                @foreach ($oticas as $i => $otica)
                                    @if ($otica->ativo == 0)
                                        <div class="col-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    name="oticas[{{ $otica->id }}]" value="{{ $otica->id }}"
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault">{{ $otica->nome }}</label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnNewUser">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
