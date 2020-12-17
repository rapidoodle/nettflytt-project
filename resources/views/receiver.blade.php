@extends('layouts.main')
@section('content')
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
                <sub>Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div>
                <span class="steps-circle">4</span>
                <sub>Oppsummering</sub>
            </div>
    </div>
</div>

<div class="row px-4 mb-4 mb-md-5 mt-5 mt-md-0 title-receiver">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Velg mottakere av din flyttemelding</h2>
        <p class="mt-3 d-none d-md-inline">Under er det kategorier som hjelper deg å finne dine leverandører. Du kan også bruke søkefeltet til å finne dine bedrifter.</p>
    </div>
</div>  

<div class="row px-4 mb-4 mb-md-5 mt-5 mt-md-0 ps-cont">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Strøm i ny bolig</h2>
        <p class="mt-3">Dersom du ikke bestiller strøm fra en strømleverandør på ditt nye bosted vil du få leveringspliktig strøm fra din nettleverandør. Dette kan bli dyrt. Vi anbefaler deg derfor at du bestiller strøm på ditt nye bosted hvis ikke dette allerede er gjort eller er inkludert i eventuell husleie.</p>
    </div>
</div>  

<div class="ps-cont text-center mt-5 mt-md-0">
    <h5 class="mini-header">
    Velg ny strømavtale for !adress</h5>
    <div class="row px-4 mb-5">
        <div class="col-12 col-md-6 text-center p-4">
            <div class="ps-option p-4 mx-0 mx-lg-5">
                <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                <h5 class="my-4">STRØM TIL LAVPRIS</h5>

                <p>Med Strøm til lavpris får du en spotprisavtale, som ifølge Statistisk sentralbyrå har vært den billigste avtaleformen i over 10 år. Det betyr at du kan slappe av og fokusere på det som gir deg god energi!</p>
                <div class="text-left my-4">
                    <a href="javascript:void();">Les avtaleviklårene</a>
                </div>

                <a class="btn btn-violet" href="/power-supplier/">
                Bestill Strøm til Lavpris
                </a>
            </div>
        </div>
        <div class="col-12 col-md-6 text-center p-4">
            <div class="ps-option p-4 mx-0 mx-lg-5">
                <img src="{{ asset('images/norges-energy.png')}}" class="img-fluid" width="100px" alt="norger energey logo">
                <h5 class="my-4">TOPP 5 VARIABEL</h5>

                <p>Strømavtalen Topp 5-garanti sikrer deg en variabel strømpris som på årlig basis alltid er blant de 10 beste, målt mot en representativ liste over konkurrentene våre.</p>

                <div class="text-left my-4">
                    <a href="javascript:void();">Les avtaleviklårene</a>
                </div>

                <a class="btn btn-violet" href="/power-supplier/">Bestill Strøm til Lavpris</a>
            </div>
        </div>
    </div>  
</div>
    <h3 class="mini-header d-md-none mb-4 label-none">
    Velg ny strømavtale for !adress</h3>
<div class="row px-4 mt-0 mb-5 my-lg-5  mt-lg-0 form">
    <div class="col-12 col-lg-8">
        <div class="cat-n-search">
            <div class="d-flex flex-wrap category-container align-content-center justify-content-center mb-4">
                <div class="category-item" data-val="Ofte brukte">
                    <i class="far fa-star"></i>
                    Ofte brukte
                </div>
                <div class="category-item" data-val="TV/Internett">
                    <i class="fas fa-tv"></i>
                    TV/Internett
                </div>
                <div class="category-item" data-val="Aviser">
                    <i class="fa fa-newspaper-o"></i>
                    Aviser
                </div>
                <div class="category-item" data-val="Boligalarm">
                    <i class="fas fa-lock"></i>
                    Boligalarm
                </div>
                <div class="category-item" data-val="Medlemskap">
                    <i class="fas fa-paperclip"></i>
                    Medlemskap
                </div>
                <div class="category-item" data-val="Utdanning">
                    <i class="fas fa-graduation-cap"></i>
                    Utdanning
                </div>
                <div class="category-item" data-val="Boligbyggelag">
                    <i class="fas fa-handshake"></i>
                    Boligbyggelag
                </div>
                <div class="category-item" data-val="Telefon">
                    <i class="fas fa-phone"></i>
                    Telefon
                </div>
                <div class="category-item" data-val="Forsikring">
                    <i class="fas fa-home"></i>
                    Forsikring
                </div>
                <div class="category-item" data-val="Strøm">
                    <i class="fas fa-power-off"></i>
                    Strøm
                </div>
                <div class="category-item" data-val="Magasiner">
                    <i class="fa fa-file-image-o"></i>
                    Magasiner
                </div>
                <div class="category-item" data-val="Bank">
                    <i class="fas fa-university"></i>
                    Bank
                </div>
            </div>
            <div class="mb-4">
                <div class="input-group mb-3 receiver-search-group">
                    <input type="text" class="form-control" placeholder="Søk etter selskap eller organisasjon" aria-label="Søk etter selskap eller organisasjon" aria-describedby="basic-addon2" id="receiver-search-input">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="button" id="search">Søk</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <p class="ps-cont text-left">
                <b class="text-bold">Eller, </b> viderefør din eksisterende avtale
            </p>
            <table class="table table-striped receiver-search-result">
                <tr>
                    <td>Aftenposten
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal"data-val="Aftenposten">Legg til</button>
                </tr>
                <tr>
                    <td>Dagbladet
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal"data-val="Dagbladet">Legg til</button>
                </tr>
                <tr>
                    <td>VG
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal"data-val="VG">Legg til</button>
                    </td>
                </tr>
                <tr>
                    <td>Klassekampen
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal" data-val="Klassekampen">Legg til</button>
                    </td>
                </tr>
                <tr>
                    <td>Porsgrunn dagblad
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal" data-val="Porsgrunn dagblad">Legg til</button>
                    </td>
                </tr>
                <tr>
                    <td>Varden
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal" data-val="Varden">Legg til</button>
                    </td>
                </tr>
                <tr>
                    <td>TA
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal" data-val="TA">Legg til</button>
                    </td>
                </tr>
                <tr>
                    <td>Budstikka
                        <button class="float-right btn btn-info select-result" data-toggle="modal" data-target="#optionModal" data-toggle="modal" data-target="#optionModal" data-val="Budstikka">Legg til</button>
                    </td>
                </tr>
            </table>
            <center><nav aria-label="Page navigation example" class="text-center">
                <ul class="mt-2 justify-content-center justify-content-md-start pagination nav-receiver">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <i class="fa fa-chevron-left"></i>
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <i class="fa fa-chevron-right"></i>
                      </a>
                    </li>
                </ul>
            </nav>
            </center>
        </div>
    </div>
    <div class="col-12 col-lg-3 offset-lg-1" id="summary">
        <div class="d-none d-md-block bg-info index-summary p-4 mt-4 mt-lg-0">
            <p class="heading">Oppsummering</p>
            <p class="sub-heading">Gammel adresse</p>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="gamel-address-1-icon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                </div>
                <input type="text" name="gamel-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly>
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="gamel-address-2-icon">
                        <i class="fa fa-map-o"></i>
                    </span>
                </div>
                <input type="text" name="gamel-address-2" class="form-control" placeholder="1234 Oslo" readonly>
            </div>

            <p class="sub-heading mt-3">Ny adressee</p>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="ny-address-1-icon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                </div>
                <input type="text" name="ny-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly>
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="ny-address-2-icon">
                        <i class="fa fa-map-o"></i>
                    </span>
                </div>
                <input type="text" name="ny-address-2" class="form-control" placeholder="1234 Oslo" readonly>
            </div>

            <p class="sub-heading mt-3">Mottakere</p>
            <div class="summary-choices px-2 py-3">
                <table width="100%" id="selected-list">
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>Telenor</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>Fjordkraft</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>OBOS</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-md-none bg-info index-summary p-4 mt-4 mt-lg-0">
            <p class="sub-heading">Mottakere</p>
            <div class="summary-choices p-4">
                <table width="100%" id="selected-list">
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>Telenor</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>Fjordkraft</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-check"></i></td>
                        <td>OBOS</td>
                        <td><i class="fas fa-times"></i></td>
                    </tr>
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
        <button id="btn-go-offer" class="btn btn-next float-right">Videre <i class="fas fa-arrow-right"></i></button>
    </div>
</div>

<div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-4">Flyttemelding for !reciever</h5>
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
                <td>!old adress</td>
                <td>!new adress</td>
            </tr>
        </table>
        <div class="modal-person">
            <h6>Flyttemeldingen gjelder for</h6>
            <input type="checkbox" name="" id="person1"> <label for="person1">!person1</label>
            <input type="checkbox" name="" id="person2" class="ml-2">
            <label for="person2">!person2</label>
        </div>

      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-notif">Bekreft flyttemeldings</button>
      </div>
    </div>
  </div>
</div>
@endsection
