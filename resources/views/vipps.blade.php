@extends('layouts.main')
@section('title', 'Vipps')
@section('content')
<script type="text/javascript">
    function validatePhone(){
        var phone = $("#phoneNumber").val();
        var validN = phone.substr(phone.length - 8);
        console.log("phone: "+validN);
        var message = "Telefonnumeret i skjemaet er feil, vennligst skriv inn riktig telefonnummer.";

        if(validN.substr(0, 1) != "4" && validN.substr(0, 1) != "9"){
            alert(message);
            valid = false;
        }else{
            valid = true;
        }

        return valid;
    }
</script>
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
<div class="row px-4 mt-0 mb-5 my-lg-5  mt-4">
    <div class="col-12 col-md-4 offset-md-4">
        <?php if(!empty(session('customer')['vipps-result'])){ ?>
            <div class="alert alert-danger mb-5" role="alert">
            {{session("customer")['vipps-result']['error']}}
            </div>
        <?php } ?>
        <div class="card shadow">
            <form action="/submitVipps" method="POST" onsubmit="return validatePhone()">
                <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                @csrf
                <div class="card-header text-center">
                    <img src="{{ asset('images/vipps.png')}}" width="50%">
                </div>
                <div class="card-body">
                    <input type="text" name="phoneNumber" class="form-control" placeholder="Telefonnummer" required="" value="" id="phoneNumber" required="true" maxlength="8" minlength="8">
                    <input type="hidden" id="isVipps">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info-100 btn-lg">Fullfør betaling</button>    
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    if(window.location.hash){
        var hash = window.location.hash;
        var number = hash.substr(1, hash.length)
        document.getElementById('phoneNumber').value = number;
        document.getElementById('isVipps').value = number;
    }else{
        window.location.href = "/profile";
    }
</script>
@endsection
