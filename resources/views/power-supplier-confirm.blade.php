@extends('layouts.main')
@section('content')
<div class="mb-5 container steps-container">
    <div class="nav-steps d-flex justify-content-center">
            <div class="text-center">
                <span class="steps-circle">1</span>
                <sub>Start</sub>
            </div>
            <div><hr></div>
            <div>
                <span class="steps-circle">2</span>
                <sub>Mottakere</sub>
            </div>
            <div><hr></div>
            <div class="active">
                <span class="steps-circle">3</span>
                <sub>Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div>
                <span class="steps-circle">4</span>
                <sub>Oppsummering</sub>
            </div>
    </div>
</div>

<div class="row px-4 mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Strøm i ny bolig</h2>
        <p class="mt-3">Dersom du ikke bestiller strøm fra en strømleverandør på ditt nye bosted vil du få leveringspliktig strøm fra din nettleverandør. Dette kan bli dyrt. Vi anbefaler deg derfor at du bestiller strøm på ditt nye bosted hvis ikke dette allerede er gjort eller er inkludert i eventuell husleie.</p>
    </div>
</div>  
<div class="row px-4 mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-10 offset-md-1 text-center text-md-left">
        <h4 class="mb-5">Du vil nå få tilsendt en sms som starter prosessen med bestilling av strøm</h5>
        <h4 class=" mb-5 text-red">VIKTIG: Du må bekrefte din bestilling ved å svare JA på SMSen du mottar.</h5>
        <h4 class="mb-5 text-underline">Du kan nå fortsette tjenesten</h5>
    </div>
    <div class="col-12 col-md-10 offset-md-1 text-center">
        <a href="/offers/" class="btn btn-info py-3 px-5">Fortsett flyttemeldingen <i class="fas fa-arrow-right" title="Offers page"></i></a>
    </div>
</div>  


@endsection
