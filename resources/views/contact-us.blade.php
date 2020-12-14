@extends('layouts.main')
@section('content')
<div class="row px-4 mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2 class="d-inline-block">Kundeservice</h2>
    </div>
</div>
<div class="row px-4 mt-0 mb-5 my-lg-5 mt-lg-0 text-left">
    <div class="bg-light p-4 pt-5">
        <h2>Viktig informasjon</h2>
        <div class="row">
            <div class="col-12 col-md-9">
                <p>Vi opplever økende antall forespørsler fra brukere av andre tjenester for adresseendring som ikke har noe med Nettflytt å gjøre.
                </p>
                <p> Vi ber om at du sjekker hvilken nettside du faktisk har brukt først dersom din henvendelse gjelder manglende tilbakemelding e.l etter å ha meldt adresseendring. Vi kan ikke hjelpe deg med evt flyttemeldinger som er sendt via andre nett-tjenester enn Nettflytt sine.</p>
            </div>
            <div class="col-12 col-md-3">
                <img class="img-fluid" src="{{ asset('images/call-center-working-night.png')}}" alt="call center working night" width="300px">
            </div>
        </div>

        <div class="row mt-4 align-items-center">
            <div class="col-1">
                <p class="bold-red bold text-red">MERK!</p>
            </div>
            <div class="col-12 col-md-11">
                <p>Nettflytt er ikke en del av Posten Norge eller folkeregisteret.<br> Har du spørsmål vedrørende adressen som er registrert hos dem ber vi deg kontakt direkte med dem.</p>
            </div>
        </div>
    </div>
</div>
<center class="my-5"><h5>For alle andre henvendelser: Kontakt <span class="text-red">kundesenter@nettflytt.no</span></h5></center>
<center class="mb-5">
    <button class="btn btn-extra-lg">Tilbake til forsiden</button>
</center>
@endsection
