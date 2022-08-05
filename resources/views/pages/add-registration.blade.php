@extends('main', [$title = 'Renginiai: pages/add-registration.blade.php']))
@section('content')
    <div class="container pt-5">
        <div class="card mb-3 border-1">
            <div class="row g-0">
                <div class="card-header fs-3 bg-warning text-center col-lg-12"><b>Registracija į renginį:</b> {{$event->name}}</div>
            <div class="row g-0">
                <div class="col-lg-4 mt-0 d-flex">
                    <img src="{{asset(('storage/images/').$event->logo)}}" class="img-fluid img-thumbnail rounded-start w-lg-75 w-md-50 w-100 text-center" alt="...">
                </div>
                <div class="col-lg-8">
                    <div class="card-body d-flex flex-column mb-0 pb-0">
                        <form action="/storeRegistration" method="post" class="mb-0">
                            @csrf
                            <input type="hidden" id="eventID" name="eventID" value="{{$event->id}}">
                            <div class="form-group mb-2">
                                <input type="text" name="userName" class="form-control" placeholder="Vardas" required>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="userSurname" class="form-control" placeholder="Pavardė" required>
                            </div>
                            <div class="form-group mb-2">
                                <input type="email" name="userEmail" class="form-control" placeholder="Elektroninio pašto adresas" required>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="userPhoneNumber" class="form-control" placeholder="Telefono numeris" required>
                            </div>
                            <div class="form-group mb-2">
                                <textarea name="userMessage"  id="" cols="30" rows="3" placeholder="Pastabos" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Registruotis</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
