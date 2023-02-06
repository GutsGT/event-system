@extends('layouts.main')
@section('title', 'Products')
@section('content')
    <h1>Esta é a página de produtos</h1>
    @if($busca)
        <p>O usuário está buscando por {{$busca}}</p>
    @endif
    <a href="/">Voltar para home</a>
@endsection