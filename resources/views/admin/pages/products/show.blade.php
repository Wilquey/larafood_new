@extends('adminlte::page')

@section('title', "Cadastrar Novo Produto {$product->title}")

@section('content_header')
<h1>Detalhes do Produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width:90px;">
                </li>
                <li>
                    <strong>Titulo: </strong> {{ $product->title }}
                </li>
                <li>
                    <strong>Preço: </strong> R$ {{ number_format($product->price, 2,',','.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> DELETAR O PRODUTO {{ $product->title }}</button>
            </form>
        </div>
    </div>
@endsection
