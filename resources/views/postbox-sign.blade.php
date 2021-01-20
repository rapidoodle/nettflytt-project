@extends('layouts.main')
@section('content')
<?php echo json_encode(session('customer'));?>
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
                            <input type="text" class="form-control pb-field" id="rad1" value="{{isset(session('customer')['person0']) ? session('customer')['person0']['name'] : ''}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad2" class="col-3 col-form-label">Rad 2:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad2" value="{{isset(session('customer')['person1']) ? session('customer')['person1']['name'] : ''}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad3" class="col-3 col-form-label">Rad 3:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad3" value="{{isset(session('customer')['person2']) ? session('customer')['person2']['name'] : ''}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad4" class="col-3 col-form-label">Rad 4:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad4" value="{{isset(session('customer')['person3']) ? session('customer')['person3']['name'] : ''}}">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="rad4" class="col-3 col-form-label">Rad 5:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad5" value="{{isset(session('customer')['person4']) ? session('customer')['person4']['name'] : ''}}">
                        </div>
                    </div>  
                </div>
                <div class="col-12 col-md-6
                ">  <div class=" d-none d-md-block">
                        <div class="postbox-summary d-flex align-items-center justify-content-center text-center px-4"></div>
                    </div>
                    <div class="d-flex mt-4 justify-content-md-between">
                        <span class="disp-none post-warn"><b>Tusen takk. Når du svarer “JA” på SMSen sender vi deg et gratis postkasseskilt.</b><br><div class="text-red">NB! Du må fylle inn navnene på postkasseskiltet før du klikker videre på denne siden!</div></span>
                        <h6 class="mb-0 ml-4 ml-md-0 d-flex align-items-end postbox-sub sub-1 align-bottom order-2 order-md-1">Kr. 149 inkl. frakt</h6>
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
                        
                        <button class="py-2 btn btn-block btn-info btn-xl order-1 order-md-2 btn-legg-till-2">Legg til</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 col-lg-3 text-center">
        <div class="collapse multi-collapse show">
                <h5 class="d-lg-none mt-4">Kampane! Gratis postkasseskilt ved bestilling av strøm</h5>
            <div class="ps-option p-4 mt-2 mt-md-0">
                <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                <h5 class="my-4">KAMPANJE!</h5>
                <div class="mb-4">GRATIS POSTKASSESKILT VED BESTILLING AV STRØM</div>
                <a class="btn btn-violet btn-show-lott" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true">Bestill Strøm til Lavpris</a>
            </div>
        </div>
        <div class="text-left bg-light p-4 collapse multi-collapse">
            <p class="mb-4">Du vil nå få tilsendt en sms som starter prosessen med bestilling av strøm</p>
            <p class="mb-4 text-red text-bold">VIKTIG: Du må bekrefte din bestilling ved å svare JA på SMSen du mottar.</p>
            <p>Vi starter utsendelse av postkasseskiltet når du har bekreftet “JA” på SMS</>
        </div>
    </div>
</div>

<div class="row px-4 mt-2 mb-4 d-flex">
    <div class="mt-2 mt-md-0 col-12 btn-sm-6 col-md-6 order-2 order-md-1">
        <a href="/offers/" class="btn btn-previous float-left"><i class="fas fa-arrow-left"></i> Gå tilbake</a>
        
    </div>
    <div class="col-12 btn-sm-6 col-md-6  order-1 order-md-2">
        <button class="btn btn-next float-right btn-next-summary">Videre <i class="fas fa-arrow-right"></i></button>
    </div>
</div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModallLabel" aria-hidden="true">
      <div class="text-center modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body mt-4">
            <div class="text-center mb-4">
                <h5 class="modal-title">Oj!</h5>            
            </div>
            <p>
                Du har ikke lagt til noen navn for postkasseskiltet ditt. Hvis du ønsker et postkasseskilt må du fylle inn minst ett navn.
            </p>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Fyll inn navn</button>
            <button type="button" class="btn btn-info mb-4 continue-summary" data-dismiss="modal">Fortsett tjenesten</button>
          </div>
        </div>
      </div>
    </div>
@endsection
