@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">ADD <i class="fas fa-plus-square"></i> </a></h1>
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
                        <th style="max-width:90px;">Imagem</th>
                        <th>Nome</th>
                        <th>Flag</th>
                        <th>Descrição</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width:90px;">                                
                            </td>
                            <td>
                                {{ $product->title }}
                            </td>
                            <td>
                                {{ $product->flag }}
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            <td style="width: 50px;">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-secondary"><i class="fas fa-layer-group"></i></a>
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
