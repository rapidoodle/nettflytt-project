@extends('layouts.main')
@section('title', 'Mottakere')
@section('content')
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
<div class="mb-5 container steps-container">
    <div class="nav-steps d-flex justify-content-center">
            <div class="text-center">
                <span class="steps-circle">1</span>
                <sub>Start</sub>
            </div>
            <div><hr></div>
            <div class="active">
                <span class="steps-circle">2</span>
                <sub>Mottakere</sub>
            </div>
            <div><hr></div>
            <div>
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
<section id="receiver-section" class="collapse multi-collapse show">
    <div class="row px-4 mb-4 mb-md-5 mt-5 mt-md-0 title-receiver">
        <div class="col-12 col-md-8 offset-md-2 text-center">
            <h2>Velg mottakere av din flyttemelding</h2>
            <p class="mt-3">Under er det kategorier som hjelper deg å finne dine leverandører. Du kan også bruke søkefeltet til å finne dine bedrifter.</p>
        </div>
    </div>  

    <div class="row px-4 mb-4 mb-md-5 mt-5 mt-md-0 ps-cont">
        <div class="col-12 col-md-8 offset-md-2 text-center">
            <h2>Strøm i ny bolig</h2>
            <p class="mt-3">Dersom du ikke bestiller strøm fra en strømleverandør på ditt nye bosted vil du få leveringspliktig strøm fra din nettleverandør. Dette kan bli dyrt. Vi anbefaler deg derfor at du bestiller strøm på ditt nye bosted hvis ikke dette allerede er gjort eller er inkludert i eventuell husleie.</p>
        </div>
    </div>  

    <div class="ps-cont text-center mt-5 mt-md-0" id="power-supply">
        <h5 class="mini-header">
        Velg ny strømavtale for <?=session('customer')['new_address']?></h5>
        <div class="row px-4 mb-5">
            <div class="col-12 offset-md-1 col-md-5 text-center p-4">
                <div class="ps-option p-4 mx-0 mx-lg-5">
                    <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                    <h5 class="my-4">STRØM TIL LAVPRIS</h5>

                    <p>Med Strøm til lavpris får du en spotprisavtale, som ifølge Statistisk sentralbyrå har vært den billigste avtaleformen i over 10 år. Det betyr at du kan slappe av og fokusere på det som gir deg god energi!</p>

                    <a class="btn btn-violet px-4 py-2 btn-go-power" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true" data-type="1">
                    Bestill “Strøm til Lavpris”
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-5 text-center p-4">
                <div class="ps-option p-4 mx-0 mx-lg-5">
                    <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                    <h5 class="my-4">TOPP 5 GARANTI</h5>

                    <p>Strømavtalen Topp 5-garanti sikrer deg en variabel strømpris som på årlig basis alltid er blant de 10 beste, målt mot en representativ liste over konkurrentene våre.</p>

                    <a class="btn btn-violet px-4 py-2 btn-go-power" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="true" data-type="2">Bestill “Topp 5 Garanti</a>
                </div>
            </div>
        </div>  
    </div>
<!--     <h3 class="mini-header d-md-none mb-4 label-none">
        Velg ny strømavtale for <?=session('customer')['new_address'];?>        
    </h3> -->
    <div class="row px-4 mt-0 mb-5 my-lg-5  mt-lg-0 form" id="receiver-main-section">
        <div class="col-12 col-lg-8">
            <div class="cat-n-search">
                <div class="d-flex flex-wrap category-container align-content-center justify-content-center mb-4">
                    <div class="category-item active-option" data-cat="Ofte brukte">
                        <i class="far fa-star"></i>
                        Ofte brukte
                    </div>
                    <div class="category-item" data-cat="TV/Internett">
                        <i class="fas fa-tv"></i>
                        TV/Internett
                    </div>
                    <div class="category-item" data-cat="Aviser">
                        <i class="fa fa-newspaper-o"></i>
                        Aviser
                    </div>
                    <div class="category-item" data-cat="Boligalarm">
                        <i class="fas fa-lock"></i>
                        Boligalarm
                    </div>
                    <div class="category-item" data-cat="Medlemskap">
                        <i class="fas fa-paperclip"></i>
                        Medlemskap
                    </div>
                    <div class="category-item" data-cat="Utdanning">
                        <i class="fas fa-graduation-cap"></i>
                        Utdanning
                    </div>
                    <div class="category-item" data-cat="Boligbyggelag">
                        <i class="fas fa-handshake"></i>
                        Boligbyggelag
                    </div>
                    <div class="category-item" data-cat="Telefon">
                        <i class="fas fa-phone"></i>
                        Telefon
                    </div>
                    <div class="category-item" data-cat="Forsikring">
                        <i class="fas fa-home"></i>
                        Forsikring
                    </div>
                    <div class="category-item" data-cat="strÃ¸m">
                        <i class="fas fa-power-off"></i>
                        Strøm
                    </div>
                    <div class="category-item" data-cat="Magasiner">
                        <i class="fa fa-file-image-o"></i>
                        Magasiner
                    </div>
                    <div class="category-item" data-cat="Bank" id="category-bank" data-toggle="modal" data-target="#bankModal" data-toggle="modal" data-target="#bankModal">
                        <i class="fas fa-university"></i>
                        Bank
                    </div>
                </div>
                <div class="mb-4">
                    <div class="input-group mb-3 receiver-search-group">
                        <input type="text" class="form-control" placeholder="Søk etter selskap eller organisasjon" aria-label="Søk etter selskap eller organisasjon" aria-describedby="basic-addon2" id="receiver-search-input">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="button" id="company-search">Søk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 result-cont">
                <p class="ps-cont text-left">
                    <b class="text-bold">Eller, </b> viderefør din eksisterende avtale
                </p>
                <div class="bg-light w-100 p-4 search-no-result">
                    <h5>Det er dessverre ingen Norske selskaper som passer med søket ditt</h5>
<!--                <p> <b>Fant du ikke det du lette etter?</b></p>
                    <button class="btn btn-other-search">Søk videre i brønnøysundregstrene</button> -->
                </div>
                <table class="table table-striped receiver-search-result">

                </table>
                <center>
                    <nav aria-label="Page navigation example" class="text-center">
                        <ul class="mt-2 justify-content-center justify-content-md-start pagination"></ul>
                        </nav>
                </center>
            </div>
        </div>
        <div class="col-12 col-lg-3 offset-lg-1" id="summary">

            <div class="bg-info index-summary p-4 mt-4 mt-lg-0">
            <div class="d-none d-md-block ">
                <p class="heading">Oppsummering</p>
                <p class="sub-heading">Gammel adresse</p>
                    <div class="input-group mt-2 group-form">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="gamel-address-1-icon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                        </div>
                        <input type="text" id="gamel-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly value="{{session('customer')['old_address']}}">
                    </div>
                <div class="input-group mt-2 group-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="gamel-address-2-icon">
                            <i class="fa fa-map-o"></i>
                        </span>
                    </div>
                    <input type="text" id="gamel-address-2" class="form-control" placeholder="1234 Oslo" readonly value="{{session('customer')['old_post'] ?? ''}}">
                </div>
                <p class="sub-heading mt-4">Ny adressee</p>
                <div class="input-group mt-2 group-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="ny-address-1-icon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                    </div>
                    <input type="text" id="ny-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly value="{{session('customer')['new_address'] ?? ''}}">
                </div>
                <div class="input-group mt-2 group-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="ny-address-2-icon">
                            <i class="fa fa-map-o"></i>
                        </span>
                    </div>
                    <input type="text" id="ny-address-2" class="form-control" placeholder="1234 Oslo" readonly value="{{session('customer')['new_post'] ?? ''}}">
                </div>  
            </div>

                <p class="sub-heading mt-md-3">Mottakere</p>
                <div class="summary-choices px-2 py-3">
                    <table width="100%" class="selected-list">
                        <?php 
                        if(count(session('customer')['services']) == 0){?>
                        <tr class="default-selected">
                            <td align="center">Vennligst velg et selskap</td>
                        </tr>
                        <?php } else{
                            foreach (session('customer')['services'] as $key => $value) {
                            $newId = time(); 
                            $isps  = isset($value[3]) ? 'data-isps=true' : "";
                            if($value){?>
                        <tr id="comp_{{$key}}{{$newId}}">
                            <td width="10%"><i class="fas fa-check"></i></td>
                            <td class="cl">{{$value[0]}}</td>
                            <td>
                                <i class="fas fa-times pointer company-list" data-parent="comp_{{$key}}{{$newId}}" data-value="{{$value[0]}}" data-company-number="{{$value[1]}}" data-company-people="{{$value[2]}}" data-toggle="modal" data-target="#deleteModal" data-toggle="modal" data-target="#deleteModal" {{$isps}}></i>
                            </td>
                        </tr>
                        <?php } } }?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-4 mt-2 mb-4">
        <div class="mt-2 mt-md-0 col-12 btn-sm-6 col-md-6 order-2 order-md-1">
            <a href="/" class="btn btn-previous float-left"><i class="fas fa-arrow-left"></i> Gå tilbake</a>
            
        </div>
        <div class="col-12 btn-sm-6 col-md-6 order-1 order-md-2">
            <a href="#receiver-section" id="btn-go-offer" class="btn btn-next float-right" data-isnorges="{{session('customer')['isNorges']}}">Videre <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <!-- OPTIONS MODAL -->
    <div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mt-4 option-modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped mb-4 table-bordered">
                <tr>
                    <td>Flytter fra</td>
                    <td>Flytter til</td>
                </tr>
                <tr>
                    <td>{{session('customer')['old_address'] ?? ''}}</td>
                    <td>{{session('customer')['new_address'] ?? ''}}</td>
                </tr>
            </table>
            <?php if(isset(session("customer")["totalPerson"]) && session("customer")["totalPerson"] > 1){ ?>
            <div class="modal-person">
                <h6>Flyttemeldingen gjelder for</h6>
                <?php 
                if(isset(session("customer")["totalPerson"])){ 
                    for($x = 0; $x < session("customer")["totalPerson"]; $x++){ ?>
                <input type="checkbox" class="person-list" id="person{{$x}}" value="person{{$x}}">
                <label for="person{{$x}}">{{session('customer')['person'.$x]['name'] ?? ''}}</label><br>
                <?php } 
                } ?>
            </div>
        <?php } ?>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-notif">Bekreft flyttemelding</button>
          </div>
        </div>
      </div>
    </div>

    <!-- BANK MODAL -->
    <div class="modal fade" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="bankModalLabel" aria-hidden="true">
      <div class="text-center modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body mt-4">
            <div class="text-center mb-4">
                <h5 class="modal-title">BANK</h5>            
            </div>
            <p>
                Banker og finansinstitusjoner vil oppdatere din nye adresse direkte fra Folkeregisteret. Du trenger derfor ikke å sende en flyttemelding til disse aktørene.
            </p>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-notif">Ok</button>
          </div>
        </div>
      </div>
    </div>

    <!--CONFIRMATION MODAL-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="text-center modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-body mt-4">
            <div class="text-center mb-4">
                <h5 class="modal-title">Er du sikker på at du vil fjerne <span id="company-name"></span> fra listen?</h5>            
            </div>
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-delete">Ja</button>
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Nei</button>
          </div>
        </div>
      </div>
    </div>
</section>
<section id="power-supplier-section" class="collapse multi-collapse">
    <div class="row px-4 mt-5 mt-md-0">
        <div class="col-12 col-md-8 offset-md-2 text-center">
            <h2>Strøm i ny bolig</h2>
        </div>
    </div>  
    <div class="row px-4 mt-5 mt-md-0 text-center">
        <div class="col-12 col-md-10 offset-md-1 text-center text-md-left">
            <h5 class="text-center">Du vil nå få tilsendt en sms som starter prosessen med bestilling av strøm</h5>
            <h5 class=" mb-5 text-red text-center">VIKTIG: Du må bekrefte din bestilling ved å svare JA på SMSen du mottar.</h5>
        </div>
        <div class="col-12 col-md-10 offset-md-1 text-center">
            <a href="/boligsjekk/" class="btn btn-info py-3 w-200">Fortsett flyttemeldingen <i class="fas fa-arrow-right" title="Offers page"></i></a>
        </div>
    </div>  
</section>
@endsection
