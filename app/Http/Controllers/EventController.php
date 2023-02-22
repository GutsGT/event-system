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
                $join->on('event_user.event_id', '=', 'events.id')->where('event_user.user_id', '=', (auth()->user()? auth()->user()->id: null));
            })
            ->where([($search? ['title', 'like', '%'.$search.'%']: ['date', '>=', date('Y-m-d')])])
            ->orderBy('date')
            ->paginate($qttPerPage);
        

        $returnArray = ['events'=>$events, 'search'=>$search, 'qttPerPage'=>$qttPerPage];


        return view('events.list', $returnArray);
    }

    public function show(Event $event){
        $eventOwner = User::where('id', '=', $event->user_id)->first();

        $user = auth()->user();
        $joined = false;
        $isOwner = false;


        if($user){
            $eventJoined = Event::where('events.title', '=', $event->id)
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

        $request->validate([
            'title'=>'required|unique:events|max:70'
        ]);

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

    public function myEvents(Request $request){

        $qttPerPage = 10;

        $user = auth()->user();

        $order = [
            (request('order')? request('order'): 'date'), 
            (request('dir')? request('dir'): 'asc')
        ];
        
        $events = Event::select(DB::raw('events.*, count(event_user.event_id) as participants'))
            ->join('event_user', 'event_user.event_id', '=', 'events.id')
            ->where('events.user_id', '=', $user->id)
            ->groupBy('event_user.event_id')
            ->orderBy($order[0], $order[1])
            ->paginate($qttPerPage);
        

        return view('events.my_events', ['events'=>$events, 'qttPerPage'=>$qttPerPage]);
    }

    public function schedule(){

        $qttPerPage = 10;

        $user = auth()->user();
        
        $order = [
            (request('order')? request('order'): 'date'), 
            (request('dir')? request('dir'): 'asc')
        ];

        $events = Event::select('*')
            ->join('event_user', 'event_user.event_id', '=', 'events.id')
            ->where('event_user.user_id', '=', $user->id)
            ->orderBy($order[0], $order[1])
            ->paginate($qttPerPage);
        
        foreach($events as $event){
            $event->participants = count($event->users);
        }

        return view('events.schedule', ['events'=>$events, 'qttPerPage'=>$qttPerPage]);
    }

    public function destroy(Event $event){

        if(!$this->userIsEventOwner($event)){
            return redirect('/my_events')->with('msg', 'Não é possível excluir evento');
        }

        Event::findOrFail($event->id)->delete();

        return redirect('/my_events')->with('msg', 'Evento excluído com sucesso.');
    }

    public function manage(){

        $returnArray = [];
        if(request('title')){
            $event = Event::where('title', '=', request('title'))->first();
            if(!$this->userIsEventOwner($event)){
                return redirect('/my_events')->with('msg', 'Não é possível editar evento');
            }
    
            $returnArray['event'] = $event;
        }

        return view('events.manage', $returnArray);
    }

    public function update(Event $event, Request $request){

        $request->validate([
            'title'=>'required|unique:events|max:70'
        ]);


        $data = $request->all();
        if($request->hasFile('image') && $request->file('image')->isValid()){
            
            //Comando para apagar a imagem anterior
            if($event->image){
                unlink(public_path('img/events/'.$event->image));
            }

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName().strtotime("now")).".".$extension;

            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        $event->update($data);

        return redirect('/events/'.$event->title)->with('msg', 'Evento editado com sucesso.');

    }

    public function joinEvent(Event $event){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($event->id);

        return redirect("/events/$event->title")->with('msg', 'Presença confirmada');
    }

    private function userIsEventOwner(Event $event){
        $user = auth()->user();

        return ($user->id == $event->user_id);
    } 

    public function leaveEvent(Event $event){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($event->id);

        return redirect('/schedule')->with('msg', 'Presença removida');
    }
}
