@extends('layouts.main')
@section('title', 'Postkasse')
@section('content')
<!-- <?=json_encode(session('customer'));?> -->
<?php

$pbNames = session('customer')['pb-names'];

if(is_array($pbNames)){
    $name1   = isset($pbNames[0]) ? $pbNames[0] : "";
    $name2   = isset($pbNames[1]) ? $pbNames[1] : "";
    $name3   = isset($pbNames[2]) ? $pbNames[2] : "";
    $name4   = isset($pbNames[3]) ? $pbNames[3] : "";
    $name5   = isset($pbNames[4]) ? $pbNames[4] : "";    
}else{
    $names   = explode(",", $pbNames);
    if(count($names) > 0){
        $name1   = isset($names[0]) ? $names[0] : "";
        $name2   = isset($names[1]) ? $names[1] : "";
        $name3   = isset($names[2]) ? $names[2] : "";
        $name4   = isset($names[3]) ? $names[3] : "";
        $name5   = isset($names[4]) ? $names[4] : ""; 
    }else{
        $name1   = $pbNames;
        $name2   = "";
        $name3   = "";
        $name4   = "";
        $name5   = ""; 
    }
}

?>
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
<input type="hidden" id="isPostbox" value="{{session('customer')['mailbox-sign']}}">
<input type="hidden" id="isNorges" value="{{session('customer')['isNorges']}}">
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
                <sub class="sub-3">Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div>
                <span class="steps-circle">4</span>
                <sub class="sub-4">Oppsummering</sub>
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
<div class="row px-4 mt-0 mb-4 my-lg-5 mt-lg-0">
    <div class="col-12 col-lg-9 <?=session('customer')['isNorges'] == 1 ? 'offset-md-2' : ''?>">
        <div class="bg-light p-4">
            <h4>Navn på skiltet</h4>
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <div class="form-group row">
                        <label for="rad1" class="col-4 col-md-3 col-form-label">Rad 1:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad1" value="{{$name1}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad2" class="col-4 col-md-3 col-form-label">Rad 2:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad2" value="{{$name2}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad3" class="col-4 col-md-3 col-form-label">Rad 3:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad3" value="{{$name3}}">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="rad4" class="col-4 col-md-3 col-form-label">Rad 4:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad4" value="{{$name4}}">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="rad4" class="col-4 col-md-3 col-form-label">Rad 5:</label>
                        <div class="col-8">
                            <input type="text" class="form-control pb-field" id="rad5" value="{{$name5}}">
                        </div>
                    </div>  
                </div>
                <div class="col-12 col-md-6
                ">
                    <div class="postbox-summary d-flex align-items-center justify-content-center text-center px-4"></div>

                <?php if(!isset(session('customer')['mailbox-sign']) || session('customer')['mailbox-sign'] == 0){ ?>
                    <div class="d-flex mt-4 justify-content-md-between">
                        <span class="disp-none post-warn"><b>Tusen takk. Når du svarer “JA” på SMSen sender vi deg et gratis postkasseskilt.</b><br><div class="text-red">NB! Du må fylle inn navnene på postkasseskiltet før du klikker videre på denne siden!</div></span>
                        <h6 class="mb-0 ml-4 ml-md-0 d-flex align-items-end postbox-sub sub-1 align-bottom order-2">Kr. 149 inkl. frakt</h6>
                        <button class="py-2 btn btn-block btn-info btn-xl order-1 btn-legg-till btn-postbox">Legg til</button>
                    </div>
                <?php } ?>
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
                <?php if(!isset(session('customer')['isAdv']) || session('customer')['isAdv'] == 0){ ?>
                <div class="col-12 col-md-6 align-items-end height-120 d-flex">
                    <div class="w-100 d-flex mt-4 justify-content-md-between h-50px">
                        <h6 class="mb-0 ml-4 ml-md-0 d-flex align-items-end postbox-sub align-bottom order-2">Kr. 89 inkl. frakt</h6>
                        
                        <button class="py-2 btn btn-block btn-info btn-xl order-1 btn-legg-till-2 btn-adv">Legg til</button>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

    </div>
    <?php 

    if(session('customer')['isNorges'] == 0){ ?>
    <div class="col-12 col-lg-3 text-center">
        <div class="collapse multi-collapse show">
                <h5 class="d-lg-none mt-4">Kampane! Gratis postkasseskilt ved bestilling av strøm</h5>
            <div class="ps-option p-4 mt-2 mt-md-0">
                <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                <h5 class="my-4">KAMPANJE!</h5>
                <div class="mb-4">Gratis postkasseskilt ved bestilling av strøm</div>
                <table class="text-left my-4">
                    <tr>
                        <td class="pr-2"><i class="fas fa-check"></i></td>
                        <td>Ingen påslag eller bindingstid</td>
                    </tr>
                    <tr>
                        <td class="pr-2"><i class="fas fa-check"></i></td>
                        <td>Abonnementspris på 49 kr/md</td>
                    </tr>
                    <tr>
                        <td class="pr-2"><i class="fas fa-check"></i></td>
                        <td>Spotpris om sommeren og variabelpris om vinteren</td>
                    </tr>
                    <tr>
                        <td class="pr-2"><i class="fas fa-check"></i></td>
                        <td>Fornøydhetsgaranti</td>
                    </tr>
                </table>
                <a id="btn-add-postbox" class="btn btn-violet btn-show-lott" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true">Bestill Sesongpris strøm</a>
            </div>
        </div>
        <div class="text-left bg-light p-4 collapse multi-collapse">
            <p class="mb-4">Du vil nå få tilsendt en sms som starter prosessen med bestilling av strøm</p>
            <p class="mb-4 text-red text-bold">VIKTIG: Du må bekrefte din bestilling ved å svare JA på SMSen du mottar.</p>
            <p>Vi starter utsendelse av postkasseskiltet når du har bekreftet “JA” på SMS</>
        </div>
    </div>
    <?php } ?>
</div>

<div class="row px-4 mt-2 mb-4 d-flex">
    <div class="mt-2 mt-md-0 col-12 btn-sm-6 col-md-6 order-2 order-md-1">
        <a href="/offers/" class="btn btn-previous float-left"><i class="fas fa-arrow-left"></i> Gå tilbake</a>
    </div>
    <div class="col-12 btn-sm-6 col-md-6  order-1 order-md-2">
        <button class="btn btn-next float-right btn-next-summary" is-postbox="{{session('customer')['mailbox-sign']}}">Videre <i class="fas fa-arrow-right"></i></button>
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

    <div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
      <div class="text-center modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body mt-4">
            <div class="text-center mb-4">
                <h5 class="modal-title">Hvilke adresse ønsker du at vi sender postkasseskiltet til?</h5>            
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="radios" id="radio1" value="new" checked>
              <label class="form-check-label" for="radio1">
               {{session('customer')['new_address']}}
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="radios" id="radio2" value="old">
              <label class="form-check-label" for="radio2">
               {{session('customer')['old_address']}}
              </label>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-info mb-4 pb-address" data-dismiss="modal">Lagre</button>
          </div>
        </div>
      </div>
    </div>
@endsection
