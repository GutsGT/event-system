@extends('layouts.main')

@section('title', 'Products')

@section('content')
    @if($id != null)
        <h1>Exibindo produto id: {{ $id }}</h1>
    @endif
    <a href="/">Voltar para home</a>
@endsection