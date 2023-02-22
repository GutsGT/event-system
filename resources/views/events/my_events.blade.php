@extends('layouts.main')

@section('title', 'Meus Eventos')
@section('style', 'my_events.css')

@section('content')

@php
    if(request()->has('dir')){
        if(request('dir') == 'asc'){
            $dir = 'desc';
        }else{
            $dir = 'asc';
        }

    }else{
        $dir = 'asc';
    }
@endphp

    <div class="col-md-10 offset-md-1 title-container">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="name">
                            <a href="/my_events?order=title&dir={{$dir}}">
                                Nome
                                @if(request('order') == 'title')
                                    <ion-icon class="order" name="{{($dir == 'desc')?'caret-down-outline':'caret-up-outline'}}"></ion-icon>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="date">
                            <a href="/my_events?order=date&dir={{$dir}}">
                                Data
                                @if(request('order') == 'date')
                                    <ion-icon class="order" name="{{($dir == 'desc')?'caret-down-outline':'caret-up-outline'}}"></ion-icon>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="participants">
                            <a href="/my_events?order=participants&dir={{$dir}}">
                                Participantes
                                @if(request('order') == 'participants')
                                    <ion-icon class="order" name="{{($dir == 'desc')?'caret-down-outline':'caret-up-outline'}}"></ion-icon>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="actions">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td><a href="/events/{{$event->title}}" class="table-name">{{$event->title}}</a></td>
                            <td>{{date_format($event->date, 'd/m/Y H:i')}}</td>
                            <td>{{$event->participants}}</td>
                            <td>
                                <a href="/events/manage?title={{$event->title}}" class="btn edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                                <form action="/events/{{$event->title}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($events->total() > $qttPerPage)
                @include('layouts.pagination', ['objects'=>$events, 'qttPerPage'=>$qttPerPage])
            @endif

            {{request('old')}}
        @else
            <p>Você ainda não tem eventos, <a href="/events/manage">Criar evento</a></p>
        @endif
    </div>

@endsection