@extends('layouts.main')
@section('content')
<!-- <?=json_encode(session('customer'));?> -->
<!-- <?=json_encode(session()->all());?> -->
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
            <div>
                <span class="steps-circle">3</span>
                <sub class="sub-3">Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div class="active">
                <span class="steps-circle">4</span>
                <sub class="sub-4">Oppsummering</sub>
            </div>
    </div>
</div>
<div class="container">
<div class="row mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Oppsummering</h2>
    </div>
</div>  
<div class="row mt-0 mb-5 my-lg-5  mt-lg-0">
    <div class="col-12">
        <div class="bg-light p-4 text-center">
            <h4>Legg inn koden du fikk på SMS for å fullføre</h4>
            <input type="text" class="my-4 form-control" id="otp" placeholder="4-siffret kode">
            <div class="mb-5">
                <p class="mb-4 text-left text-md-center">Ved å legge inn koden og akseptere <a href="/terms-of-use/" class="text-underline">betingelsene</a> sender vi flyttemeldingen for deg. Tjenesten koster 149,- kroner og kommer på telefonregningen din.</p>
                <div class="px-md-5  px-md-0 text-center">
                    <button class="btn btn-info btn-lg" id="btn-summary-send">Send flyttemeldingene</button>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-12 col-md-5">
        <div class="smry-rcrd p-4 h-auto">
            <?php
            $pbPrice    = session('customer')['pb-price'];
            $advPrice   = isset(session('customer')['isAdv']) && isset(session('customer')['adv-price']) ? session('customer')['adv-price'] : 0;
            $totalPrice = session('customer')['price'] + $pbPrice + $advPrice;
            ?>
            <input type="hidden" id="total-price" value="<?=$totalPrice?>">
            <input type="hidden" id="pb-price" value="<?=$pbPrice?>">
            <input type="hidden" id="phone" value="{{session('customer')['phone']}}">
            <table class="table">
                <thead>
                    <tr>
                        <th><b>Produkt</b></th>
                        <th><b>Pris</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Behandling av flyttemeldinger</td>
                        <td>kr 149,-</td>
                    </tr>
                    <?php if(isset(session('customer')['mailbox-sign']) && session('customer')['mailbox-sign'] == 1) { ?>
                    <tr class="tr-pb">
                        <td>Postkasseskilt</td>
                        <td><?=isset(session('customer')['pb-price']) && session('customer')['pb-price'] != 0 ? "kr ".session('customer')['pb-price'].",-" : 'GRATIS'?></td>
                        <td><i class="fa fa-trash-o pointer remove-pb" data-toggle="modal" data-target="#remove-pbModal" data-toggle="modal"></i></td>
                    </tr>
                    <?php } ?>
                    <?php if(isset(session('customer')['isAdv']) && session('customer')['isAdv'] == 1) { ?>
                    <tr class="tr-ad">
                        <td>Uadressert reklame nei takk</td>
                        <td>kr 89,-</td>
                        <td><i class="fa fa-trash-o pointer remove-ad" data-toggle="modal" data-target="#remove-adModal" data-toggle="modal"></i></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td>Totalt:</td>
                        <td>kr <span id="total-price-cont"><?=$totalPrice?></span>,-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12 col-md-5 offset-md-2">
        <?php
        $check = '<i class="fa fa-check"></i>';
        $times = '<i class="fa fa-times"></i>';
        ?>
        <div class="smry-rcrd p-4 mt-5 mt-md-0 h-auto">
            <h5>Gjennomgang av avtaler hos</h5>
            <table class="table">
                <tr>
                    <td width="30px"><?=isset(session('customer')['offers']['isStrom']) ? $check : $times; ?></td>
                    <td>Strøm</td>
                </tr>
                <tr>
                    <td><?=isset(session('customer')['offers']['isTV']) ? $check : $times; ?></td>
                    <td>TV/Internet</td>
                </tr>
                <tr>
                    <td><?=isset(session('customer')['offers']['isFlyttevask']) ? $check : $times; ?></td>
                    <td>Flyttevask</td>
                </tr>
                <tr>
                    <td><?=isset(session('customer')['offers']['isBoligalarm']) ? $check : $times; ?></td>
                    <td>Boligalarm</td>
                </tr>
            </table>
        </div> 
    </div>
</div>
<div class="row mb-5">
    <div class="col-12 col-md-5">
        <div class="smry-rcrd p-4">
            <h3 class="mb-5"><i class="fa fa-user"></i> Personalia</h3>
            <h5 class="disp-field"><span data-parent="person0-name"><?=session('customer')['person0']['name']?></span></h5>
            <span class="text-sm-gray">Hovedperson</span>
            <span class="mt-4 text-sm-gray disp-field">E-post: <span data-parent="person0-email"><?=session('customer')['person0']['email']?></span></span>
            <span class="text-sm-gray disp-field">Født: <span data-parent="person0-bday"><?=session('customer')['person0']['bday']?></span></span>

            <?php if(session('customer')['totalPerson'] > 1){ ?>
            <hr>
            <h5>Andre personer i hustanden</h5>
            <?php for($i=1; $i < session('customer')['totalPerson']; $i++){ ?>
            <h5 class="disp-field"><span data-parent="person{{$i}}-name"><?=session('customer')['person'.$i]['name'];?></span></h5>
            <?php } } ?>
            <div class="text-right mt-5">
               <button class="btn btn-info btn-lg btn-endre" data-toggle="modal" data-target="#personEditModal" data-toggle="modal">Endre</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5 offset-md-2">
        <div class="smry-rcrd p-4 mt-5 mt-md-0">
            <h3 class="mb-5"><i class="fa fa-envelope"></i> Mottakere</h3>
            <table width="100%" class="tbl-summary">
                <tr>
                    <th><h5>Selskap</h5></th>
                    <th><h5>Navn</h5></th>
                </tr>
                <?php if(session('customer')){

                    foreach(session('customer')['services'] as $key => $service){
                        $newId = time(); 
                     ?>
                <tr id="comp_{{$key}}{{$newId}}">
                    <td class="company-list"><?=$service[0]?></td>
                    <td><?php
                    $people = explode(",", $service[2]);
                    $names  = "";

                    if(count($people) > 1){
                        foreach ($people as $person) {
                            $names .= session('customer')[$person]['name'].", ";
                        }
                        echo $names = rtrim($names, ", ");
                    }else{
                        echo session('customer')[$service[2]]['name'];
                    }
                    ?></td>
                    <td> <i class="fas fa-times pointer company-list" data-parent="comp_{{$key}}{{$newId}}" data-value="{{$service[0]}}" data-company-number="{{$service[1]}}" data-company-people="{{$service[2]}}" data-toggle="modal" data-target="#deleteModal" data-toggle="modal" data-target="#deleteModal"></i></td>
                </tr>
            <?php } }else{ ?> 
                <tr>
                    <td colspan="2" align="center">No selected companies</td>
                </tr>

            <?php } ?>
            </table>
        </div>
    </div>
</div>
<div class="row mb-5">
    <div class="col-12 col-sm-6 col-md-5">
        <div class="smry-rcrd p-4">
            <h3 class="mb-5"><i class="fa fa-user"></i> Adresser</h3>
            <h5>Gammel adresse</h5>
            <span class="text-sm-gray">Adresse: <span data-parent="old_address"><?=session('customer')['old_address']?></span></span>
            <span class="text-sm-gray">Postnummer: <span data-parent="old_zipcode"><?=session('customer')['old_zipcode']?></span></span>
            <span class="text-sm-gray">Poststed: <span data-parent="old_place"><?=session('customer')['old_place']?></span></span>
            <hr>
            <h5>Ny adresse</h5>
            <span class="text-sm-gray">Adresse: <span data-parent="new_address"><?=session('customer')['new_address']?></span></span>
            <span class="text-sm-gray">Postnummer: <span data-parent="new_zipcode"><?=session('customer')['new_zipcode']?></span></span>
            <span class="text-sm-gray">Poststed: <span data-parent="new_place"><?=session('customer')['new_place']?></span></span>
            <div class="text-right mt-5">
               <button class="btn btn-info btn-lg btn-endre" data-toggle="modal" data-target="#addressEditModal" data-toggle="modal">Endre</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-5 offset-md-2">
        <div class="smry-rcrd p-4 mt-5 mt-md-0">
            <h3 class="mb-5"><i class="fa fa-user"></i> Flyttedato</h3>
            <input type="hidden" id="moving-date" value="<?=session('customer')['moving_date_year']?>-<?=session('customer')['moving_date_month']?>-<?=session('customer')['moving_date_day']?>">
            <div id="my-calendar"></div>
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

<!--CONFIRMATION DELETE PB MODAL-->
<div class="modal fade" id="remove-pbModal" tabindex="-1" role="dialog" aria-labelledby="remove-pbModal" aria-hidden="true">
  <div class="text-center modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body mt-4">
        <div class="text-center mb-4">
            <h5 class="modal-title">Are you sure you want to delete Postbox subscription?</h5>            
        </div>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="remove-pb">Ja</button>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Nei</button>
      </div>
    </div>
  </div>
</div>

<!--CONFIRMATION DELETE AD MODAL-->
<div class="modal fade" id="remove-adModal" tabindex="-1" role="dialog" aria-labelledby="remove-adModal" aria-hidden="true">
  <div class="text-center modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body mt-4">
        <div class="text-center mb-4">
            <h5 class="modal-title">Are you sure you want to delete *AD REMOVAL?</h5>            
        </div>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="remove-ad">Ja</button>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Nei</button>
      </div>
    </div>
  </div>
</div>

<!--MOVING DATE-->
<div class="modal fade" id="confirmMove" tabindex="-1" role="dialog" aria-labelledby="confirmMoveLabel" aria-hidden="true">
  <div class="text-center modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body mt-4">
        <div class="text-center mb-4">
            <h5 class="modal-title">Er du sikker på at du vil flytte datoen fra <span id="date-from"></span> til <span id="date-to"></span>?</h5>            
        </div>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="confirm-move">Ja</button>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Nei</button>
      </div>
    </div>
  </div>
</div>
<!--EDIT CUSTOMERS-->
<div class="modal fade" id="personEditModal" tabindex="-1" role="dialog" aria-labelledby="personEditModalLabel" aria-hidden="true">
  <div class="text-left modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header text-left">
            <h5 class="modal-title"><i class="fa fa-user"></i> Personalia</h3></h5>      
        </div>
        <div class="modal-body">
            <h5>Hovedperson</h5>
            <table class="w-100">
                <tr>
                    <td>Name</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person0']['name']?>" id="person0-name"></td>
                </tr>
                <tr>
                    <td>E-post</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person0']['email']?>" id="person0-email"></td>
                </tr>
                <tr>
                    <td>Telefonnummer</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person0']['phone']?>" id="person0-phone"></td>
                </tr>
                <tr>
                    <td>Fødselsdato</td>
                    <td><input type="date" class="person-input cust-field" value="<?=session('customer')['person0']['bday']?>" id="person0-bday"></td>
                </tr>
            </table>
            <?php if(session('customer')['totalPerson'] > 1){ ?>
            <hr>
            <h5>Extraperson</h5>
            <?php for($i=1; $i < session('customer')['totalPerson']; $i++){ ?>
            <table class="w-100 mb-3">
                <tr>
                    <td>Name</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person'.$i]['name']?>" id="person<?=$i?>-name"></td>
                </tr>
                <tr>
                    <td>E-post</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person'.$i]['email']?>" id="person<?=$i?>-email"></td>
                </tr>
                <tr>
                    <td>Telefonnummer</td>
                    <td><input type="text" class="person-input cust-field" value="<?=session('customer')['person'.$i]['phone']?>" id="person<?=$i?>-phone"></td>
                </tr>
                <tr>
                    <td>Fødselsdato</td>
                    <td><input type="date" class="person-input cust-field" value="<?=session('customer')['person'.$i]['bday']?>" id="person<?=$i?>-bday"></td>
                </tr>
            </table>
            <?php } } ?>

        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="save-people">Lagre</button>
        <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Avbryt</button>
        </div>
    </div>
  </div>
</div>

<!--EDIT ADDRESS-->
<div class="modal fade" id="addressEditModal" tabindex="-1" role="dialog" aria-labelledby="addressEditModalLabel" aria-hidden="true">
  <div class="text-left modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header text-left">
            <h5 class="modal-title"><i class="fa fa-user"></i> Adresser</h5>      
        </div>
        <div class="modal-body">
            <h5>Gammel address</h5>
            <table class="w-100">
                <tr>
                    <td>Adresse</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['old_address']?>" id="old_address"></td>
                </tr>
                <tr>
                    <td>Postnummer</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['old_zipcode']?>" id="old_zipcode"></td>
                </tr>
                <tr>
                    <td>Poststed</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['old_place']?>" id="old_place"></td>
                </tr>
            </table>
            <hr>
            <h5>Ny address</h5>
            <table class="w-100">
                <tr>
                    <td>Adresse</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['new_address']?>" id="new_address"></td>
                </tr>
                <tr>
                    <td>Postnummer</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['new_zipcode']?>" id="new_zipcode"></td>
                </tr>
                <tr>
                    <td>Poststed</td>
                    <td><input type="text" class="person-input address-field" value="<?=session('customer')['new_place']?>" id="new_place"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal" id="save-address">Lagre</button>
            <button type="button" class="btn btn-info mb-4" data-dismiss="modal">Avbryt</button>
        </div>
    </div>
  </div>
</div>



<!--OTP-->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
  <div class="text-left modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header text-left">
            <h5 class="modal-title">Behandler..</h5>      
        </div>
        <div class="modal-body text-center my-4">
            <h3 id="otpCountdown"></h3>
        </div>
        <div class="modal-footer otpFooter">
            <button type="button" class="btn btn-info mb-4 btn-send-vipps" data-dismiss="modal">Send Via Vipps</button>
        </div>
  </div>
</div>
@endsection
