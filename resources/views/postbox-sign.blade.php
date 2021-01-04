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

<div class="row px-4 mb-4 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Postkasseskilt - bestill nytt i dag</h2>
        <p class="mt-3">Du kan her bestille nytt postkasseskilt til din nye bolig. Det er viktig å merke postkassen i ny bolig! 
        <br class="d-md-none"><br class="d-md-none">
        Husk å merke postkassen din med en midlertidig lapp inntil du har fått skiltet.</p>
    </div>
</div>  
<div class="row px-4 mt-0 mb-4 my-lg-5  mt-lg-0">
    <div class="col-12 col-lg-9">
        <div class="bg-light p-4">
            <h4>Navn på skiltet</h4>
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="form-group row">
                        <label for="rad1" class="col-3 col-form-label">Rad 1:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad1">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad2" class="col-3 col-form-label">Rad 2:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad2">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad3" class="col-3 col-form-label">Rad 3:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad3">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad4" class="col-3 col-form-label">Rad 4:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad4">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="rad4" class="col-3 col-form-label">Rad 5:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad5">
                        </div>
                    </div>  
                </div>
                <div class="col-12 col-md-6
                ">  <div class=" d-none d-md-block">
                        <div class="postbox-summary d-flex align-items-center justify-content-center text-center px-4"></div>
                    </div>
                    <div class="d-flex mt-4 justify-content-md-between">
                        <h6 class="mb-0 ml-4 ml-md-0 d-flex align-items-end postbox-sub align-bottom order-2 order-md-1">Kr. 149 inkl. frakt</h6>
                        <button class="py-2 btn btn-block btn-info btn-xl order-1 order-md-2 btn-legg-till">Legg til</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-light mt-4 p-4">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center">
                    <h4>“Nei takk til reklame”-skilt</h4>
                    <div class="bold-message mx-md-5">
                        UADRESSERT REKLAME NEI TAKK!
                    </div>
                </div>
                <div class="col-12 col-md-6 align-items-end height-120 d-flex">
                    <div class="w-100 d-flex mt-4 justify-content-md-between">
                        <h6 class="mb-0 ml-4 ml-md-0 d-flex align-items-end postbox-sub align-bottom order-2 order-md-1">Kr. 149 inkl. frakt</h6>
                        
                        <button class="py-2 btn btn-block btn-info btn-xl order-1 order-md-2 btn-legg-till">Legg til</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 col-lg-3 text-center">
        <h5 class="d-lg-none mt-4">Kampane! Gratis postkasseskilt ved bestilling av strøm</h5>
        <div class="ps-option p-4 mt-2 mt-md-0">
            <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
            <h5 class="my-4">KAMPANJE!</h5>
            <div class="mb-4">GRATIS POSTKASSESKILT VED BESTILLING AV STRØM</div>
            <a class="btn btn-violet" href="#">Bestill strøm fra Norges energi</a>
        </div>
    </div>
</div>

<div class="row px-4 mt-2 mb-4 d-flex">
    <div class="mt-2 mt-md-0 col-12 btn-sm-6 col-md-6 order-2 order-md-1">
        <a href="/offers/" class="btn btn-previous float-left"><i class="fas fa-arrow-left"></i> Gå tilbake</a>
        
    </div>
    <div class="col-12 btn-sm-6 col-md-6  order-1 order-md-2">
        <button id="btn-go-offer" class="btn btn-next float-right">Videre <i class="fas fa-arrow-right"></i></button>
    </div>
</div>
@endsection
