@extends('layouts.main')

@if(isset($event))
    @section('title', 'Editando '. $event->title)
@else
    @section('title', 'Criando evento')
@endif


@section('style', 'event_manage.css')

@section('content')
    <div id="event-manage-container" class="col-md-6 offset-md-3">
        @if(isset($event))
            <h1>Editando evento</h1>
        @else
            <h1>Criando evento</h1>
        @endif
        <form action="@if(isset($event)) /events/update/{{$event->id}} @else /events @endif" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($event))
                @method('PUT')
            @else
                <?php
                    $event = new App\Models\Event();
                    $event->image = $event->title = $event->date = $event->city = $event->description = "";
                    
                ?>
            @endif

            <div class="image-group">
                <label for="image" class="image-label">
                    <input type="file" class="form-control-file" id="image" name="image">
                    <span class="preview">
                        @if(isset($event->image) && !empty($event->image))
                            <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview"/>
                        @else
                            Escolher imagem
                        @endif
                    </span>
                </label>

            </div>
            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">    
            </div>
            <div class="form-group">
                <label for="title">Data:</label>
                <input type="date" class="form-control" id="date" name="date" value="{{$event->date->format('Y-m-d')}}">
            </div>
            <div class="form-group">
                <label for="title">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{$event->city}}">
            </div>
            <div class="form-group">
                <label for="title">O evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private == 1? "selected='selected'": ""}}>Sim</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Descrição:</label>
                <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{$event->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Adicione itens de infraestrutura:</label>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cadeiras"/> Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco"/> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Cerveja grátis"/> Cerveja Grátis
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open food"/> Open food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Brindes"/> Brindes
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Editar evento">
        </form>
    </div>
@endsection

@section('js', 'manage.js')