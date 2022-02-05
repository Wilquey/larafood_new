@extends('adminlte::page')

@section('title', "Produtos das Categoria {$category->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Perfis</a></li>
    </ol>
    <h1>Produtos das Categoria <strong>{{$category->name}}</strong>
    <a href="{{ route('categories.products.available', $category->id) }}" class="btn btn-dark">ADD NOVA CATEGORIA<i class="fas fa-plus-square"></i> </a></h1>
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
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                {{ $product->title }}
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            <td style="width: 10px;">
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop
