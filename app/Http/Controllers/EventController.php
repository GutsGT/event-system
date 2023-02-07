<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function list(){
        $events = Event::all();
        return view('events.list', ['events'=>$events]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){

        $event = new Event;
        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        $event->save();

        return redirect('/events/list');
    }
}
