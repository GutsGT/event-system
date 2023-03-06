@extends('layouts.main')

@section('title', 'Listagem de eventos')
@section('style', 'event_list.css')

@section('content')
    <div class="search-container">
        <h1>Buscar evento</h1>
        <form action="/events/list" method="GET">
            <input 
                type="text" 
                id="search" 
                name="search" 
                class="search-input" 
                placeholder="Procurar"
                @if(request('search'))
                    value="{{request('search')}}"
                @endif
            >
            <button type="submit" class="btn-search"><ion-icon name="search-outline"></ion-icon></button>
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
                <a href="/events/{{$event->title}}" class="card-link">
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
                    <a href="/events/{{$event->title}}" class="btn btn-primary">Saber mais</a>
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
            @include('layouts.pagination', ['objects'=>$events, 'qttPerPage'=>$qttPerPage])
            
        @endif
    </div>
@endsection