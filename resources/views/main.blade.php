<!DOCTYPE html>
<html lang="lt">
{{--@include('_partials/head', [$title = 'Renginių portalas: Pagrindinis puslapis'])--}}
{{--dd({{ isset($title) ? $title : '' }})--}}

@isset($title)
{{--    dd({{ isset($title) ? $title : '' }})--}}
    @include('_partials/head', [$title])
@else
    @include('_partials/head', [$title = 'Renginiai: pagrindinis puslapis'])
@endisset

{{--@include('_partials/head', [$title])--}}
    <body class="d-flex flex-column">
        <!-- Responsive navbar-->
@include('_partials/nav')
        <!-- Header-->

@if($title === 'Renginiai: pagrindinis puslapis')
@include('_partials/header')
@endif

        <!-- Page Content-->
@yield('content')
        <!-- Footer-->
@include('_partials/footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src={{asset('js/scripts.js')}}></script>
    </body>
</html>
