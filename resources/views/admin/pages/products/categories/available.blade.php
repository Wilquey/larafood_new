@extends('adminlte::page')

@section('title', "Categorias disponíveis para o Produto {$product->title}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
    <h1>Categorias disponíveis para o Produto <strong>{{$product->title}}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
                <form action="{{ route('products.categories.available', $product->id) }}" method="POST" class="form form-inline">
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
                    <form action="{{ route('products.categories.attach', $product->id) }}" method="post">
                        @csrf
                        @foreach ($categories as $category)
                        <tr>
                            <td>
                                <input type="checkbox" name="categories[]" id="" value="{{ $category->id }}">
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $category->description }}
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
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif
        </div>
    </div>
@stop
