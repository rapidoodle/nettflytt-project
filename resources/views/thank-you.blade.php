@extends('layouts.main')
@section('title', 'Takk')
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
            <div>
                <span class="steps-circle">3</span>
                <sub class="sub-3">Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div class="active">
                <span class="steps-circle">4</span>
                <sub class="sub-4">Oppsummering</sub>
            </div>
    </div>
</div>
<div class="row px-4 mt-0 mb-5 my-lg-5  mt-lg-0">
    <div class="col-12 col-md-6 offset-md-3">
        <div class="p-4 text-center">
            <h1>Tusen takk {{session('customer')['first_name']}}</h1>
                <p class="my-4">Vi sender deg en bekreftelse på SMS! Hvis det er noe vi kan hjelpe deg med i tiden som kommer er du hjertelig velkommen til å kontakte vårt dyktige supportteam.</p>
                <a href="/" class="btn btn-info btn-lg" id="btn-ty-send">Tilbake til forsiden</a>
        </div>
    </div>
</div>
<hr>
            <center class="my-5"><h3 class="text-blue">Det er fortsatt ikke for sent…</h3></center>
<div class="row px-4 mb-5">
    <?php if(!isset(session('customer')['mailbox-sign'])){ ?>
    <div class="col-12 col-md-4">
        <div class="card ty-card text-center mb-5 mb-md-0">
            <div class="card-header">
                <h3 class="mb-0">Strøm</h3>
            </div>
            <div class="card-body">
                <p class="my-4">Ønsker du et uforpliktende tilbud på strøm til din nye bolig?</p>
                <div class="text-center">
                    <button class="btn btn-info mb-4 btn-ty-ja btn-offer" data-offer="isStrom">Ja takk!</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="col-12 col-md-4 <?=isset(session('customer')['mailbox-sign']) && session('customer')['mailbox-sign'] == 1 ? 'offset-md-2' : ''?>">
        <div class="card ty-card text-center mb-5 mb-md-0">
            <div class="card-header">
                <h3 class="mb-0">Boligalarm</h3>
            </div>
            <div class="card-body">
                <p class="my-4">Ønsker du et uforpliktende tilbud på alarm til din nye bolig?</p>
                <div class="text-center">
                    <button class="btn btn-info mb-4 btn-ty-ja btn-offer" data-offer="isBoligalarm">Ja takk!</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card ty-card text-center">
            <div class="card-header">
                <h3 class="mb-0">TV/Internett</h3>
            </div>
            <div class="card-body">
                <p class="my-4">Ønsker du et tilbud på forsikring til din nye bolig?</p>

                <div class="text-center"> 
                <button class="btn btn-info mb-4 btn-ty-ja btn-offer" data-offer="isTV">Ja takk!</button>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- Event snippet for Gjennomført kjøp conversion page -->
<script>
gtag('event', 'conversion', {
'send_to': 'AW-654782287/o8CcCLaL5MsBEM_enLgC',
'transaction_id': ''
});
</script>
<!-- RESTART ALL SESSION -->
<!-- <?php session()->flush(); ?>  -->
@endsection
