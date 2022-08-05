@extends('main', [$title = 'Renginiai: registrations']))
@section('content')
{{dd($registrations->all())}}
    <section>
        <div class="container pb-5 mb-5">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                <!-- Page Features-->
                @foreach($registrations as $registration)
                    <div class="card border-0">
                        <h5 class = "card-header text-center bg-warning">{{$registration->name}}</h5>
                        {{--                        <img src="{{asset(('storage/images/').$event->logo)}}" class="img-fluid rounded-start" alt="...">--}}
                        <h5 class="card-title"></h5>
                        <div class="card-body pt-1 px-1">
                            <p class="card-text">{{$registration->message}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
    </section>
@endsection
