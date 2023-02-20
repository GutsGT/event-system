@extends('layouts.main')

@section('title', 'Meus Eventos')
@section('style', 'my_events.css')

@section('content')

    <div class="col-md-10 offset-md-1 title-container">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="name">Nome</th>
                        <th scope="col" class="date">Data</th>
                        <th scope="col" class="participants">Participantes</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td><a href="/events/{{$event->id}}" class="table-name">{{$event->title}}</a></td>
                            <td>{{date_format($event->date, 'd/m/Y H:i')}}</td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <a href="/events/manage?id={{$event->id}}" class="btn edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                                <form action="/events/{{$event->id}}" method="POST">
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
        @else
            <p>Você ainda não tem eventos, <a href="/events/manage">Criar evento</a></p>
        @endif
    </div>

@endsection