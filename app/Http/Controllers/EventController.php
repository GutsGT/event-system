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

    public function dashboard(){

        $user = auth()->user();
        $events = $user->events;

        for($f = 0; $f < count($events); $f++){
            for($f2 = $f; $f2 < count($events); $f2++){
                if($events[$f2]->title < $events[$f]->title){
                    $aux = $events[$f2];
                    $events[$f2] = $events[$f];
                    $events[$f] = $aux;
                }
            }
        }

        $eventsAsParticipant = $user->eventsAsParticipant;

        for($f = 0; $f < count($eventsAsParticipant); $f++){
            for($f2 = $f; $f2 < count($eventsAsParticipant); $f2++){
                if($eventsAsParticipant[$f2]->title < $eventsAsParticipant[$f]->title){
                    $aux = $eventsAsParticipant[$f2];
                    $eventsAsParticipant[$f2] = $eventsAsParticipant[$f];
                    $eventsAsParticipant[$f] = $aux;
                }
            }
        }

        return view('events.dashboard', ['events'=>$events, 'eventsasparticipant'=>$eventsAsParticipant]);
    }

    public function destroy($id){

        if(!$this->userIsEventOwner($id)){
            return redirect('/dashboard')->with('msg', 'Não é possível excluir evento');
        }

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso.');
    }

    public function manage(){

        $returnArray = [];
        if(request('id')){
            $id = request('id');
            if(!$this->userIsEventOwner($id)){
                return redirect('/dashboard')->with('msg', 'Não é possível editar evento');
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

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso.');

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
        return redirect('/dashboard')->with('msg', 'Presença removida');
    }
}
