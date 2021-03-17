@extends('layouts.main')
@section('content')
<script type="text/javascript" async src="https://cdn.reamaze.com/assets/reamaze.js"></script>
<script type="text/javascript">
  var _support = _support || { 'ui': {}, 'user': {} };
  _support['account'] = 'flytteregisteret';
  _support['contact_custom_fields'] = _support['contact_custom_fields'] || {};
  _support['contact_custom_fields']['rmz_form_id_23129'] = {};
</script>
<div class="row px-4 mb-5 mt-5 mt-md-0" id="contact-page">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2 class="d-inline-block">Velkommen til vårt kundesenter</h2>
        <p>Ved å besvare spørsmålene under får du kontaktinformasjon til den riktige instans.</p>
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="text-center mb-0">Kundeservice</h3>
            </div>
            <div class="card-body p-md-5 m-md-0" id="contact-1">
                <h5 class="mb-0">Gjelder din henvendelse spørsmål rettet til det norske folkeregisteret?</h5>
                <p>Are you trying to contact the Norwegian national population register (Folkeregisteret)?</p>
                <div class="row mt-4 ">
                    <div class="col-12 col-md-6 text-md-right">
                        <button data-next="contact-3" data-from="contact-1" class="btn btn-contact w-100 btn-info px-5 py-2">Nei</button>
                    </div>
                    <div class="col-12 col-md-6 text-md-left p-2 p-md-0">
                        <button data-next="contact-2" data-from="contact-1" class="btn btn-contact w-100 btn-info px-5 py-2">Ja</button>
                    </div>
                </div>
            </div>

            <div class="card-body p-md-5 m-md-0 text-left d-hiddens" id="contact-2">
                <h5>Kontaktinformasjon Folkeregisteret:</h5><br>
                <i class="fa fa-phone"></i> Telefon: +47 800 80 000<br>
                <span>Åpningstider på telefon: 09:00 - 15:30 alle hverdager</span><br><br>

                <i class="far fa-comment-alt"></i> For chat besøk: <a href="https://www.skatteetaten.no/kontakt/chat-med-oss/"> https://www.skatteetaten.no/kontakt/chat-med-oss/</a><br><br>
                
                <i class="fa fa-desktop"></i> For alle andre henvendelser gjeldende folkeregisteret besøk:<br> <span><a href="https://www.skatteetaten.no/kontakt/">https://www.skatteetaten.no/kontakt/</a></span>
            </div>

            <div class="card-body p-md-5 m-md-0 d-hiddens" id="contact-3">
                <h5 class="mb-0">Vi opplever for tiden mange som kontakter for adresseendring som ikke har noe med Flytteregisteret å gjøre.</h5>
                <p>Er du helt sikker på at du har meldt adresseendring hos Flytteregisteret? (Vi ber om at du ser om Flytteregisteret er avsender av SMS og bekreftelses e-post)</p>
                <div class="row mt-4 ">
                    <div class="col-12 col-md-6 text-md-right">
                        <button data-next="contact-4" data-from="contact-3" class="btn btn-contact w-100 btn-info px-5 py-2">Nei</button>
                    </div>
                    <div class="col-12 col-md-6 text-md-left p-2 p-md-0">
                        <button data-next="contact-5" data-from="contact-3" class="btn btn-contact w-100 btn-info px-5 py-2">Ja</button>
                    </div>
                </div>
            </div>

            <div class="card-body p-md-5 m-md-0 d-hiddens" id="contact-4">
                <h5 class="mb-0">Vi kan dessverre ikke hjelpe deg med flyttemeldinger som er sendt via andre portaler enn Flytteregisteret.no</h5>
                <p>Vi anbefaler at du tar kontakt med selskapet som har håndtert din flyttemelding direkte.</p>
            </div>

            <div class="card-body p-md-5 m-md-0 text-center d-hiddens" id="contact-5">
                <h5 class="mb-0">Send oss gjerne en e-post så svarer vi deg fortløpende</h5>
                <div class="py-4">
                    <div data-reamaze-embed="contact" data-reamaze-embed-form-id="23129"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row px-4 mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2 class="d-inline-block">Kundeservice</h2>
    </div>
</div>
<div class="row px-4 mt-0 mb-5 my-lg-5 mt-lg-0 text-left">
    <div class="bg-light p-4 pt-5">
        <h2>Viktig informasjon</h2>
        <div class="row">
            <div class="col-12 col-md-9">
                <p>Vi opplever økende antall forespørsler fra brukere av andre tjenester for adresseendring som ikke har noe med Flytteregisteret å gjøre.
                </p>
                <p> Vi ber om at du sjekker hvilken nettside du faktisk har brukt først dersom din henvendelse gjelder manglende tilbakemelding e.l etter å ha meldt adresseendring. Vi kan ikke hjelpe deg med evt flyttemeldinger som er sendt via andre nett-tjenester enn Flytteregisteret sine.</p>
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
                <p>Flytteregisteret er ikke en del av Posten Norge eller folkeregisteret.<br> Har du spørsmål vedrørende adressen som er registrert hos dem ber vi deg kontakt direkte med dem.</p>
            </div>
        </div>
    </div>
</div>
<center class="my-5"><h5>For alle andre henvendelser: Kontakt <span class="text-red">kundesenter@nettflytt.no</span></h5></center>
<center class="mb-5">
    <button class="btn btn-extra-lg">Tilbake til forsiden</button>
</center> -->
@endsection
