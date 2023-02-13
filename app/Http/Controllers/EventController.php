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

        return view('events.dashboard', ['events'=>$events]);
    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso.');
    }

}
