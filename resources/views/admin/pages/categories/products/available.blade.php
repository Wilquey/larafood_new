@extends('adminlte::page')

@section('title', "Produtos disponíveis para a Categoria {$category->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
    <h1>Produtos disponíveis para a Categoria <strong>{{$category->name}}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <form action="{{ route('categories.products.available', $category->id) }}" method="POST" class="form form-inline">
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
                    <form action="{{ route('categories.products.attach', $category->id) }}" method="post">
                        @csrf
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <input type="checkbox" name="products[]" id="" value="{{ $product->id }}">
                            </td>
                            <td>
                                {{ $product->title }}
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            {{--  <td style="width: 10px;">
                                <a href="{{ route('products.edit', $category->id) }}" class="btn btn-info">Edit</a>
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
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
        </div>
    </div>
@stop
