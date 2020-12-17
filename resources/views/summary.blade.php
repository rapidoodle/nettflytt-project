@extends('layouts.main')
@section('content')
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
                <sub>Boligsjekk</sub>
            </div>
            <div><hr></div>
            <div class="active">
                <span class="steps-circle">4</span>
                <sub>Oppsummering</sub>
            </div>
    </div>
</div>

<div class="row px-4 mb-5 mt-5 mt-md-0">
    <div class="col-12 col-md-8 offset-md-2 text-center">
        <h2>Oppsummering</h2>
    </div>
</div>  
<div class="row px-4 mt-0 mb-5 my-lg-5  mt-lg-0">
    <div class="col-12">
        <div class="bg-light p-4 text-center">
            <h4>Legg inn koden du fikk på SMS for å fullføre</h4>
            <input type="text" class="my-4 form-control" id="otp" placeholder="4-siffret kode">
            <div class="mb-5">
                <input class="form-check-input" required="true" type="checkbox" value="" id="check">

                <label class="form-check-label" for="check">
                Jeg aksepterer betingelsene
                </label>
                <p class="my-4 text-left text-md-center">Ved å legge inn koden og akseptere betingelsene sender vi flyttemeldingen for deg. Tjenesten koster 149,- kroner og kommer på telefonregningen din.</p>
                <div class="px-5 px-md-0">
                    <button class="btn btn-info btn-lg" id="btn-summary-send">Send flyttemeldingene</button>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="row px-4 mb-5">
    <div class="col-12 col-md-5">
        <div class="smry-rcrd p-4">
            <h3 class="mb-5"><i class="fa fa-user"></i> Personalia</h3>
            <h5>Tomas Ivanov</h5>
            <span class="text-sm-gray">Hovedperson</span>
            <span class="mt-4 text-sm-gray">E-post: tomas.k.ivanov@gmail.com</span>
            <span class="text-sm-gray">Født: 6. Oktober 1992</span>
            <hr>
            <h5>Tom Vatland</h5>
            <span class="text-sm-gray">Ekstraperson</span>
            <div class="text-right mt-5">
                <a href="/thank-you/" class="btn btn-info btn-lg btn-endre">Endre</a>
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
                <tr>
                    <td>Telenor</td>
                    <td>Tomas Ivanov</td>
                </tr>
                <tr>
                    <td>Telenor</td>
                    <td>Tomas Ivanov</td>
                </tr>
                <tr>
                    <td>Telenor</td>
                    <td>Tomas Ivanov</td>
                </tr>
                <tr>
                    <td>Telenor</td>
                    <td>Tomas Ivanov</td>
                </tr>
            </table>

            <div class="text-right mt-5">
                <a href="/thank-you/" class="btn btn-info btn-lg btn-endre">Endre</a>
            </div>
        </div>
    </div>
</div>
<div class="row px-4 mb-5">
    <div class="col-12 col-sm-6 col-md-5">
        <div class="smry-rcrd p-4">
            <h3 class="mb-5"><i class="fa fa-user"></i> Adresser</h3>
            <h5>Gammel adresse</h5>
            <span class="text-sm-gray">Adresse: Furulundvegen 29</span>
            <span class="text-sm-gray">Postnummer: 3950</span>
            <span class="text-sm-gray">Poststed: Brevik</span>
            <hr>
            <h5>Ny adresse</h5>
            <span class="text-sm-gray">Adresse: Furulundvegen 29</span>
            <span class="text-sm-gray">Postnummer: 3950</span>
            <span class="text-sm-gray">Poststed: Brevik</span>
            <div class="text-right mt-5">
               <a href="/thank-you/" class="btn btn-info btn-lg btn-endre">Endre</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-5 offset-md-2">
        <div class="smry-rcrd p-4 mt-5 mt-md-0">
            <h3 class="mb-5"><i class="fa fa-user"></i> Flyttedato</h3>

            <div class="text-right mt-5">
                <a href="/thank-you/" class="btn btn-info btn-lg btn-endre">Endre</a>
            </div>
        </div>
    </div>
</div>
<div class="row px-4 mt-0 mb-5 my-lg-5  mt-lg-0 d-md-none">
    <div class="col-12">
        <div class="bg-light p-4 text-center">
            <h4>Legg inn koden du fikk på SMS for å fullføre</h4>
            <input type="text" class="my-4 form-control" id="otp" placeholder="4-siffret kode">
            <div class="form-check mb-5">
                <input class="form-check-input" required="true" type="checkbox" value="" id="check">

                <label class="form-check-label" for="check">
                Jeg aksepterer betingelsene
                </label>
                <p class="my-4 text-left text-md-center">Ved å legge inn koden og akseptere betingelsene sender vi flyttemeldingen for deg. Tjenesten koster 149,- kroner og kommer på telefonregningen din.</p>
                <div class="px-5 px-md-0">
                    <a href="/thank-you/" class="btn btn-info btn-lg btn-endre">Endre</a>
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection
