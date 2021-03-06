@extends('layouts.main')
@section('title', 'Home')
@section('content')
<?php
$months  = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];

$monthsE = ['January', 'February', 'March', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'December']; 

$others  = ['enebolig2' => 'Enebolig m/utleiedel', 'tomannsbolig' => 'Tommansbolig', 'tomannsbolig2' => 'Tommansbolig m/utleiedel', 'rekkehus' => 'Rekkehus', 'hybel' => 'Hybel'];
// XzDgiIikzQLdksklE0OdQW572ifi8f9d9ztgs6IHVhHSUNfws33U81c7UKeZfUer

//save unique visitor
Helper::saveVisitor();
?>
<img src="{{ asset('images/couple-desktop.webp')}}" class="img-fluid d-sm-none my-4" alt="smiley couple taking selfie while packing move out">
<div class="row px-2 px-lg-4 mb-5">
    <div class="col-12 col-sm-6 d-flex align-content-center flex-wrap">
        <h3 class="flex-item">{{isset($type) ? 'Folkeregisteret' : 'Adresseendring for Norge'}}</h3>

        <?php if(!isset($type)) { ?>
        <p class="mt-0">Her kan du fylle ut én enkelt flyttemelding til alle selskaper og organisasjoner du er medlem hos. Du mottar også direkte utfylt skjema for Folkeregisteret ved fullføring</p>
        <?php }else{ ?>
        <p class="mt-0"><b>Det holder ikke å kun melde flytting til Folkeregisteret hvis du ønsker å motta posten på din nye adresse. Meld flytting her.</b></p>
        <p class="mt-0">Når du melder flytting til Folkeregisteret er det kun Folkeregisteret som får din nye adresseinformasjon. Det er derimot noen som benytter Folkeregisteret til å hente ut adresseinformasjon om deg. Dette gjelder blant annet alle banker og offentlige etater som NAV, Skattekontoret, Lånekassen og Forsvaret. Alle dine kontakter, kundeforhold og medlemskap utenfor dette må ha en flyttemelding fra deg.</p>
        <p class="mt-0">Gjennom flytteregisteret adresseendringstjeneste kan du si ifra til alle dine kontakter, kundeforhold og medlemskap. Du fyller bare ut din adresseinformasjon én gang og velger hvem du vil informere til blant vår liste over selskaper og organisasjoner.</p>
        <p class="mt-0">Når du er ferdig med adresseendringstjenesten kan du laste ned <b>Folkeregisterets flytteskjema</b> utfylt med informasjonen du la inn</p>
        <?php } ?>

        <a class="btn btn-info mt-2 px-4 py-2" href="#index-form-container">Start flytting</a> 

        <div class="d-flex align-items-center flex-wrap steps mt-5">
            <div class="header-num">1</div>
            <div class="header-mini ml-1">Fyll ut flyttemelding</div>
            <div class="header-num ml-3">2</div>
            <div class="header-mini ml-1">Velg mottakere</div>
            <div class="header-num ml-3">3</div>
            <div class="header-mini ml-1">Send flyttemeldingene</div>
        </div> 
    </div>
    <div class="col-12 col-sm-6 py-4 pt-sm-0 pb-sm-3 d-none d-sm-inline">
        <img src="{{ asset('images/couple-desktop.png')}}" class="img-fluid" alt="smiley couple taking selfie while packing move out" height="100%">
    </div>
</div>  
<script type="text/javascript">
    //phone validator
    function validateForm(){
        console.log($("#isReq").val());
        var valid  = false;
        if($("#isReq").val() == "1"){
            var phone = $("#phone").val();
            var validN = phone.substr(phone.length - 8);
            // console.log("phone: "+validN);
            var message = "Telefonnumeret i skjemaet er feil, vennligst skriv inn riktig telefonnummer.";

            if(validN.substr(0, 1) != "4" && validN.substr(0, 1) != "9"){
                alert(message);
                return false;
                valid = false;
            }else{
                valid = true;
            }
        }else{
            valid = true;
        }

        if($("#name_0").length == 0){
            var birthDate = new Date($("#birth_year").val()+"-"+$("#birth_month").val()+"-"+$("#birth_day").val());
            var today = new Date();
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }    
            // console.log(age);
            if(age >= 18){
                valid = true;
            }else{
                alert("Hovedpersonen må være 18 år gammel");
                valid = false;
            }
        }

        if($("#full-name").val()){
            var length = $("#full-name").val().split(' ').length;
            // console.log("name length "+length);
            if(length <= 1){
                alert("Ugyldig navn");
                valid = false;
                return false;
            }
        }
        var hasNumber  = /\d/;
        if(hasNumber.test($("#old_place").val()) === true || hasNumber.test($("#new_place").val()) === true){
            alert("Feil postnummer. Vennligst sjekk at postnummeret er riktig.");
                valid = false;
                return false;
        }

        // console.log("isValid: "+valid);
        if(valid == true){
            $("#submit-form").attr("disabled", true);
        }
        return valid;
        // return false;
    }

</script>
<form action="/getToken" method="POST" id="index-form" onsubmit="return validateForm()">
@csrf <!-- {{ csrf_field() }} -->
<input type="hidden" name="tracking_gclid" id="tracking_gclid">
<input type="hidden" id="csrf" value="{{ csrf_token() }}">
<div class="row px-4 my-5 form" id="index-form-container">
    <div class="col-12 col-sm-12 col-lg-9 form-">
            <div class="row">
                <div class="accordion bg-xs-light col-12 col-sm-12 col-lg-5">
                    <div class="header-num">1</div> <h6>Personlig informasjon 
                                        <a class="clear-form text-bold pointer float-right">Nullstill skjema</a></h6> 
                    <hr class="mb-2">
                    <div class="card bg-sm-light p-0 bg-xs-light" id="customer-form">
                        <div class="accordion mb-4 mb-md-0" id="extra-names">
                            <?php 
                            if(Session::has('customer')){ 
                                if(isset(session('customer')['totalPerson']) && session('customer')['totalPerson'] != 0){
                                for ($i=0; $i < session('customer')['totalPerson']; $i++){
                                    if(isset(session('customer')['person'.$i])){

                                $newId = $i.time();
                                $type  = $i == 0 ? "(hovedperson)" : "(ekstraperson)";
                            ?>
                            <div class="card person" id="card_{{$newId}}">
                            <div class="p-2 pointer card-header d-flex align-items-center justify-content-between" id="{{$newId}}" data-toggle="collapse" data-target="#col_{{$newId}}" aria-expanded="true" aria-controls="collapseOne">
                                <span>{{session('customer')['person'.$i]['first_name']}} {{session('customer')['person'.$i]['last_name']}} {{$type}}</span>
                                <?php if($i != 0){ ?>
                                <i class="fa fa-times float-right" data-id="card_{{$newId}}"    style="margin-top:-3px;z-index:99999999999"></i>
                                <?php } ?>
                            </div>
                            <div id="col_{{$newId}}" class="collapse" aria-labelledby="{{$newId}}" data-parent="#extra-names">
                                <div class="bg-white card-body">
                                    <table class="w-100">
                                        <tr>
                                            <td>Full name</td>
                                            <td><input type="text" class="person-input" value="{{session('customer')['person'.$i]['first_name']}} {{session('customer')['person'.$i]['last_name']}}" id="name_{{$i}}" required="true"></td>
                                        </tr>
                                        <tr>
                                            <td>E-post</td>
                                            <td><input type="email" class="person-input" value="{{session('customer')['person'.$i]['email']}}" id="email_{{$i}}" required="true" oninvalid="alert('Invalid E-post');" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" minlength="7"></td>
                                        </tr>
                                        <tr>
                                            <td>Telefonnummer</td>
                                            <td><input type="text" class="person-input" value="{{session('customer')['person'.$i]['phone']}}" id="phone_{{$i}}" required="true"></td>
                                        </tr>
                                        <tr>
                                            <td>Fødselsdato</td>
                                            <td><input type="date" class="person-input" value="{{session('customer')['person'.$i]['bday']}}" id="bday_{{$i}}" required="true"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 
                        </div>
                        <?php } } }else {
                            $newId = time();
                        ?>
                            <div class="card person" id="card_{{$newId}}">
                            <div class="p-2 pointer card-header d-flex align-items-center justify-content-between" id="{{$newId}}" data-toggle="collapse" data-target="#col_{{$newId}}" aria-expanded="true" aria-controls="collapseOne">
                                <span>{{isset(session('customer')['first_name']) ?? session('customer')['first_name']}} {{isset(session('customer')['last_name']) ?? session('customer')['last_name']}}</span>
                                <i class="fa fa-times float-right" data-id="card_{{$newId}}" style="margin-top:-3px;z-index:99999999999"></i>
                            </div>
                            <div id="col_{{$newId}}" class="collapse" aria-labelledby="{{$newId}}" data-parent="#extra-names">
                                <div class="bg-white card-body">
                                    <table class="w-100">
                                        <tr>
                                            <td>Full name</td>
                                            <td><input type="text" class="person-input" value="{{isset(session('customer')['first_name']) ?? session('customer')['first_name']}} {{isset(session('customer')['last_name']) ?? session('customer')['last_name']}}" id="name_0" required="true"></td>
                                        </tr>
                                        <tr>
                                            <td>E-post</td>
                                            <td><input type="email" class="person-input" value="{{isset(session('customer')['email']) ?? session('customer')['email']}}" id="email_0" required="true" oninvalid="alert('Invalid E-post');" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" minlength="7"></td>
                                        </tr>
                                        <tr>
                                            <td>Telefonnummer</td>
                                            <td><input type="text" class="person-input" value="{{isset(session('customer')['phone']) ?? session('customer')['phone']}}" id="phone_0" required="true"></td>
                                        </tr>
                                        <tr>
                                            <td>Fødselsdato</td>
                                            <td><input type="date" class="person-input" value="{{isset(session('customer')['birth_year']) ?? session('customer')['birth_year']}}-{{isset(session('customer')['birth_month']) ?? session('customer')['birth_month']}}-{{isset(session('customer')['birth_day']) ?? session('customer')['birth_day']}}" id="bday_0" required="true"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div> 
                        </div>
                        <?php } } ?>
                    </div>
                        <div data-parent="#customer-form" class="multi-collapse">
                                <div class="form-group">
                                    <label for="full-name">Fullt navn</label>
                                    <input type="text" class="main-field form-control smy-fld req-fld" id="full-name" data-conn="hk-full-name" placeholder="Fullt navn" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-post</label>
                                    <input type="email" name="email" class="main-field form-control smy-fld req-fld" id="email" placeholder="eksempel@nettflytt.no" required="true" data-conn="hk-email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" minlength="7">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefonnummer</label>
                                    <div class="input-group group-form">
                                            <div class="input-group-prepend" id="phone-group">
                                                <span class="input-group-text" id="phone-icon">
                                                    <img src="{{ asset('images/norway-flag.png')}}" width="20px;">
                                                </span>
                                            </div>
                                            <input type="number" class="main-field form-control smy-fld req-fld" data-conn="hk-phone" id="phone" placeholder="12345678" required="true" maxlength="8" minlength="8">
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="day">Fødselsdato</label>
                                        <select type="text" required="true" class="main-field form-control req-fld" placeholder="Dag" id="birth_day" name="birth_day">
                                            <option value="" disabled selected>Dag</option>
                                        <?php 
                                        for ($i=1; $i <=31 ; $i++) {?>
                                            <option value="{{Helper::digits2($i)}}">{{Helper::digits2($i)}}</option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-4 pl-0">
                                        <label for="month">&nbsp;</label>
                                        <select type="text" required="true" class="main-field form-control req-fld"  id="birth_month" name="birth_month">
                                            <option value="" disabled selected>Måned</option>
                                        <?php 
                                        foreach($months as $i => $month) {?>
                                            <option value="{{Helper::digits2($i+1)}}"><?=$month?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-4 pl-0">
                                        <label for="year">&nbsp;</label>
                                        <select type="text" required="true" class="main-field form-control req-fld"  id="birth_year" name="birth_year">
                                            <option value="" disabled selected>År</option>
                                        <?php 
                                        for ($i = 2003; $i >= 1920 ; $i--) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-2 save-person-collapse-cont">
                                    <div class="col-12">
                                        <a class="save-person-collapse text-bold pointer">Lagre</a>
                                    </div>
                                </div>
                        </div>
                            <div class="form-group mt-3 mb-3half">
                                <label for="add-name">Melder du flytting for fler personer?</label><br>
                                <a class="btn btn-white" id="add-name">
                                    <i class="fas fa-plus"></i> Legg til person
                                </a>
                            </div>
                    </div>
                </div>
                <div class="bg-xs-light col-12 col-sm-12 col-lg-7 pt-3 pt-lg-0 mt-4 mt-lg-0">
                    <div class="header-num">2</div> <h6>Adresse</h6>
                    <hr class="mb-2">
                        <div class="form-group">
                            <label for="old_address">Jeg flytter fra (Gammel adresse)</label>
                            <input type="text" required="true" class="form-control smy-fld" id="old_address" placeholder="Eksempelgaten 10" data-conn="gamel-address-1" name="old_address" value="{{session('customer')['old_address'] ?? ''}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="post-number">Postnummer</label>
                                <input type="text" required="true" class="form-control smy-fld post-search" placeholder="1234" id="old_zipcode" max="4" data-conn="gamel-address-2" name="old_zipcode" value="{{session('customer')['old_zipcode'] ?? ''}}" data-search="old_place">
                            </div>
                            <div class="col-6">
                                <label for="poststed">Poststed</label>
                                <input type="text" required="true" class="form-control smy-fld" placeholder="Poststed" id="old_place" name="old_place" value="{{session('customer')['old_place'] ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="new_address">Jeg flytter til (Ny adresse)</label>
                            <input type="text" required="true" class="form-control smy-fld" id="new_address" data-conn="ny-address-1" placeholder="Eksemmpelgaten 10" name="new_address" value="{{session('customer')['new_address'] ?? ''}}">
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="post-number2">Postnummer</label>
                                <input type="text" required="true" class="form-control smy-fld post-search" placeholder="1234" id="new_zipcode" data-conn="ny-address-2" name="new_zipcode" value="{{session('customer')['new_zipcode'] ?? ''}}" data-search="new_place">
                            </div>
                            <div class="col-6">
                                <label for="poststed2">Poststed</label>
                                <input type="text" required="true" class="form-control smy-fld poststed-2" placeholder="Poststed" id="new_place" name="new_place" value="{{session('customer')['new_place'] ?? ''}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-3">
                                <label for="day">Flyttedato</label>
                                <select type="text" required="true" class="form-control" id="moving_date_day" name="moving_date_day">
                                    <option value="" disabled selected>Dag</option>
                                <?php 
                                for ($i=1; $i <=31 ; $i++) {?>
                                    <option value="{{Helper::digits2($i)}}" {{isset(session('customer')['moving_date_day']) && session('customer')['moving_date_day'] == Helper::digits2($i) ? 'selected' : ''}} >{{Helper::digits2($i)}}</option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="col-4 col-sm-3 px-0">
                                <label for="month">&nbsp;</label>
                                    <select type="text" required="true" class="form-control"  id="moving_date_month" name="moving_date_month">
                                        <option value="" disabled selected>Måned</option>
                                    <?php 
                                    foreach($months as $i => $month) { ?>
                                        <option value="{{Helper::digits2($i+1)}}"{{isset(session('customer')['moving_date_month']) && session('customer')['moving_date_month'] == Helper::digits2($i+1) ? 'selected' : ''}}><?=$month?></option>
                                    <?php } ?>
                                    </select>
                            </div>
                            <div class="col-4 col-sm-3">
                                <label for="year">&nbsp;</label>
                                <select type="text" required="true" class="form-control"  id="moving_date_year" name="moving_date_year">
                                    <option value="" disabled selected>År</option>
                                <?php 
                                for ($i = 2023; $i >= 2021; $i--) {?>
                                    <option value="<?=$i?>"{{isset(session('customer')['moving_date_year']) && session('customer')['moving_date_year'] == $i ? 'selected' : ''}}><?=$i?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 px-3">
                            <div class="col-12 px-0">
                                <label>Boligtype</label>
                            </div>
                        </div>
                        <div class="row index-extra-options">
                            <div class="mt-2 mt-md-0 mb-2 mb-md-0 col-12 col-md-4 pr-md-0">
                                <div class="bg-light py-3 text-center index-option pointer <?=isset(session('customer')['new_house_type']) && session('customer')['new_house_type'] == "enebolig" ? "active-option" : ""?>" data-value="enebolig">
                                <i class="fas fa-home"></i> Enebolig
                                </div>
                            </div>
                            <div class="mb-2 mb-md-0 col-12 col-md-4">
                                <div class="bg-light py-3 text-center index-option pointer <?=isset(session('customer')['new_house_type']) && session('customer')['new_house_type'] == "leilighet" ? "active-option" : ""?>" data-value="leilighet">
                                    <i class="far fa-building"></i> Leilighet
                                </div>
                            </div>
                            <?php $annet_option = isset(session('customer')['new_house_type']) ? session('customer')['new_house_type'] : ""; ?>  
                            <div class="col-12 col-md-4 pl-md-0">
                                <div class="annet-options bg-light py-3 text-center index-option pointer <?=array_key_exists($annet_option, $others) ? "active-option" : ""?> dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="{{isset($others) ? $annet_option : 'annet'}}">
                                    {{isset($others[$annet_option]) ? $others[$annet_option]  : 'Annet'}}
                                </div>
                                <div class="dropdown-menu bolig-menu">
                                    <?php foreach($others as $key => $value){ ?>
                                    <a class="dropdown-item pointer {{isset($others[$annet_option]) && $annet_option == $key ? 'active'  : ''}}" data-val="{{$key}}">{{$value}}</a>
                                    <?php } ?>
                                </div>
                                <input type="hidden" id="isReq" value="1">
                                <input type="hidden" name="new_house_type" id="new_house_type" value="<?=isset(session('customer')['new_house_type']) ? session('customer')['new_house_type'] : ""?>">
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-5 pt-4 bg-xs-light mt-4 mt-lg-0">
                    <div class="header-num">3</div> <h6>Folkeregisteret</h6>
                    <hr>
                    <div class="d-flex flex-row align-items-center index-step-3 fle">
                        <img src="{{ asset('images/newspaper.png')}}" alt="newspaper image">
                        <p class="p-2">Ved fullføring tilbyr vi mulighet for å laste ned direkte utfylt skjema for flyttemelding til Folkeregisteret. <b>Husk at du og er pliktig til å melde flytting til Folkeregisteret.</b></p>

                    </div>

                        <div class="form-check index-step-4 ml-4 ml-lg-0">
                        <input class="form-check-input" type="checkbox" id="checkF">
                        <label class="form-check-label" for="checkF" >
                        Jeg ønsker direkte utfylt skjema til Folkeregisteret
                        </label>
                    </div>
                </div>
                <div class="col-12 col-lg-7 pt-4">
                    <div class="header-num">4</div> <h6>Postkasseskilt</h6>
                    <hr>
                    <div class="form-check index-step-4 ml-4 ml-lg-0">
                        <input class="form-check-input" type="checkbox" value="1" id="check" name="mailbox-sign" <?=isset(session('customer')['mailbox-sign']) && session('customer')['mailbox-sign'] == 1 ? 'checked="check"' : ""?>">
                        <label class="form-check-label" for="check" >
                        Jeg vil bestille nytt postkasseskilt til den nye adressen for kun kr 169,- inkl frakt
                        </label>
                    </div>
                    <div class="ml-4 ml-lg-0 mt-4 pricing-details">
                        <p>Ved å fullføre adresseendringstjenesten får du:</p>
                        <ul>
                            <li>Sende din flyttemelding til ubegrenset antall mottakere</li>
                            <li>Flytteskjema til Folkeregisteret direkte utfylt med dine data</li>
                            <li>Egen flytteside for oppbevaring av dine adresser og dokumenter</li>
                        </ul>
                        <p class="text-bold">Tjenesten koster kr 149,- som belastes ditt mobilabonnement ved fullføring av tjenesten.</p>
                    </div>
                    <div class="text-center px-5 px-lg-0">
                        <button class="float-lg-right btn btn-info mt-2 mb-auto px-4 py-2" id="submit-form">Meld flytting</button> 
                    </div>
                    <!-- <button class="float-right btn btn-info mt-4 mb-auto" id="submit-form" type="submit">Meld flytting</button>  -->
                </div>
            </div>
    </div>
    <div class="col-12 col-lg-3 d-none d-lg-block" id="summary">
        <div class="bg-info index-summary p-4 mt-4">
            <p class="heading text-center">Oppsummering</p>
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
            <p class="sub-heading mt-4">Hovedkontakt</p>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="hk-name-icon">
                        <i class="fa fa-user-o"></i>
                    </span>
                </div>
                <input type="text" id="hk-full-name" name="full-name" class="form-control" placeholder="Fullt navn" readonly value="{{session('customer')['full-name'] ?? ''}}">
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend"id="hk-phone-icon">
                    <span class="input-group-text">
                        <i class="fa fa-phone"></i>
                    </span>
                </div>
                <input type="text" id="hk-phone" name="phone" class="form-control" placeholder="12345678" readonly value="{{session('customer')['phone'] ?? ''}}">
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="hk-email" name="email" class="form-control" placeholder="12345678" readonly>
</form>
@endsection
