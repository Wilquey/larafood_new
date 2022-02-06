@extends('adminlte::page')

@section('title', "Usuários disponíveis para o Papel {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}" class="active">Papeis</a></li>
    </ol>
    <h1>Usuários disponíveis para o Papel <strong>{{$role->name}}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <form action="{{ route('roles.users.available', $role->id) }}" method="POST" class="form form-inline">
                    @csrf
                        <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        {{--  <th width="250">Ações</th>  --}}
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('roles.users.attach', $role->id) }}" method="post">
                        @csrf
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" name="users[]" id="" value="{{ $user->id }}">
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->description }}
                            </td>
                            {{--  <td style="width: 10px;">
                                <a href="{{ route('roles.edit', $user->id) }}" class="btn btn-info"><i class="fas fa-address-book"></i></a>
                            </td>  --}}
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
        </div>
    </div>
@stop
