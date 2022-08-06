@extends('main', [$title = 'Renginiai: vartotojų registracijos']))
@section('content')
    <section>
        <div class="container-fluid bg-info py-3 px-0 vh-100">
        <table class="table table-hover table-bordered table-sm table-striped w-100  pm-5" style="margin-left: 0px; margin-right: auto; border: solid 2px; background-color: #EDEDED; font-size: 12px;">
        <thead class="table-primary text-center align-middle mt-5" style="border: solid 2px #000000">
            <tr>
                <th>ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>El.paštas</th>
                <th>Tel.Nr.</th>
                <th>Žinutė</th>
                <th>Sukurtas</th>
                <th>Atnaujintas</th>
                <th>Renginio pavadinimas</th>
                <th>Pradžia</th>
                <th>Pabaiga</th>
{{--                <th>Reg.</th>--}}
                <th>Veiksmai</th>
            </tr>
        </thead>
        <tbody  class="table-group-divider text-center table-light"  style="border: solid 1px; font-size: small; vertical-align: middle">';
        @foreach($registrations as $registration)
            <tr class="bg-white">
                <td class = "bg-white p-0">{{$registration->id}}</td>
                <td class = "bg-white">{{$registration->user_name}}</td>
                <td class = "bg-white">{{$registration->user_surname}}</td>
                <td class = "bg-white"><a href="mailto:{{$registration->user_email}}">{{$registration->user_email}}</a></td>
                <td class = "bg-white">{{$registration->user_phone}}</td>
                <td class = "bg-white text-start">{{$registration->user_message}}</td>
                <td class = "bg-white">{{substr($registration->created_at, 0, -3)}}</td>
                <td class = "bg-white">@if ($registration->created_at != $registration->updated_at) {{substr($registration->updated_at, 0, -3)}}@endif</td>
                <td class = "bg-white">{{$registration->name}}</td>
                <td class = "bg-white">{{str_replace('T',' ',$registration->starts)}}</td>
                <td class = "bg-white">{{str_replace('T',' ',$registration->ends)}}</td>
{{--                <td class = "bg-white">{{$registration->status}}</td>--}}
                <td class = "bg-white">
                    <div>
                        @if ($registration->status == "0")
                            <form action="/approveRegistration/{{$registration->id}}" method="post" class="m-0 p-0">
                                @csrf
                                <input type="hidden" id="userRegister" name="userRegister" value="{{$registration->id}}">
                                <button type="submit" class="btn btn-sm btn-success m-0 p-0">Registruoti</button>
                            </form>
                        @elseif ($registration->status == "1")
                            <form action="/revertRegistration/{{$registration->id}}" method="post" class="m-0 p-0">
                                @csrf
                                <input type="hidden" id="userUnregister" name="userUnregister" value="{{$registration->id}}">
                                <button type="submit" class="btn btn-sm btn-warning m-0 p-0">Išregistruoti</button>
                            </form>
                        @endif
                        <form action="/deleteRegistration/{{$registration->id}}" method="post" class="m-0 p-0">
                            @csrf
                            <input type="hidden" id="userRemove" name="userRemove" value="{{$registration->id}}">
                            <button type="submit" class="btn btn-sm btn-danger m-0 p-0">Pašalinti</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
        <br>
        </div>
    </section>
@endsection
