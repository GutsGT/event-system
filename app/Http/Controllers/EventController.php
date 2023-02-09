<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        if(empty($event->image)){
            $event->image = "../empty.png";
        }

        return view('events.show', ['event'=>$event]);
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

        $event->save();

        return redirect('/events/list')->with("msg", "Evento criado com sucesso!");
    }

}
