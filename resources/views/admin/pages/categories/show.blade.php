@extends('adminlte::page')

@section('title', "Cadastrar Nova Categoria {$category->name}")

@section('content_header')
<h1>Detalhes da Categoria <b>{{ $category->name }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>url: </strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> DELETAR O CATEGORIA {{ $category->name }}</button>
            </form>
        </div>
    </div>
@endsection
