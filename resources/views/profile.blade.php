@extends('layouts.main')
@section('title', 'Profile')
@section('content')
<!-- 93830240 -->
<!-- 77484 -->
<!-- {{json_encode(session('customer'))}} -->
<?php
$now        = time(); // or your date as well
$your_date  = strtotime(session('customer')['_created']);
$datediff   = $now - $your_date;
$days       = round($datediff / (60 * 60 * 24));
$hours      = $days * 24;

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
            
            // echo $service[1];
            // echo json_encode($response);
            // echo $replied;
            if($replied == 1 && $hours <= 20){
                $status = "status_yellow.json"; 
                $title  = "Behandles hos leverandør";
            }else if($replied == 1 && $hours > 20){
                $status = "status_green.json"; 
                $title  = "Bekreftet";
            }
            ?>
            <div class="bg-light p-4 p-md-5 mb-4">
                <h3 class="text-center mb-4">Flyttemelding til {{$service[0]}}</h3>
                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="card card-profile mb-4">
                            <div class="card-body">
                                <center>
                                    <h5><i class="fa fa-user"></i> Address</h5>
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
                    <div class="col-md-3 col-12">
                        <div class="card card-profile mb-4">
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
                    <div class="col-md-6 col-12">
                        <div class="card card-profile mb-4">
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
        </div>
    </div>
<!--     <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-primary btn-lg">Avslutt</a>
        </div>
    </div> -->
</div>
@endsection


