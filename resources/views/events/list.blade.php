@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')
    <div id="search-container" class="col-md-12">
        <h1>Busque um evento</h1>
        <form action="/events/list" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
        </form>
    </div>
    <div id="events-container" class="col-md-12">
        @if($search)
            <h2>Buscando por "{{$search}}"</h2>
        @else
            <h2>Próximos eventos</h2>
        @endif
        <div id="cards-container" class="row">
            @foreach($events as $event)
                <div class="card col-md-3">
                    @if($event->image)
                        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}"/>
                    @else
                        <img src="/img/empty.png" alt="{{ $event->title }}"/>
                    @endif
                    <div class="card-body">
                        <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-participants">{{count($event->users)}} participantes</p>
                        <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>
            @endforeach
            @if(count($events) == 0 && $search)
                <p>Não foi possível encontrar eventos. <a style="text-decoration: underline; color: blue;" href="/events/list">Ver todos</a></p>
            @elseif(count($events) == 0)
                <p>Não há eventos disponíveis nos próximos dias</p>
            @endif
            
        </div>
    </div>
@endsection