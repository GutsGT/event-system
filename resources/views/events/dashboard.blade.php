@extends('layouts.main')

@section('title', 'Dashboard')
@section('style', 'dashboard.css')

@section('content')

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="name">Nome</th>
                        <th scope="col" class="participants">Participantes</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td><a href="/events/{{$event->id}}" class="table-name">{{$event->title}}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <a href="/events/edit/{{$event->id}}" class="btn edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
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
        @else
            <p>Você ainda não tem eventos, <a href="/events/create">Criar evento</a></p>
        @endif
    </div>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Eventos que estou participando</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($eventsasparticipant) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="name">Nome</th>
                        <th scope="col" class="participants">Participantes</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventsasparticipant as $event)
                        <tr>
                            <td><a href="/events/{{$event->id}}" class="table-name">{{$event->title}}</a></td>
                            <td>{{count($event->users)}}</td>
                            <td>
                                <form action="/events/leave/{{$event->id}}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon> Sair do evento
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não está participando de nenhum evento, <a href="/events/list">Veja todos os eventos</a>.</p>
        @endif
    </div>


@endsection