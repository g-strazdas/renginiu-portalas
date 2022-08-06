@extends('main', [$title = 'Renginiai: visi renginiai']))
@section('content')
    <div class="container py-5">
        @foreach($events as $event)
       <div class="container pb-3">
        <div class="card mb-3 border-1">
            <div class="card-header fs-3 bg-warning d-flex">

                    @if(Auth::check())
                    <div class="d-flex align-items-center gap-3 col-lg-3">
{{--                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                            <a class="btn btn-danger" href="/renginys/delete/{{$event->id}}" onclick="return confirm('Patvirtinkite renginio pašalinimą')">Šalinimas</a>--}}
{{--                            <a class="btn btn-success" href="/renginys/update/{{$event->id}}">Redagavimas</a>--}}
{{--                        </div>--}}
                        <a class="btn btn-danger" href="/renginys/delete/{{$event->id}}" onclick="return confirm('Patvirtinkite renginio pašalinimą')">Šalinimas</a>
                        <a class="btn btn-success" href="/renginys/update/{{$event->id}}">Redagavimas</a>
                    </div>
                    <div class="flex-md-column-reverse col-md-9 text-center fs-4">{{$event->name}}</div>
                    @else
                    <div class="d-flex align-items-center col-lg-1">
                        <a href="/renginys/add-registration/{{$event->id}}" class="btn btn-primary">Registruotis...</a>
                    </div>
                    <div class="flex-md-column-reverse col-md-11 text-center fs-4">{{$event->name}}</div>
                    @endif

            </div>
        </div>
            <div class="row g-0">
                <div class="col-lg-4 mt-0 d-flex">
                    <img src="{{asset(('storage/images/').$event->logo)}}" class="img-fluid img-thumbnail rounded-start flex-fill" alt="...">
                </div>
                <div class="col-lg-8">
                    <div class="card-body m-0 p-0">
                        {{--                        <div class="card-title fs-5 ms-3 mt-1"><b>Kita informacija apie renginį:</b></div>--}}
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 pb-0"><b>Adresas: </b>{{$event->place}}</li>
                            <li class="list-group-item border-0 pb-0"><b>Renginio pradžia: </b>{{str_replace('T', ' ', $event->starts)}}</li>
                            <li class="list-group-item border-0 pb-0"><b>Renginio pabaiga: </b>{{str_replace('T', ' ', $event->ends)}}</li>
                            <li class="list-group-item border-0 pb-0"><b>Organizatorius: </b>{{$event->organizer}}</li>
                            <li class="list-group-item border-0 pb-0"><b>Kontaktinis telefonas: </b>{{$event->phone}}</li>
                            <li class="list-group-item border-0 pb-0"><b>Aprašymas: </b>{{$event->description}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endforeach
</div><br><br><br>
@endsection
