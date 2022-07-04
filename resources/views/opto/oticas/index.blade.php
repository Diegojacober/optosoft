@extends('adminlte::page')

@section('title', 'Óticas Cadastradas')

@section('content')

<h1 class="pt-4 display-5" align="center"> Óticas Cadastradas <a data-bs-toggle="modal" data-bs-target="#newOtica" href="#" class="btn btn-sm btn-secondary">Nova<i class="ml-2 fa-solid fa-circle-plus"></i></a></h1>

<div class="p-2 m-4" style="display:flex;justify-content:center;align-items:center">
    <div class="botoes">
        <a href="#" id="btn-ativos" class="btn btn-outline-success mr-4">Ativos</a>
        <a href="#" id="btn-inativos"class="btn btn-outline-danger">Inativos</a>
    </div>
</div>


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


<div class="table-responsive" id="ativos" style="display: none">
    <table class="table table-hover mt-5">
        <tbody>
            @forelse ($ativos as $otica)
                <tr>
                    <th scope="row"><img style="border-radius: 10%" class="" width="50" height="50" src="https://ui-avatars.com/api/?name={{$otica->nome}}&rounded=true&background=random" alt="{{$otica->nome}}" ></td>
                    <td class="pt-4">{{ $otica->nome }}</td>
                    <td class="pt-4">{{ $otica->cidade }}</td>
                    <td class="pt-4">{{ $otica->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="pt-4"><a  href="#" class="btn btn-sm btn-info"  onclick="editOtica('{{$otica->id}}','{{$otica->nome}}','{{$otica->cidade}}')" data-otica-id="{{$otica->id}}"><i class="fa-solid fa-pen"></i> Editar</a></td>
                    <td class="pt-4"><a class="btn btn-sm text-light" style="background: #06283D" href="{{route('otica.action',$otica->id)}}"><i class="fa-solid fa-power-off"></i> Inativar</a></td>
                </tr>
                @empty
                <h4 align="center">Nenhuma ótica ativa no momento.</h5>
            @endforelse
        </tbody>
    </table>
</div>

<div class="table-responsive " id="inativos" style="display: none">
    <table class="table table-hover mt-5">
        <tbody>
          @forelse ($inativos as $otica)
                <tr>
                    <th scope="row"><img style="border-radius: 10%" class="" width="50" height="50" src="https://ui-avatars.com/api/?name={{$otica->nome}}&rounded=true&background=random" alt="{{$otica->nome}}" ></td>
                    <td class="pt-4">{{ $otica->nome }}</td>
                    <td class="pt-4">{{ $otica->cidade }}</td>
                    <td class="pt-4">{{ $otica->created_at->format('d/m/Y H:i:s') }}</td>
                    <td class="pt-4"><a href="#" class="btn btn-sm btn-info"  onclick="editOtica('{{$otica->id}}','{{$otica->nome}}','{{$otica->cidade}}')" data-otica-id="{{$otica->id}}" ><i class="fa-solid fa-pen-to-square"></i> Editar</a></td>
                    <td class="pt-4"><a class="btn btn-sm text-light" style="background: #06283D" href="{{route('otica.action',$otica->id)}}"><i class="fa-solid fa-power-off mr-2"></i> Ativar</a></td>
                </tr>
                @empty
                <h4 align="center">Nenhuma ótica inativa no momento.</h5>
                @endforelse
        </tbody>
    </table>
</div>

  
  <!-- Modal -->
  <div class="modal fade" id="newOtica" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="staticBackdropLabel">Cadastrar nova ótica</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('otica.store')}}" id="formOtica" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nome</label>
                  <input type="text" id="cadNome" name="nome" class="form-control" placeholder="Digite o nome da ótica" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Cidade</label>
                  <input type="text" id="cadCidade" name="cidade" class="form-control" placeholder="Digite o nome da cidade" required>
                </div>
              </form>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary mr-3" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" id="cadaOtica">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>


  {{-- modal edit --}}
  <div class="modal fade" id="modalEditOtica" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditOtica" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="staticBackdropLabel">Cadastrar nova ótica</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/opto/oticas/edit/" id="formEditOtica" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nome</label>
                  <input type="text" name="nome" class="form-control" id="editNomeOtica" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Cidade</label>
                  <input type="text" name="cidade" class="form-control" id="editCidadeOtica" required>
                </div>
              </form>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-secondary mr-3" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-success" id="btnEditOtica">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  
@endsection