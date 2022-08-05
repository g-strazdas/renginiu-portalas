<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\EventModel;
use App\Models\Registration;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\lessThanOrEqual;

class EventController extends Controller
{
    public function __construct()
    {$this->middleware('auth', ['except' => ['index', 'about', 'showEvent', 'contacts', 'showRegistration','storeRegistration']]);}

    public function index()
    {
        $events = EventModel::all();    //gauname duomenis apie visus renginius iš db
        return view('pages.home', compact('events'));  //gražiname šabloną su duomenimis
    }

    public function about()
    {
        return view('pages.about');  //gražiname puslapį su uždavinio informacija
    }

    public function contacts()
    {
        return view('pages.contacts');  //gražiname kontaktų puslapį
    }

    public function addEvent()
    {
        return view('pages.add-event');
    }

    public function showEvent(EventModel $event)
    {
        return view('pages.event', compact('event'));
    }

    public function showRegistration(EventModel $event)
    {
        return view('pages.add-registration', compact('event'));
    }

    public function showRegistrations()  //VARTOTOJŲ REGISTRACIJOMS IŠVESTI
    {
        $registrations = DB::table('registrations')
            ->join('event_models', 'event_models.id', '=', 'registrations.event_id')
            ->select( 'registrations.*','event_models.name','event_models.starts','event_models.ends')
            ->orderByDesc('registrations.created_at')
            ->get();
         return view('pages.registrations', compact('registrations'));
    }


    public function updateEvent(EventModel $event)
    {
//        if(Gate::denies('update-event',$event)){
//            dd('Tu neturi teisės atlikti šį veiksmą');
//    }
        return view('pages.update-event', compact('event'));
    }

    public function deleteEvent(EventModel $event)
    {
        $event->delete();
        return redirect('/');
    }


    public function storeUpdate(EventModel $event, Request $request)
    {
        if (request()->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = date('YmdHis') . $file->getClientOriginalName();
            $file->storeAs(('public/images/'), $fileName);
            EventModel::where('id', $event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));
            EventModel::where('id', $event->id)->update(['logo' => $fileName]);
        } else {
            EventModel::where('id', $event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));
        }
        return redirect('/renginys/' . $event->id);
    }

    public function storeRegistration(Request $request)
    {
        $validated = $request->validate([
            'userName' => 'required|max:40',
            'userEmail' => 'required|max:70',
            'userPhoneNumber' => 'required|max:25',
            'eventID'=> 'required'
        ]);

        Registration::create([
            'user_name' => request('userName'),
            'user_surname' => request('userSurname'),
            'user_email' => request('userEmail'),
            'user_phone' => request('userPhoneNumber'),
            'user_message' => request('userMessage'),
            'event_id' => request('eventID'),
            'status'=> 0
//            'user_id'=> Auth::id()
        ]);
        return redirect('/');
    }

    public function store(Request $request){
//        $input = $request->all();
//        $input['starts'] = Carbon::createFromFormat('Y-m-d\TH:i',$input['starts']);
//        $request->replace($input);

//       dump($request->all());
//       dd($request);

        $validated = $request->validate([
            'name'=>'required|unique:event_models|max:255',
            'place'=>'required|max:255',
            'organizer'=>'required|max:255',
            'logo'=>'mimes:jpeg,jpg,png,gif',
            'starts'=>'required',
            'ends'=>'required',
            'description'=>'required'
        ]);

        if(request()->hasFile('logo')) {
/*
Pakeičiau šitą bloką sekančiu su data-laikas ir originalus failo pavadinimas
Pavyko rasti klaidą failo kelyje ir su visais nepavykusiais storage:link nes saugojo failus /tmp/ direktorijoje
            $path = $request->file('logo')->store('public/images');
            $fileName = str_replace('public/images', '', $path);
*/
            $file= $request->file('logo');
            $fileName= date('YmdHis').$file->getClientOriginalName();
            $file->storeAs(('public/images/'), $fileName);
        } else {$fileName = 'pictureNA.jpg';}

        EventModel::create([
            'name'=>request('name'),
            'place'=>request('place'),
            'organizer'=>request('organizer'),
            'phone'=>request('phone'),
            'starts'=>request('starts'),
            'ends'=>request('ends'),
            'logo'=>$fileName,
            'description'=>request('description'),
            'user_id'=> Auth::id()
        ]);

        return redirect('/');
    }
}
