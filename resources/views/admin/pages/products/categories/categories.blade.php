@extends('adminlte::page')

@section('title', "Categorias do Produto {$product->title}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produto</a></li>
    </ol>
    <h1>Categorias do Produto <strong>{{$product->title}}</strong>
    <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">ADD NOVA CATEGORIA<i class="fas fa-plus-square"></i> </a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
                    @csrf
                        <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $category->description }}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger">Desvincular</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
