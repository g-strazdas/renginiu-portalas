@extends('main', [$title = 'Renginiai: apie projektą']))
@section('content')
    <div class="container py-5">
        <div class="card mb-3 border-0">
            <div class="row g-0">
                <div class="card-header fs-3 bg-warning d-flex">
                    <div class="col-12 text-center">Apie projektą:</div>
                </div>
            </div>
            <div class="row g-0 pt-4">
{{--                <div class="col-lg-4 mt-2">--}}
{{--                    <img src="{{asset(('storage/images/').$event->logo)}}" class="img-fluid rounded-start" alt="...">--}}
{{--                </div>--}}
                <div class="col-lg-12">
                    <div class="card-body m-0 p-0">
                        <div class="card-title fs-5 text-center"><b>Laravel aplikacijos<br>UŽDUOTIS<br>Renginių portalas</b><br></div>
                        <p><b>Užduoties aprašymas</b></p><hr>
                        <p>Sukurti renginių portalo aplikaciją, kurioje registruoti vartotojai gali kurti renginius, o lankytojai į juos registruotis.</p>
                        <p><b>WEB aplikaciją sudaro dvi dalys:</b></p>
                        <ul>
                            <li>Administracinė (registruotiems vartotojams)</li>
                            <li>Kliento (lankytojams)</li>
                        </ul>
                        <p><b>Administracinės dalies aprašymas ir jos privalomos funkcijos:</b></p>
                        <ul>
                            <li>Administracinė dalis turi būti sukurta naudojant PHP programavimo kalbą, taikant objektinio programavimo principus (gali būti naudojamas PHP programavimo kalbos karkasas).</li>
                            <li>Administracinės dalies projektavimas privalo remtis MVC architektūra.</li>
                            <li>Administracinės dalies funkcijos preinamos tik autentifikuotam vartotojui.</li>
                            <li>Jeigu vartotojas nėra autentifikuotas, pradiniame puslapyje rodoma renginiai ir informacija apie projektą pagal dizainą.</li>
                            <li>Vartotojų rolės, kurios realizuojamos sistemoje:
                                <ul>
                                    <li>Registruotas vartotojas</li>
                                    <li>Lankytojas</li>
                                </ul></li>
                            <li>Registruotas vartotojas gali:
                                <ul><li>Pridėti renginį (įvedant pavadinimą, datą ir laiką, aprašymą, nuotrauką), redaguoti ir pašalinti sukurtą savo renginį. Jeigu renginys jau egzistuoja jis neišsaugomas, tačiau apie tai pranešama išvedant žinutę virš registracijos formos. Taip pat peržiūrėti renginius.</li>
                                    <li>Peržiūrėti lankytojų registracijas į renginius, bei patvirtinti registraciją arba šalinti. Patvirtinimo arba šalinimo metu prašymą pateikusiam vartotojui išsiunčiama žinutė el. paštu apie atliktą veiksmą.</li>
                                </ul>
                            </li>
                            <li>Administracinės dalies vartotojo sąsajai estetiška ir funkcionali, bei suderinta su išmaniaisias įrenginiais.</li>
                            <li>Duomenys turi būti saugomi suprojektuotoje ir sukurtoje MySQL (MariaDB) duomenų bazėje, kuri atitinka 3 NF.</li>
                        </ul>
                        <p><b>Dizainas:</b></p>
                        <div><img src="{{asset(('storage/images/').'designTask.png')}}" class="img-fluid rounded-start pb-4" alt="..."></div>
                        <p><b>Lankytojo dalies aprašymas ir jos privalomos funkcijos:</b></p>
                        <ul>
                            <li>Kliento dalis turi būti realizuota naudojant HTML5, SASS, JavaScript</li>
                            <li>Lankytojas:
                                <ul>
                                    <li>Susipažinti su renginiais pradiniame puslapyje, arba pasirinkęs meniu Renginiai</li>
                                    <li>Susipažinti su informacija apie projektą meniu pasirinkęs – Apie projektą</li>
                                    <li>Susipažinti su kontaktine informacija meniu pasirinkęs - Kontaktai</li>
                                    <li>Registruotis į renginį paspaudęs registracijos mygtuką renginio aprašymo puslapyje ir užpildęs formą, kurioje nurodo savo kontaktinę informaciją (vardą, el.paštą, tel. nr.)</li>
                                    <li>Susipažinti su informacija apie projektą meniu pasirinkęs – Apie projektą</li>
                                </ul></li>
                            <li>Vartotojo sąsaja turi būti estetiška, funkcionali ir suderinta su išmaniaisiais įrenginiais</li>
                        </ul>
                        <p><b>Užduoties pateikimas:</b></p>
                        <ul>
                            <li>Užduoties kodas turi būti patalpintas www.github.com sukurtoje repositorijoje.</li>
                            <li>Aplikacija demonstravimo tikslais turi būti įdiegta www.heroku.com web aplikacijų “debesyje”.</li>
                            <li>Moksleivis užbaigęs užduotį turi vertintojui nusiųsti gihub repositorijos adresą ir veikiančios aplikacijos heroku sistemoje nuorodą. </li>
                        </ul>
                        <p><b>Ištekliai užduočiai atlikti:</b></p>
                        <ul>
                            <li>Operacinė sistema: Linux (rekomenduojama), MS Windows 10</li>
                            <li>Kodo redaktorius arba IDE (PHPStorm, VS code, Sublime text)</li>
                            <li>Lokali docker aplinka su: PHP 8 interpretatoriumi , Apache arba Nginx WEB serveriu, MySQL duomenų bazių serveriu, Git versijavimo sistema, Composer, Node JS.</li>
                        </ul>
                        <p><b>Užduoties etapai:</b></p><hr>
                        <ul>
                            <li>Administracinės dalies kūrimas:</li>
                            <li>Sukurti projekto struktūrą.</li>
                            <li>Suprojektuoti aplikacijos modelius ir ryšius tarp jų.</li>
                            <li>Sukurti duomenų bazę.</li>
                            <li>Sukurti administratoriaus vartotojo sąsają pagal užduotyje pateiktą šabloną.</li>
                            <li>Sukurti reikalingus puslapius pagal užduotyje nurodytą funkcionalumą.</li>
                            <li>Sukurti vartotojo registracijos puslapį, kuriame vartotojas registruojasi, o jo duomenys išsaugomi duomenų bazėje. Pastaba: vartotojo slaptažodis, negali būti saugomas duomenų bazėje atviru tekstu (plain text).</li>
                            <li>Sukurti vartotojo prisijungimo puslapį, kurio pagalba vartotojas autentifikuojamas administracinėje sistemoje.</li>
                            <li>Suprojektuoti ir realizuoti kliento dalies vartotojo sąsają.</li>
                            <li>Realizuoti administracinės dalies funkcionalumą.</li>
                            <li>Realizuoti kliento dalies funkcionalumą.</li>
                            <li>Įkelti užduoties kodą į sukurtą GITHUB repozitoriją.</li>
                            <li>Įdiegti aplikaciją www.heroku.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
