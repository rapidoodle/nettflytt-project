@extends('layouts.main')
@section('content')
<?php

$months = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];

?>
<div class="row px-4 mb-5">
    <div class="col-12 col-md-6 d-flex align-content-end flex-wrap">
        <img src="{{ asset('images/couple-mobile.png')}}" class="img-fluid d-md-none my-4 flex-item" alt="smiley couple taking selfie while packing move out">

        <h3 class="flex-item">Adresseendring for Norge</h3>

        <p class="mt-0 mt-md-4">Her kan du fylle ut én enkelt flyttemelding til alle selskaper og organisasjoner du er medlem hos. Du får også ferdigutfylte dokumenter til posten og folkeregisteret</p>

        <a class="btn btn-info mt-2" href="#index-form-container">Meld flytting</a> 
        <div class="d-flex align-items-center flex-wrap steps mt-4">
            <div class="header-num">1</div>
            <div class="header-mini ml-1">Fyll ut flyttemelding</div>
            <div class="header-num ml-3">2</div>
            <div class="header-mini ml-1">Velg mottakere</div>
            <div class="header-num ml-3">3</div>
            <div class="header-mini ml-1">Send flyttemeldingene</div>
        </div> 
    </div>
    <div class="col-12 col-md-6 py-4 pt-md-0 pb-md-3 d-none d-md-inline">
        <img src="{{ asset('images/couple-desktop.png')}}" class="img-fluid" alt="smiley couple taking selfie while packing move out">
    </div>
</div>  

<div class="row px-4 my-5 form" id="index-form-container">
    <div class="col-12 col-md-12 col-lg-9">
        <form class="mt-2rem" id="index-form" action="/receiver" method="GET">
            <div class="row">
                <div class="bg-xs-light col-12 col-md-6 col-lg-5">
                    <div class="header-num">1</div> <h6>Personlig informasjon</h6>
                    <hr class="mb-2">
                    <div class="card bg-md-light p-0 p-md-3 bg-xs-light">
                        <form>
                            <div id="extra-names">
                                
                            </div>
                            <div class="form-group">
                                <label for="full-name">Fullt navn</label>
                                <input type="text" class="form-control smy-fld" id="full-name" data-conn="hk-name" placeholder="Fullt navn">
                            </div>
                            <div class="form-group">
                                <label for="email">E-post</label>
                                <input type="email" class="form-control" id="email" placeholder="eksempel@nettflytt.no">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefonnummer</label>
                                <div class="input-group group-form">
                                        <div class="input-group-prepend" id="phone-group">
                                            <span class="input-group-text" id="phone-icon">
                                            <img src="{{ asset('images/norway-flag.png')}}" width="20px;">
                                            </span>
                                        </div>
                                        <input type="text" class="form-control smy-fld" data-conn="hk-phone" id="phone" placeholder="+47 94059094">
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="day">Fødselsdato</label>
                                    <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="day-icon">
                                            <i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control" placeholder="Dag" id="birth_day">
                                            <option value="" disabled selected>Dag</option>
                                        <?php 
                                        for ($i=1; $i <=31 ; $i++) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-0">
                                    <label for="month">&nbsp;</label>
                                    <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="day-icon">
                                            <i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control"  id="birth_month">
                                            <option value="" disabled selected>Måned</option>
                                        <?php 
                                        foreach($months as $month) {?>
                                            <option value="<?=$month?>"><?=$month?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 pl-0">
                                    <label for="year">&nbsp;</label>
                                   <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="year-icon"><i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control"  id="birth_year">
                                            <option value="" disabled selected>Ar</option>
                                        <?php 
                                        for ($i = 1920; $i <= 2020 ; $i++) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3 mb-3half">
                                <label for="add-name">Melder du flytting for fler personer?</label><br>
                                <a class="btn btn-white" id="add-name">
                                    <i class="fas fa-plus"></i> Legg til person
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-xs-light col-12 col-md-6 col-lg-7 pt-3 pt-md-0 mt-4 mt-md-0">
                    <div class="header-num">2</div> <h6>Adresse</h6>
                    
                    <hr class="mb-2">
                        <div class="form-group pt-md-3">
                            <label for="street-address">Jeg flytter fra (Gammel adresse)</label>
                            <input type="text" required="true" class="form-control smy-fld" id="old_address" placeholder="Eksempelgaten 10" data-conn="gamel-address-1">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="post-number">Postnummer</label>
                                <input type="text" required="true" class="form-control smy-fld" placeholder="123" id="old_zipcode" max="4" data-conn="gamel-address-2">
                            </div>
                            <div class="col-6">
                                <label for="poststed">Poststed</label>
                                <input type="text" required="true" class="form-control" placeholder="Poststed" id="old_place">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="ny-address">Jeg flytter til (Ny adresse)</label>
                            <input type="text" required="true" class="form-control smy-fld" id="new_address" data-conn="ny-address-1">
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="post-number2">Postnummer</label>
                                <input type="text" required="true" class="form-control smy-fld" placeholder="123" id="new_zipcode" data-conn="ny-address-2">
                            </div>
                            <div class="col-6">
                                <label for="poststed2">Poststed</label>
                                <input type="text" required="true" class="form-control" placeholder="Poststed" id="new_place">
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-4 col-md-3">
                                    <label for="day">Fødselsdato</label>
                                    <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="day-icon">
                                            <i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control" id="">
                                            <option value="" disabled selected>Dag</option>
                                        <?php 
                                        for ($i=1; $i <=31 ; $i++) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-md-3">
                                    <label for="month">&nbsp;</label>
                                    <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="day-icon">
                                            <i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control"  id="month">
                                            <option value="" disabled selected>Måned</option>
                                        <?php 
                                        foreach($months as $month) {?>
                                            <option value="<?=$month?>"><?=$month?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 col-md-3">
                                    <label for="year">&nbsp;</label>
                                   <div class="input-group group-form">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="year-icon"><i class="fa fa-arrow-down"></i>
                                            </span>
                                        </div>
                                        <select type="text" required="true" class="form-control"  id="year2">
                                            <option value="" disabled selected>Ar</option>
                                        <?php 
                                        for ($i = 1920; $i <= 2020 ; $i++) {?>
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="row mt-3 px-3 index-extra-options">
                            <div class="col-12 px-0">
                                <label>Boligtype</label>
                            </div>
                            <div class="col bg-light mr-2 py-3 text-center index-option pointer">
                                <i class="fas fa-home"></i> Hus
                            </div>
                            <div class="col bg-light mx-2 py-3 text-center index-option pointer">
                                <i class="far fa-building"></i> Leilighet
                            </div>
                            <div class="col bg-light ml-2 py-3 text-center index-option pointer">
                                Annet
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-5 pt-4 bg-xs-light mt-4 mt-md-0">
                    <div class="header-num">3</div> <h6>Folkeregisteret</h6>
                    <hr>
                    <div class="d-flex flex-row align-items-center index-step-3">
                        <img src="{{ asset('images/newspaper.png')}}" alt="newspaper image">
                        <p class="p-2">Ved fullføring tilbyr vi mulighet for å laste ned direkte utfylt skjema for flyttemelding til Folkeregisteret. Husk at du er pliktig til å melde flytting til Folkeregisteret.</p>
                    </div>
                </div>
                <div class="col-12 col-md-7 pt-4">
                    <div class="header-num">4</div> <h6>Postkasseskilt</h6>
                    <hr>
                    <div class="form-check index-step-4 ml-4 ml-md-0">
                        <input class="form-check-input" required="true" type="checkbox" value="" id="check">
                        <label class="form-check-label" for="check">
                        Jeg vil bestille nytt postkasseskilt til den nye boligen for kun kr 169,- inkl frakt
                        </label>
                    </div>
                    <a href="/receiver" class="float-right btn btn-info mt-4 mb-auto" id="submit-form">Meld flytting</a> 
                    <!-- <button class="float-right btn btn-info mt-4 mb-auto" id="submit-form" type="submit">Meld flytting</button>  -->
                </div>
            </div>
        </form>
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
                <input type="text" name="gamel-address-1" id="gamel-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly>
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="gamel-address-2-icon">
                        <i class="fa fa-map-o"></i>
                    </span>
                </div>
                <input type="text" name="gamel-address-2" id="gamel-address-2" class="form-control" placeholder="1234 Oslo" readonly>
            </div>

            <p class="sub-heading mt-4">Ny adressee</p>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="ny-address-1-icon">
                        <i class="fa fa-map-marker"></i>
                    </span>
                </div>
                <input type="text" name="ny-address-1" id="ny-address-1" class="form-control" placeholder="Eksempelgaten 10" readonly>
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="ny-address-2-icon">
                        <i class="fa fa-map-o"></i>
                    </span>
                </div>
                <input type="text" name="ny-address-2" id="ny-address-2" class="form-control" placeholder="1234 Oslo" readonly>
            </div>
            <p class="sub-heading mt-4">Hovedkontakt</p>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="hk-name-icon">
                        <i class="fa fa-user-o"></i>
                    </span>
                </div>
                <input type="text" name="hk-name" id="hk-name" class="form-control" placeholder="Tomas Ivanov" readonly>
            </div>
            <div class="input-group mt-2 group-form">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="hk-phone-icon">
                        <i class="fa fa-phone"></i>
                    </span>
                </div>
                <input type="text" name="hk-phone" id="hk-phone" class="form-control" placeholder="+47 94059094" readonly>
            </div>
        </div>
    </div>
</div>
@endsection
