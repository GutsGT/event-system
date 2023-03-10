@extends('layouts.main')

@section('title', 'Agenda')
@section('style', 'schedule.css')

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
        <h1>Eventos com presença confirmada</h1>
    </div>
    <div class="col-md-10 offset-md-1 events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="name">
                            <a href="/schedule?order=title&dir={{$dir}}">
                                Nome
                                @if(request('order') == 'title')
                                    <ion-icon class="order" name="{{($dir == 'desc')?'caret-down-outline':'caret-up-outline'}}"></ion-icon>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="date">
                            <a href="/schedule?order=date&dir={{$dir}}">
                                Data
                                @if(request('order') == 'date')
                                    <ion-icon class="order" name="{{($dir == 'desc')?'caret-down-outline':'caret-up-outline'}}"></ion-icon>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="participants">
                            Participantes
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
                            <td>{{count($event->users)}}</td>
                            <td>
                                <form action="/events/leave/{{$event->title}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon> Remover presença
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if($events->total() > $qttPerPage)
                @include('layouts.pagination', ['objects'=>$events, 'qttPerPage'=>$qttPerPage])
            @endif
        @else
            <p>Você ainda não está participando de nenhum evento, <a href="/events/myevents">Veja todos os eventos</a>.</p>
        @endif
    </div>


@endsection