@extends('adminlte::page')

@section('title', "Perfis disponíveis para a Permissão {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active">Perfis</a></li>
    </ol>
    <h1>Perfis disponíveis para a Permissão <strong>{{$permission->name}}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <form action="{{ route('permissions.profiles.available', $permission->id) }}" method="POST" class="form form-inline">
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
                    <form action="{{ route('permissions.profiles.attach', $permission->id) }}" method="post">
                        @csrf
                        @foreach ($profiles as $profile)
                        <tr>
                            <td>
                                <input type="checkbox" name="profiles[]" id="" value="{{ $profile->id }}">
                            </td>
                            <td>
                                {{ $profile->name }}
                            </td>
                            <td>
                                {{ $profile->description }}
                            </td>
                            {{--  <td style="width: 10px;">
                                <a href="{{ route('profiles.edit', $permission->id) }}" class="btn btn-info">Edit</a>
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
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
        </div>
    </div>
@stop
