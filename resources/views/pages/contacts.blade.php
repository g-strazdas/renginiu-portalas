@extends('main', [$title = 'Renginiai: kontaktai']))
@section('content')
    <div class="container py-5">
        <div class="card mb-3 border-0">
            <div class="row g-0">
                <div class="card-header fs-3 bg-warning d-flex">
                    <div class="col-12 text-center">Kontaktai:</div>
                </div>
            </div>
            <div class="row g-0 pt-4">
                <div class="col-lg-5 d-flex mt-2">
                 <img src="{{asset(('storage/images/').'KITM.png')}}" class="img-fluid img-thumbnail rounded-start flex-fill" alt="Kauno Informacinių Technologijų Mokykla">
                </div>
                <div class="col-lg-7">
                    <div class="card-body m-0 p-0">
                        <div class="card-title fs-5 mt-4 mb-5 text-center"><b>KAUNO INFORMACINIŲ TECHNOLOGIJŲ MOKYKLA</b></div>
                        <ul class="list-group border-0">
                            <li class="list-group-item border-0 pb-1"><b>Adresas: </b>Laisvės al. 33, Kaunas 44311</li>
                            <li class="list-group-item border-0 pb-1"><b>Kontaktinis telefonas: </b><a href="tel:+37060063439">+370 600 63439</a></li>
                            <li class="list-group-item border-0 pb-1"><b>El. paštas: </b><a href="mailto:info@kitm.lt">info@kitm.lt</a></li>
                            <li class="list-group-item border-0 pb-1"><b>Interneto puslapis: </b><a target="_blank" href="https://kitm.lt/">https://kitm.lt/</a></li>
                            <li class="list-group-item border-0 pb-1"><b>Įkurta: </b>1945 m. lapkričio 1 d.</li>
                            <li class="list-group-item border-0 pb-0"><b>Aprašymas: </b>Šiuo metu mokykloje mokosi daugiau kaip 500 mokinių. Jie mokosi programavimo, programinės įrangos testavimo, multimedijos techniko, kompiuterių tinklų derintojo, mobiliosios elektronikos taisytojo, apskaitininko specialybių.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
