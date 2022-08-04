@extends('main', [$title = 'Renginiai: main']))
@section('content')
        <section>
        <div class="container pb-5 mb-5">
                <div class="row row-cols-1 row-cols-md-3 g-5">
                <!-- Page Features-->
                        @foreach($events as $event)
                                <div class="card border-0">
                                    <h5 class = "card-header text-center bg-warning">{{$event->name}}</h5>
                                    {{--                        <img src="{{asset(('storage/images/').$event->logo)}}" class="img-fluid rounded-start" alt="...">--}}
                                    <h5 class="card-title"></h5>
                                    <div class="card-body pt-1 px-1">
                                        <p class="card-text">{{$event->description}}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="/renginys/{{$event->id}}" class="btn btn-sm bg-primary text-white text-decoration-none">Platesnė informacija ir registracija...</a>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
                <br>
        </section>
@endsection
