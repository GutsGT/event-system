<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller{

    public function index(){
        return view('welcome');
    }

    public function list(){

        $search = request('search');

        $qttPerPage = 12;

        $events = Event::select('events.*', 'event_user.user_id as joined')
            ->leftJoin('event_user', function (JoinClause $join) {
                $join->on('event_user.event_id', '=', 'events.id')->where('event_user.user_id', '=', auth()->user()->id);
            })
            ->where([($search? ['title', 'like', '%'.$search.'%']: ['date', '>=', date('Y-m-d')])])
            ->orderBy('date')
            ->paginate($qttPerPage);
        

        $returnArray = ['events'=>$events, 'search'=>$search, 'qttPerPage'=>$qttPerPage];


        return view('events.list', $returnArray);
    }

    public function show($id){

        $event = Event::findOrFail($id);
        $eventOwner = User::where('id', '=', $event->user_id)->first();

        $user = auth()->user();
        $joined = false;
        $isOwner = false;


        if($user){
            $eventJoined = Event::where('events.id', '=', $id)
                ->where('event_user.user_id', '=', $user->id)
                ->join('event_user', 'event_id', '=', 'id')->first();

            if($eventJoined){
                $joined = true;
            }
            
            $isOwner = ($eventOwner->id == $user->id);
        }



        return view('events.show', ['event'=>$event, 'eventOwner'=>$eventOwner, 'joined'=>$joined, 'isOwner'=>$isOwner]);
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

    public function myEvents(){

        $qttPerPage = 10;

        $user = User::where('id', '=', auth()->user()->id)
            ->first();
        $events = Event::where('user_id', '=', $user->id)
            ->orderBy('title')
            ->paginate($qttPerPage);
        

        return view('events.my_events', ['events'=>$events, 'qttPerPage'=>$qttPerPage]);
    }

    public function schedule(){

        $qttPerPage = 10;

        $user = User::where('id', '=', auth()->user()->id)
            ->first();

        $events = Event::join('event_user', 'event_user.event_id', '=', 'events.id')
            ->where('event_user.user_id', '=', $user->id)
            ->orderBy('events.title')
            ->paginate($qttPerPage);

        return view('events.schedule', ['events'=>$events, 'qttPerPage'=>$qttPerPage]);
    }

    public function destroy($id){

        if(!$this->userIsEventOwner($id)){
            return redirect('/my_events')->with('msg', 'Não é possível excluir evento');
        }

        Event::findOrFail($id)->delete();

        return redirect('/my_events')->with('msg', 'Evento excluído com sucesso.');
    }

    public function manage(){

        $returnArray = [];
        if(request('id')){
            $id = request('id');
            if(!$this->userIsEventOwner($id)){
                return redirect('/my_events')->with('msg', 'Não é possível editar evento');
            }
    
            $returnArray['event'] = Event::findOrFail($id);
        }

        return view('events.manage', $returnArray);
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

        return redirect('/events/'.$request->id)->with('msg', 'Evento editado com sucesso.');

    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect("/events/$id")->with('msg', 'Presença confirmada');
    }

    private function userIsEventOwner($id){
        $user = auth()->user();
        $event = Event::findOrFail($id);

        return ($user->id == $event->user_id);
    } 

    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);
        return redirect('/schedule')->with('msg', 'Presença removida');
    }
}
