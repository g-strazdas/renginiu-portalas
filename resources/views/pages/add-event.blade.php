@extends('main', [$title = 'Renginiai: naujo renginio įvedimas']))
@section('content')
    <div class="container">
        <h3 class="mt-5">Pridėti naują renginį</h3>
        @include('_partials/errors')
        <form action="/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-2">
                <input type="text" name="name" class="form-control" placeholder="Renginio pavadinimas" value="{{old('name')}}">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="place" class="form-control" placeholder="Renginio vieta" value="{{old('place')}}">
            </div>
            <div class="form-group mb-2">
                <label class="mx-2">&nbsp;Renginio pradžia</label>
            <input type="datetime-local" name="starts" class="form-control" value="{{old('starts')}}">
            </div>
            <div class="form-group mb-2">
                <label class="mx-2">&nbsp;Renginio pabaiga</label>
                <input type="datetime-local" name="ends" class="form-control" value="{{old('ends')}}">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="organizer" class="form-control" placeholder="Organizatorius" value="{{old('organizer')}}">
            </div>
            <div class="form-group mb-2">
                <input type="text" name="phone" class="form-control" placeholder="Kontaktinis tel." value="{{old('phone')}}">
            </div>
            <div class="form-group mb-2">
                <textarea name="description"  id="" cols="30" rows="3" placeholder="Renginio aprašymas" class="form-control"></textarea>
            </div>
            <div class="form-group mb-2">
                <label>Paveikslėlis</label>
                <input type="file" name="logo" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mb-4">Saugoti</button>
        </form>
    </div>
@endsection
