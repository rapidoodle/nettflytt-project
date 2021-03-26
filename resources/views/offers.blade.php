@extends('layouts.main')
@section('content')
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
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

<div class="row px-4 mb-5 mt-5 mt-md-0 d-none d-md-inline">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Sammen står vi sterkere!</h2>
        <p class="mt-3">For å effektivt holde prisen nede holder vi to anbudskonkurranser i året der den leverandøren som strekker seg lengst vinner.</p>
    </div>
</div>  

<div class="row px-4 mb-4 mt-5 mt-md-0 d-md-none">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Sammen står vi sterkere!</h2>
        <p class="mt-3">For å effektivt holde prisen nede holder vi to anbudskonkurranser i året der den leverandøren som strekker seg lengst vinner.</p>
    </div>
</div>  
<div class="row px-4 mt-0 mb-4 mb-md-5 my-lg-5  mt-lg-0">
    <div class="col-12 col-lg-8">
        <div class="accordion" id="offersAcdn">
            <?php if(!Session::has('customer.isNorges') || session('customer')['isNorges'] == 0){ ?>
          <div class="card">
            <div class="card-header active" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Strøm <i class="fas fa-power-off"></i>
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#offersAcdn">
              <div class="card-body">
                <h5>Ønsker du tilbud på den beste strømavtalen i ditt område?</h5>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <p>La strømleverandørene konkurrere om deg. Vi finner den beste leverandøren basert på ditt nye område</p>
                        <h6>TILBUD! Bestill strøm å få gratis postkasseskilt!</h6>
                        <?php if(!isset(session('customer')['switch_service']['isStrom']) || session('customer')['switch_service']['isStrom'] == 0){ ?>
                        <div class="row mt-4 mb-2 pl-md-4">
                            <div class="col pl-md-4 order-1">
                                <a class="btn btn-info btn-block btn-blur py-3 btn-actions" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Nei takk</a>
                            </div>
                            <div class="col pl-md-4 order-2">
                                <a class="btn btn-info btn-block py-3 btn-offer btn-actions" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" data-offer="isStrom">Ja takk!</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col col-md-4 d-none d-md-inline">
                        <img src="{{ asset('images/windmill.png')}}" class="img-fluid" alt="windmill image">
                    </div>
                </div>
              </div>
            </div>
          </div>
      <?php } ?>
          <div class="card">
            <div class="card-header  <?=Session::has('customer.isNorges') && session('customer')['isNorges'] == 1 ? 'active' : ''?>" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  TV/Internet <i class="fas fa-lock"></i>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse <?=Session::has('customer.isNorges') && session('customer')['isNorges'] == 1  ? 'show' : ''?>" aria-labelledby="headingTwo" data-parent="#offersAcdn">
               <div class="card-body">
                <h5>Ønsker du tilbud på den beste TV/Internett-avtalen i ditt område?</h5>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <p>La leverandørene konkurrere om deg. Vi finner den beste leverandøren basert på ditt nye område</p>

                        <?php if(!isset(session('customer')['switch_service']['isTV']) || session('customer')['switch_service']['isTV'] == 0){ ?>
                        <div class="row mt-4 mb-2 pl-md-4">
                            <div class="col pl-md-4 order-1">
                                <a class="btn btn-info btn-block btn-blur py-3 btn-actions" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Nei takk</a>
                            </div>
                            <div class="col pl-md-4 order-2">
                                <a class="btn btn-info btn-block py-3 btn-offer btn-actions" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree" data-offer="isTV">Ja takk!</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col col-md-4 d-none d-md-inline">
                        <img src="{{ asset('images/windmill.png')}}" class="img-fluid">
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Flyttevask<i class="fas fa-home"></i>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#offersAcdn">
               <div class="card-body">
                <h5>Ønsker du å motta et uforpliktende tilbud på den beste flyttevasken-leverandøren i ditt område?</h5>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <p>100% fornøyd, eller pengene tibake.</p>
                        <?php if(!isset(session('customer')['switch_service']['isFlyttevask']) || session('customer')['switch_service']['isFlyttevask'] == 0){ ?>
                        <div class="row mt-4 mb-2 pl-md-4">
                            <div class="col pl-md-4 order-1">
                                <a class="btn btn-info btn-block btn-blur py-3 btn-actions" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Nei takk</a>
                            </div>
                            <div class="col pl-md-4 order-2">
                                <a class="btn btn-info btn-block py-3 btn-offer btn-actions" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour" data-offer="isFlyttevask">Ja takk!</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col col-md-4 d-none d-md-inline">
                        <img src="{{ asset('images/windmill.png')}}" class="img-fluid">
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingFour">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Boligalarm <i class="fas fa-lock"></i>
                </button>
              </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#offersAcdn">
               <div class="card-body">
                <h5>Ønsker du tilbud på den beste boligalarm-avtalen i ditt område?</h5>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <p>La alarmleverandørene konkurrere om deg. Vi finner den beste leverandøren basert på ditt nye område</p>
                        <?php if(!isset(session('customer')['switch_service']['isBoligalarm']) || session('customer')['switch_service']['isBoligalarm'] == 0){ ?>
                        <div class="row mt-4 mb-2 pl-md-4">
                            <div class="col pl-md-4 order-1">
                                <a class="btn btn-info btn-block btn-blur py-3 btn-actions" href="/postkasse">Nei takk</a>
                            </div>
                            <div class="col pl-md-4 order-2">
                                <a class="btn btn-info btn-block py-3 btn-offer btn-actions" href="/postkasse" data-offer="isBoligalarm">Ja takk!</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col col-md-4 d-none d-md-inline">
                        <img src="{{ asset('images/windmill.png')}}" class="img-fluid">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-12 col-lg-3 offset-lg-1 d-none d-md-inline" id="summary">
        <div class="bg-info index-summary p-4 mt-4 mt-lg-0">
            <p class="heading">Oppsummering</p>
            <p class="sub-heading">Gammel adresse</p>
                    <div class="input-group mt-2 group-form">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="gamel-address-1-icon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                        </div>
                        <input type="text" id="gamel-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly value="{{session('customer')['old_address'] ?? ''}}">
                    </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="gamel-address-2-icon">
                        <i class="fa fa-map-o"></i>
                    </span>
                </div>
                <input type="text" id="gamel-address-2" class="form-control" placeholder="1234 Oslo" readonly value="{{session('customer')['old_post']  ?? ''}}">
            </div>

            <p class="sub-heading mt-3">Ny adressee</p>
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

            <p class="sub-heading mt-3">Mottakere</p>
            <div class="summary-choices px-2 py-3">
                    <table width="100%" class="selected-list">
                        <?php 
                        if(!isset(session('customer')['services'])){?>
                        <tr class="default-selected">
                            <td align="center">Selected Company</td>
                        </tr>
                        <?php } else{
                            if(isset(session('customer')['services'])){
                            foreach (session('customer')['services'] as $key => $value) {
                            $newId = time(); 
                            if($value){?>
                        <tr id="comp_{{$key}}{{$newId}}">
                            <td width="10%"><i class="fas fa-check"></i></td>
                            <td class="company-list">{{$value[0]}}</td>
                            <td>
                                <i class="fas fa-times pointer select-delete" data-parent="comp_{{$key}}{{$newId}}" data-value="{{$value[0]}}" data-toggle="modal" data-target="#deleteModal" data-toggle="modal" data-target="#deleteModal"></i>
                            </td>
                        </tr>
                        <?php } } } }?>
                    </table>
            </div>
        </div>
    </div>
</div>

<div class="row px-4 mt-2 mb-4">
    <div class="mt-2 mt-md-0 col-12 btn-sm-6 col-md-6 order-2 order-md-1">
        <a href="/receiver/" class="btn btn-previous float-left"><i class="fas fa-arrow-left"></i> Gå tilbake</a>
        
    </div>
    <div class="col-12 btn-sm-6 col-md-6 order-1 order-md-2">
        <a id="btn-go-postbox" class="btn btn-next float-right">Videre <i class="fas fa-arrow-right"></i></a>
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
            <p>
                
            </p>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-delete">Ja</button>
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Nei</button>
          </div>
        </div>
      </div>
    </div>
@endsection
