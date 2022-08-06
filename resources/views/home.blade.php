{{--@isset($title)--}}
{{--    dd({{ isset($title) ? $title : '' }})--}}
{{--    @include('_partials/head', [$title])--}}
{{--@else--}}
{{--    @include('_partials/head', [$title = 'Pagrindinis Puslapis'])--}}
{{--@endisset--}}

{{--@extends('main', [$title = 'Home.blade.php']))--}}

@extends('main', [$title = 'Renginiai: pagrindinis puslapis'])
{{--    {{dump($title)}}--}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
