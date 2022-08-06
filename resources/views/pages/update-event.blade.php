@extends('main', [$title = 'Renginiai: atnaujinti renginio informaciją']))
@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Atnaujinti renginio informaciją</h2>
        @include('_partials/errors')
        <form action="/update/{{$event->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
                <input type="text" name="name" value="{{$event->name}}" class="form-control" placeholder="Renginio pavadinimas">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="place" value="{{$event->place}}" class="form-control" placeholder="Renginio vieta">
            </div>
            <div class="form-group mb-2">
                <label class="mx-2">&nbsp;Renginio pradžia</label>
                <input type="datetime-local" name="starts" class="form-control"  value="{{str_replace('T', ' ', $event->starts)}}">
            </div>
            <div class="form-group mb-2">
                <label class="mx-2">&nbsp;Renginio pabaiga</label>
                <input type="datetime-local" name="ends" class="form-control"  value="{{str_replace('T', ' ', $event->ends)}}">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="organizer" value="{{$event->organizer}}" class="form-control" placeholder="Organizatorius">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="phone" value="{{$event->phone}}" class="form-control" placeholder="Kontaktinis tel.">
            </div>
            <div class="form-group mb-2">
                <textarea name="description"  id="" cols="30" rows="6" placeholder="Renginio aprašymas" class="form-control">{{$event->description}}</textarea>
            </div>
            <div class="form-group mb-2">
                <label>Paveikslėlis</label>
                <input type="file" name="logo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mb-4">Saugoti</button>
        </form>
    </div>
@endsection
