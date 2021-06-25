@extends('layouts.main')
@section('title', 'Profile')
@section('content')
<!-- 47101010 -->
<!-- 29257 -->
<?php
$now        = time(); // or your date as well
$your_date  = strtotime(session('customer')['_created']);
$datediff   = $your_date - $now;
$days       = round($datediff / (60 * 60 * 24));
$hours      = $days * 24 * 24;

if($hours < 1){
    $status = "status_orange.json"; 
    $title  = "Behandles hes leverander";
}elseif($hours >= 1 && $hours < 20 ){
    $status = "status_blue.json"; 
    $title  = "Sendt";
}elseif($hours >= 20 && $hours >= 336){
    $status = "status_yellow.json"; 
    $title  = "Behandles hos leverandør";
}else{
    $status = "status_green.json"; 
    $title  = "Bekreftet";
}



?>
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
<div class="container">
    <div class="row mb-4 mt-5 mt-md-0">
        <div class="col-12 text-center">
            <h2>Hei {{session('customer')['first_name']}}</h2>
            <p>Under kan du se status for de ulike flyttemeldingene dine. <br>Har du spørsmål <a href="/kontakt-oss">_kontakt_oss_</a></p>
        </div>
    </div>  
    <div class="row mb-4">
        <div class="col-12">
            @if(count(session('customer')['services']) > 0)
            @foreach(session('customer')['services'] as $service)
            <?php

            $people  = explode(",", $service[2]);
            $replied =  in_array($service[1], $response);
            if($replied == 1 && $hours <= 20){
                $status = "status_yellow.json"; 
                $title  = "Behandles hos leverandør";
            }else if($replied == 1 && $hours > 20){
                $status = "status_green.json"; 
                $title  = "Bekreftet";
            }
            ?>
            <div class="bg-light p-4 p-md-5 mb-5">
                <h3 class="text-center mb-4">Flyttemelding til {{$service[0]}}</h3>
                <div class="row">
                    <div class="col-md-3 col-12 mb-4 mb-md-none">
                        <div class="card card-profile">
                            <div class="card-body">
                                <center>
                                    <h5><i class="fa fa-user"></i> Adresse</h5>
                                </center>
                                <p class="text-bold">Flytter fra</p>
                                <table class="w-100">
                                    <tr>
                                        <td>Adresse: <b>{{session('customer')['old_address']}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Postnummer: <b>{{session('customer')['old_zipcode']}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Poststed: <b>{{session('customer')['old_place']}}</b></td>
                                    </tr>
                                </table>
                                <hr>
                                <p class="text-bold">Flytter til</p>
                                <table class="w-100">
                                    <tr>
                                        <td>Adresse: <b>{{session('customer')['new_address']}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Postnummer: <b>{{session('customer')['new_zipcode']}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Poststed: <b>{{session('customer')['new_place']}}</b></td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12 mb-4 mb-md-none">
                        <div class="card card-profile">
                            <div class="card-body text-left">
                                <center>
                                    <h5><i class="fa fa-user"></i> Personer</h5>
                                </center>
                                @for ($i=0; $i < count($people); $i++)
                                <p class="text-bold">{{session('customer')[$people[$i]]['first_name']}} {{session('customer')[$people[$i]]['last_name']}}</p>
                                <table class="w-100">
                                    @if($i == 0)
                                    <tr>
                                        <td><b>Hovedperson</b></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td>Født: <b>{{session('customer')[$people[$i]]['bday']}}</b></td>
                                    </tr>
                                </table>
                                @if($i != count($people) - 1)
                                <hr>
                                @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-4 mb-md-none">
                        <div class="card card-profile">
                            <div class="card-body p-md-5">
                                <h4 class="text-center">Status per {{date("d.M Y")}} Klokken {{date("H:i")}}</h4>
                                <lottie-player style="height:100px" src="{{ asset('lottie/'.$status) }}" background="transparent"  speed="1" autoplay loop></lottie-player>
                                <h6 class="text-center">{{$title}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
           <div class="bg-light p-4 p-md-5 mb-4">
                <h3 class="text-center">Ingen selskaper lagt til</h3>
            </div>
            @endif

            @if($days <= 14)
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="mb-4">
                        <div class="input-group mb-3 receiver-search-group">
                            <input type="text" class="form-control" placeholder="Søk etter selskap eller organisasjon" aria-label="Søk etter selskap eller organisasjon" aria-describedby="basic-addon2" id="receiver-search-input">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" id="company-search">Søk</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 result-cont">
                        <p class="ps-cont text-left">
                            <b class="text-bold">Eller, </b> viderefør din eksisterende avtale
                        </p>
                        <div class="bg-light w-100 p-4 search-no-result">
                            <h5>Det er dessverre ingen Norske selskaper som passer med søket ditt</h5>
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
                <div class="col-12 col-md-5">
                    <div class="bg-info index-summary p-4 mt-4 mt-lg-0">
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
            @endif
        </div>
    </div>
    <center class="mb-4">
        <a class="btn btn-extra-lg" href="/logout">Avslutt</a>
    </center>
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
@endsection


