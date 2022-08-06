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
    {$this->middleware('auth', ['except' => ['index', 'about', 'showEvent', 'contacts', 'showRegistration','storeRegistration','allEvents']]);}

    public function index() //TRUMPAS APRAŠYMAS BOOTSTRAP CARD'UOSE SU MYGTUKU "PLATESNĖ INFORMACIJA IR REGISTRACIJA..."
    {
        $events = EventModel::all();    //Gauname visus duomenis iš duomenų bazės event_models
        return view('pages.home', compact('events'));  //Gražiname į pages.home su duomenimis apie remginius smulkioms kortelėms pagrindiniame puslapyje
    }

    public function about() //PUSLAPIS "APIE PROJEKTĄ" SU UŽDAVINIO INFORMACIJA
    {
        return view('pages.about');
    }

    public function contacts() //KONTAKTŲ PUSLAPIS
    {
        return view('pages.contacts');
    }

    public function allEvents() //VISŲ RENGINIŲ PUSLAPIS
    {
        $events = EventModel::all();
        return view('pages.all-events', compact('events'));
    }

    public function addEvent() //RENGINIO PRIDĖJIMO FORMA
    {
        return view('pages.add-event');
    }

    public function showEvent(EventModel $event) //PLATESNĖ RENGINIO INFORMACIJA, JEI AUTH - RODOMI MYGTUKAI "ŠALINTI","DUOMENŲ ATNAUJINIMAS" O JEI NE AUTH - "REGISTRUOTIS"
    {
        return view('pages.event', compact('event'));
    }

    public function showRegistration(EventModel $event) //DUOMENYS VARTOTOJUI REGISTRUOTIS Į RENGINĮ PATEIKIAMI Į FORMĄ SU RENGINIO INFORMACIJA - PAVADINIMUI IR FOTO FORMOJE
    {
        return view('pages.add-registration', compact('event'));
    }

    public function showRegistrations()  //VARTOTOJŲ REGISTRACIJOMS REDAGUOTI IŠVEDIMO DUOMENYS
    {
        $registrations = DB::table('registrations')
            ->join('event_models', 'event_models.id', '=', 'registrations.event_id')
            ->select( 'registrations.*','event_models.name','event_models.starts','event_models.ends')
            ->orderByDesc('registrations.created_at')
            ->get();
         return view('pages.registrations', compact('registrations'));
    }


    public function updateEvent(EventModel $event)  //AUTH RENGINIO REDAGAVIMAS
    {
//        if(Gate::denies('update-event',$event)){
//            dd('Tu neturi teisės atlikti šį veiksmą');
//    }
        return view('pages.update-event', compact('event'));
    }

    public function deleteEvent(EventModel $event) //AUTH RENGINIO ŠALINIMAS
    {
        $event->delete();
        return redirect('/');
    }

    public function approveRegistration($id)
    {
        DB::table('registrations')
            ->where('id', $id)->update(['status' => 1, 'updated_at'=>now()]);
        return back();
    }

    public function revertRegistration($id)
    {
        DB::table('registrations')
            ->where('id', $id)->update(['status' => 0, 'updated_at'=>now()]);
        return back();
    }

    public function deleteRegistration($id)
    {
        DB::table('registrations')
            ->where('id', $id)->delete();
        return back();
    }

    public function storeUpdate(EventModel $event, Request $request)  //AUTH RENGINIO IŠSAUGOJIMUI PO REDAGAVIMO - TIMESTAMP EventModel NUIMTAS KAIP NEREIKALINGAS ŠIOJE UŽDUOTYJE
    {
        if (request()->hasFile('logo')) {   //PAGAL NUTYLĖJIMĄ BUVO PROBLEMA, KAD FAILAS SAUGOJOSI Į /tmp/ DIREKTORIJĄ O NE Į STORAGE/APP/PUBLIC/IMAGES
            $file = $request->file('logo'); //ARTISAN STORAGE:LINK NEPADĖJO | RECREATE - NEPADĖJO, TODĖL SUGALVOTAS REALIAI GERESNIS SPRENDIMAS
            $fileName = date('YmdHis') . $file->getClientOriginalName();    //AIŠKESNIS FAILO VARDAS+NURODYTAS KELIAS+DUOMENŲ BAZĖJE - TIK FAILO PAVADINIMAS
            $file->storeAs(('public/images/'), $fileName);  //DVI KOMANDOS, NES NEŽINOJAU, KAIP PAKEISTI VIENA IN-PLACE - NEIŠLAIKYTAS DRY PRINCIPAS (DON'T REPEAT YOURSELF). SORRY.
            EventModel::where('id', $event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));
            EventModel::where('id', $event->id)->update(['logo' => $fileName]);
        } else {
            EventModel::where('id', $event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));
        }
        return redirect('/renginys/' . $event->id);
    }

    public function storeRegistration(Request $request)  //IŠSAUGOME VARTOTOJO ĮVESTUS DUOMENIS REGISTRACIJOS FORMOJE Į RENGINĮ
    {
        $validated = $request->validate([
            'userName' => 'required|max:40',
            'userEmail' => 'required|max:70',
            'userPhoneNumber' => 'required|max:25',
            'eventID'=> 'required'
        ]);

        Registration::create([
            'user_name' => request('userName'),         // VARDAS
            'user_surname' => request('userSurname'),   // PAVARDĖ
            'user_email' => request('userEmail'),       // E.PAŠTAS
            'user_phone' => request('userPhoneNumber'), // TEL. NUMERIS
            'user_message' => request('userMessage'),   // PRANEŠIMAS
            'event_id' => request('eventID'),           // RENGINIO ID
            'status'=> 0                                    // REGISTRACIJOS STATUSAS
//            'user_id'=> Auth::id()
        ]);
        return redirect('/');
    }



    public function store(Request $request){    // AUTH IŠSAUGOMA NAUJO RENGINIO INFORMACIJA

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
