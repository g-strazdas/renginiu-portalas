<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\EventModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\lessThanOrEqual;

class EventController extends Controller
{
    public function __construct()
    {$this->middleware('auth',['except'=>['index','about','showEvent','contacts']]);}

//public function index (){return view('pages.home');}
    public function index (){
        $events = EventModel::all();    //gauname duomenis apie visas įmones iš db
        return view('pages.home', compact('events'));  //gražiname šabloną su duomenimis
    }

    public function about (){
        return view('pages.about');  //gražiname puslapį su uždavinio informacija
    }

    public function contacts (){
        return view('pages.contacts');  //gražiname kontaktų puslapį
    }

    public function addEvent(){return view('pages.add-event');}

    public function showEvent(EventModel $event){
        return view('pages.event', compact('event'));
    }

    public function updateEvent(EventModel $event){
//        if(Gate::denies('update-event',$event)){
//            dd('Tu neturi teisės atlikti šį veiksmą');
//    }
        return view('pages.update-event',compact('event'));
    }

    public function deleteEvent(EventModel $event){
        $event->delete();
        return redirect('/');
    }

    public function storeUpdate(EventModel $event, Request $request){
        if(request()->hasFile('logo')) {
            $file= $request->file('logo');
            $fileName= date('YmdHis').$file->getClientOriginalName();
            $file->storeAs(('public/images/'), $fileName);
            EventModel::where('id',$event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));
            EventModel::where('id',$event->id)->update(['logo'=>$fileName]);
        } else {EventModel::where('id',$event->id)->update($request->only(['name', 'place', 'organizer', 'phone', 'starts', 'ends', 'description']));}
        return redirect('/renginys/'.$event->id);
    }

    public function store(Request $request){

//        $input = $request->all();
//        $input['starts'] = Carbon::createFromFormat('Y-m-d\TH:i',$input['starts']);
//        $request->replace($input);

//       dump($request->all());
//       dd($request);

        $validated = $request->validate([
            'name'=>'required|max:255',
            'place'=>'required|max:255',
            'organizer'=>'required|max:255',
            'logo'=>'mimes:jpeg,jpg,png,gif',
//            'starts'=>'required',
//            'ends'=>'required'
        ]);
        if(request()->hasFile('logo')) {
/*
Pakeičiau šitą bloką sekančiu su data-laikas ir originalus failo pavadinimas
Pavyko rasti klaidą failo kelyje ir su visais nepavykusiais storage:link
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
