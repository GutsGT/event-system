<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller{

    public function create(){
        return view('events.create');
    }
    public function index(){
        return view('welcome');
    }

    public function list(){

        $search = request('search');

        if($search){
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }else{
            $events = Event::all();
        }

        return view('events.list', ['events'=>$events, 'search'=>$search]);
    }

    public function show(int $id){
        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        if(empty($event->image)){
            $event->image = "../empty.png";
        }

        return view('events.show', ['event'=>$event, 'eventOwner'=>$eventOwner]);
    }

    public function store(Request $request){

        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/events/list')->with("msg", "Evento criado com sucesso!");
    }

    public function dashboard(){
        $user = auth()->user();
        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', ['events'=>$events, 'eventsasparticipant'=>$eventsAsParticipant]);
    }

    public function destroy($id){

        if(!$this->userIsEventOwner($id)){
            return redirect('/dashboard')->with('msg', 'Não é possível excluir evento');
        }

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso.');
    }

    public function edit($id){

        if(!$this->userIsEventOwner($id)){
            return redirect('/dashboard')->with('msg', 'Não é possível editar evento');
        }

        $event = Event::findOrFail($id);

        return view('events.edit', ['event'=>$event]);
    }

    public function update(Request $request){
        $data = $request->all();
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            //Comando para apagar a imagem anterior
            $event = Event::findOrFail($request->id);
            if($event->image){
                unlink(public_path('img/events/'.$event->image));
            }

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso.');

    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento '.$event->title);
    }

    private function userIsEventOwner($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);

        return ($user->id == $event->user_id);
    } 
}
