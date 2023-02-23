@extends('layouts.main')

@section('title', $event->title)
@section('style', 'event_show.css')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                @if($event->image)
                    <img src="/img/events/{{$event->image}}" class="img-fluid"  alt="">
                @else
                    <div class="no-image"></div>
                @endif
                @if($isOwner)
                    <div class="btn-container">
                        <a href="/events/manage?title={{$event->title}}" class="btn edit-btn"><ion-icon name="create-outline" role="img" class="md hydrated" aria-label="create outline"></ion-icon> Editar</a>
                        <form action="/events/{{$event->title}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn delete-btn"><ion-icon name="trash-outline" role="img" class="md hydrated" aria-label="trash outline"></ion-icon> Deletar</button>
                        </form>
                    </div>
                @endif
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{$event->title}}</h1>
                <p class="event-city">
                    <ion-icon name="location-outline"></ion-icon>
                    {{$event->city}}
                </p>
                <p class="event-date">
                    <ion-icon name="time-outline"></ion-icon>
                    {{date_format($event->date, 'd/m/Y H:i')}}
                </p>
                <p class="events-participants">
                    <ion-icon name="people-outline"></ion-icon>
                    {{count($event->users)}} participantes    
                </p>
                <p class="events-owner">
                    <ion-icon name="star-outline"></ion-icon>
                    {{$eventOwner['name']}}
                </p>
                <ul id="items-list">
                    @if($event->items)
                        @foreach($event->items as $item)
                            <li><ion-icon name="play-outline"></ion-icon><span>{{$item}}</span></li>
                        @endforeach
                    @endif
                </ul>
                @if(!$joined)
                    <form action="/events/join/{{$event->title}}" method="POST">
                        @csrf
                        <a href="/events/join/{{$event->title}}" 
                            class="btn btn-primary" 
                            id="event-submit" 
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            Confirmar presença
                        </a>
                    </form>
                @else
                    <p class="already-joined-msg">Presença confirmada</p>
                @endif
            </div>
            <div class="col-md-12" id="description-container">
                <h1>Sobre o evento:</h1>
                <p class="event-description">
                    {{$event->description}}
                </p>
            </div>
        </div>
    </div>

@endsection