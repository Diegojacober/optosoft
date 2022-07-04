@extends('adminlte::page')

@section('title', "$user->name")

@section('content')

    <div class="p-4">
        <div class="text-center mt-2">
            <img width="20%" height="20%" class="rounded" alt="uepa" src="https://ui-avatars.com/api/?name={{ $user->optometrist->name }}&rounded=true&background=random"> 
        </div>
        <form action="{{route('user.profile.update',$user->id)}}" enctype="multipart/form-data"
            class="p-3 w-100 d-flex align-items-center justify-content-center flex-column" method="POST">
            @csrf
            @method('PUT')

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
                <div class="alert-success p-2">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3 w-100">
                <label for="exampleInputEmail1" class="form-label text-left">Nome</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}">
            </div>

            <div class="mb-3 w-100">
                <label for="exampleInputEmail1" class="form-label text-left">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                    value="{{ $user->email }}">
            </div>

            <div class="mb-3 w-100">
                <label for="exampleInputEmail1" class="form-label text-left">Nova Senha</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1"/>
            </div>

            <div class="w-100">
                <button type="submit" class="btn btn-outline-success">Atualizar</button>
            </div>
        </form>
    </div>

@endsection
