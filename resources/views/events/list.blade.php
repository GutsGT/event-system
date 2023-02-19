@extends('layouts.main')

@section('title', 'HDC Events')
@section('style', 'event_list.css')

@section('content')
    <div id="search-container">
        <h1>Buscar evento</h1>
        <form action="/events/list" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar">
        </form>
    </div>
    <h2 class="events-title">
        @if($search)
            Buscando por "{{$search}}"
        @else
            Próximos eventos
        @endif
    </h2>
    <div id="events-container">
        @foreach($events as $event)
            <div class="card">
                <a href="/events/{{$event->id}}" class="card-link">
                    <div class="card-image" style="@if($event->image)background-image: url(/img/events/{{$event->image}}) @endif"></div>
                </a>
                <div class="card-body">
                    <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <div class="participants">
                        <p class="card-participants">
                            @if(count($event->users) == 1)
                                {{count($event->users)}} participante
                            @else
                                {{count($event->users)}} participantes
                            @endif
                        </p>
                        @if(auth()->user() && $event->joined == auth()->user()->id)
                            <p class="card-participants joined">(Participando)</p>
                        @endif
                    </div>
                    <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possível encontrar eventos. <a style="text-decoration: underline; color: blue;" href="/events/list">Ver todos</a></p>
        @elseif(count($events) == 0 && !request('page'))
            <p>Não há eventos disponíveis nos próximos dias</p>
        @endif
        </div>
        @if($events->total() >= 12)
            <div class="pagination">
                @include('layouts.pagination', ['objects'=>$events, 'qttPerPage'=>$qttPerPage])
            </div>
        @endif
    </div>
@endsection