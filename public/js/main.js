$(document).ready(function() {


    var fullName        = $("#full-name");
    var email           = $("#email");
    var phone           = $("#phone");
    var day             = $("#birth_day");
    var month           = $("#birth_month");
    var year            = $("#birth_year");
    var csrf            = $("#csrf");
    var rcvrSlct        = "";
    var rcvrNum         = "";
    var rcvrDlt         = "";
    var months          = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];
    var companies       = [];
    var searchComp      = $("#receiver-search-input");
    var globalAllNames  = [];
    var movingDate      = $("#moving-date");
    var isPowerSupplier = false;
    var companyNumbers  = [];
    var otpInterval     = "";
    var otpTimeout      = 1000;
    var otpConfirmed    = false;
    var otpProcessing   = false;
    var checkIcon       = "<i class='fa fa-check text-success'></i>";
    var timesIcon       = "<i class='fa fa-times text-danger'></i>";
    //INDEX PAGE

    $(".save-person-collapse-cont").hide();
    $(".req-fld").keyup(function(){
        if($("#name_0").length != 0){
            if(fullName.val() != "" || email.val() != "" || phone.val() != "" || day.val() != null || month.val() != null || year.val() != null){
                $(".req-fld").attr("required", true);
                $("#isReq").val("1");
                $(".save-person-collapse-cont").show();
            }else{
                $(".req-fld").removeAttr("required");
                $("#isReq").val("0");
                $(".save-person-collapse-cont").hide();
            }
        }
    });
    
    $(".clear-form").click(function(){
        $(".main-field").val('');
        $("#isReq").val("0");
        $(".req-fld").removeAttr("required");
    });

    if($("#customer-form").length != 0){
        $(".multi-collapse").collapse();
    }

    if($(".cl").length != 0){
        $(".cl").each(function(ind, elem){
            companies.push($(elem).text());
        })
    }

    if($("#name_0").length != 0){
        $(".req-fld").removeAttr("required");
    }

    $("#add-name").click(function(){
        if($(".multi-collapse.collapse.show").length != 0){
            addName(true);
        }else{
            $(".multi-collapse").collapse("show");
        }
    });

    $(".save-person-collapse").click(function(){
        addName(false);
    });

    $(document).on('show.bs.collapse hide.bs.collapse', '.multi-collapse', function(e) {
        e.stopPropagation();
    });

    $(".card-header").on("click", function(){
        var thisid = $(this).attr("data-id");
        $("#"+thisid).remove();

    });

    $(document).click(function(event) {
        //removing person
        var thisid  = $(event.target).attr("data-id");
        if(thisid){
            $("#"+thisid).remove();
            if($(".person").length == 0){
                $(".req-fld").attr("required", true);
            }
        }

        //removing company
        var company = $(event.target).attr("data-parent");
        if(company){
            var val     = $(event.target).attr("data-value");

            $("#confirm-delete").attr("data-parent", company);
            $("#confirm-delete").attr("data-value", val);

            $("#company-name").html(val);
            rcvrSlct = 0;
        }

        var searchBtn = $(event.target).attr("data-company-name");
        if(searchBtn){
            //unselect the checkbox in modal
            $('.person-list').prop('checked', false);
            var companyName   = $(event.target).attr("data-company-name");
            var companyNumber = $(event.target).attr("data-company-number");
            var isPS          = $(event.target).attr("data-ispowersupplier") === "true" ? "|ps" : "";
            console.log("isPS: "+isPS);
            rcvrSlct = "";
            rcvrSlct = companyName+"|"+companyNumber+isPS;

            //check the selected person
            if($("i[data-value='"+companyName+"']").length > 0){
                var people = $("i[data-value='"+companyName+"']").attr("data-company-people");
                people = people.split(",");

                people.forEach(function(data){
                    $("#"+data).prop("checked", "true");
                })
            }
        }

        var company = $(event.target).attr("data-company");
        //delete company in summary

        var isCompany = $(event.target).attr("data-type");
        
        if(isCompany && isCompany == "companyList"){
            var companyName = $(event.target).attr("data-company-name");
            $(".option-modal-title").html(companyName);
        }
    });

    //confirm delete
    $("#confirm-delete").click(function(){
        var company = $(this).attr("data-parent");
        if($("#"+company).children().eq(1).text() == "NorgesEnergi AS"){
            updateCustomerData({"isNorges" : 0});
        }
        $("#"+company).remove();
        updateCompanyList();

    });

    //auto fill summary
    $(".smy-fld").keyup(function(e){
        var val = $(this).val();
        
        if($(this).attr("id") == "old_zipcode"){
            $("#gamel-address-2").val($(this).val()+" "+$("#old_place").val());
        }else if($(this).attr("id") == "old_place"){
            $("#gamel-address-2").val($("#old_zipcode").val()+" "+$(this).val());
        }else if($(this).attr("id") == "new_zipcode"){
            $("#ny-address-2").val($("#new_zipcode").val()+" "+$(this).val());
        }else if($(this).attr("id") == "new_place"){
            $("#ny-address-2").val($("#new_zipcode").val()+" "+$(this).val());
        }else{
            if($(".person").length == 0){
                var eqFld = $(this).attr("data-conn");
                $("#"+eqFld).val(val);            
            }
        }

    });
    //select option
    $(".index-option").click(function(){
        console.log($(this).text());
        $(".index-option").removeClass("active-option");
        $(this).addClass("active-option");
        var val = $(this).attr("data-value");
        
        $("#new_house_type").val(val);
    });
    //submit index form 
    $("#index-form").submit(function(){
        var people = "";
        for(var q = 0; q < $(".person").length; q++ ){
            var nameA   = $("#name_"+q).val();
            var phoneA  = $("#phone_"+q).val();
            var emailA  = $("#email_"+q).val();
            var bdayA   = $("#bday_"+q).val();
            var person  = nameA+"|"+phoneA+"|"+emailA+"|"+bdayA;
            people += person+"---";
        }

        if($("#name_0").length != 0){
            var bday_arr = $("#bday_0").val().split("-");
            var newAdd = $(".person").length + 1;      
            var extraPerson = fullName.val()+"|"+phone.val()+"|"+email.val()+"|"+year.val()+'-'+month.val()+'-'+day.val();
            people += extraPerson+"---";
        }


        var inp     = '<input type="hidden" name="people" value="'+people+'">'; 
        $(this).append(inp);
    });


    //RECEIVER'S PAGE
    $(".bolig-menu a").click(function(){
        var val = $(this).attr("data-val");
        $(".annet-options").attr("data-value", val);
        $(".annet-options").text($(this).text());
        $("#new_house_type").val(val);
    });

    $("#company-search").click(function(){
        var val = searchComp.val();
        $(".search-no-result").hide();
        if(val.length > 1){
            var html = '<tr class="item"><td align="center">Laster selskaper..</td></tr>';
            $(".receiver-search-result").html(html);
            $(".receiver-search-result").show();
            searchCompany(val, "orgnr");
        }
    })
    $("#receiver-search-input").on('keypress',function(e) {
        if($(this).val().length > 1){
            if(e.which == 13) {
                var val = searchComp.val();
                $(".search-no-result").hide();
                if(val.length > 1){
                    var html = '<tr class="item"><td align="center">Laster selskaper..</td></tr>';
                    $(".receiver-search-result").html(html);
                    $(".receiver-search-result").show();
                    searchCompany(val, "orgnr");
                }
            }
        }
    });

    if($("#company-search").length > 0){
        loadingCompanies();
        searchCompany("Ofte brukte", "categories");
    }

    $(".category-item").click(function(){
        $(".category-item").removeClass("active-option");
        $(this).addClass("active-option");
        
        if($("#company-search").length > 0){
            loadingCompanies();
            var catSearch = $(this).attr("data-cat");
            searchCompany(catSearch, "categories");
        }
    });
    $("#btn-add-postbox").click(function(){
        updateCustomerData({"isNorges" : 1, "pb-price": 0, "mailbox-sign" : 1});

        sendSMS(2, false);
    });

    $(".btn-postbox").click(function(){
        updateCustomerData({"mailbox-sign" : 1, "pb-price" : 149});
    });

    $(".btn-adv").click(function(){
        updateCustomerData({"isAdv" : 1, "adv-price" : 89});
    });

    $(".btn-go-power").click(function(){
        var type = $(this).attr("data-type");
        sendSMS(type, true);
        // window.location.href = "/offers/";
    });

    $("#btn-go-offer").click(function(){
        var isNorges = false;
        var isPowerSupplier;
        $(".cl").each(function(ind, elem){
            companies.push($(elem).text());
            if($(elem).text() == "NorgesEnergi AS"){
                isNorges = true;
            }
        });

        //  || $("i[data-isps='true']").length > 0

        if(isNorges == true || $(this).attr("data-isnorges") == 1 || $(this).attr("data-action") == "go"){
            window.location.href = "/boligsjekk/";
        }else if( $("i[data-isps='true']").length > 0){
            $("#receiver-main-section, .title-receiver").hide();
                $(".ps-cont").show();
        }else{
            loadingCompanies();
            searchCompany("strÃ¸m", "categories");
            if($(".cl").length == 0){
                $(".category-item").removeClass("active-option");
                $(".category-item[data-cat='strÃ¸m']").addClass("active-option");
            }
            if(!isPowerSupplier){
                $(".cat-n-search, .label-none, .title-receiver").hide();
                $(".ps-cont").show();
                isPowerSupplier = true;
            }else{
                window.location.href = "/boligsjekk/";
            }
        }

        //if they click once, the next click should move to offers page
        $(this).attr("data-action", "go");
    });

    $("#confirm-notif").click(function(){
        var personForCompany = [];
        $("input:checked").each(function (i, ob) {
            if(!jQuery.inArray($(ob).val(), personForCompany) !== -1){
                personForCompany.push($(ob).val());
            }
        });
        var rcvrData        = rcvrSlct.split("|");
        var companyName     = rcvrData[0];
        var companyNumber   = rcvrData[1];
        var isPS            = rcvrData[2] == 'ps' ? "data-isPS='true'" : '';
        var companyPeople   = personForCompany.length == 0 ? "person0" : personForCompany;
        var newId           = Date.now();
        var html            = '<tr id="comp_'+newId+'">'+
                                '<td width="10%"><i class="fas fa-check"></i></td>'+
                                '<td '+isPS+' class="cl">'+companyName+'</td>'+
                                '<td><i class="fas fa-times pointer company-list" data-company-people="'+companyPeople+'" data-parent="comp_'+newId+'" data-value="'+companyName+'" data-company-number="'+companyNumber+'" data-toggle="modal" data-target="#deleteModal" data-toggle="modal" data-target="#deleteModal" '+isPS+'></i></td>'+
                              '</tr>';

        $(".default-selected").hide();

        if($("i[data-value='"+companyName+"']").length > 0){
            //if company is already in the list, update the selected person;
            $("i[data-value='"+companyName+"']").attr("data-company-people", companyPeople);
        }else{
            $(".selected-list").append(html);
            //update the services in backend
            updateCompanyList();
        }

        //if norges is selected from the list
        if(companyName == "NorgesEnergi AS"){
            updateCustomerData({"isNorges" : 1});
        }
    });


    //OFFERS PAGE

    $("#btn-go-postbox").click(function(){
        // alert($("a.btn-actions:visible").length);
        alert("Venligst svar JA eller NEI for kategoriene i boligsjekken");
    });

    $('#offersAcdn').collapse({
      toggle: false
    });

    $('#offersAcdn').on('shown.bs.collapse', function () {
      var header = $("div.collapse.show").attr("aria-labelledby");
      $("#"+header).addClass("active");
    })
    
    $('#offersAcdn').on('hidden.bs.collapse', function () {
      var prev = $("div.card-header.active").removeClass("active");
    })

    $(".btn-offer").click(function(){
        console.log($(this).attr("data-offer"));
        var fields = {};
        fields["offers."+$(this).attr("data-offer")] = 1;

        updateCustomerData(fields);
    });


    //POSTBOX
    if($(".pb-field").length > 0){
        postboxNames();
    }
    $(".pb-field").keyup(function(e){
        postboxNames();
    });

    $(".pb-address").click(function(){
        var names = $(".postbox-summary").html().replace(/\<br>/g, ',');
        console.log(names);
        updateCustomerData({"postbox.address" : $('input[name="radios"]:checked').val(), "postbox.names" : names});
        window.location.href = "/oppsummering/";
    });

    $(".btn-legg-till").click(function(){
        var html = '<div class="text-right d-block  order-1 order-md-2 lottie-1" style="width:177px"><lottie-player style="height:30px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <h6 class="mt-2 mb-0 text-center">Postkasseskiltet er lagt til</h6></div>';
        $(this).hide();
        $(this).parent().append(html);
    });

    $(".btn-show-lott").click(function(){
        var html = '<div class="text-right d-block  order-1 order-md-2" style="width:177px"><lottie-player style="height:30px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <h6 class="mt-2 mb-0 text-center">Postkasseskiltet er lagt til</h6></div>';
        var html2 = 'Tusen takk. Når du svarer “JA” på SMSen sender vi deg et gratis postkasseskilt.'+
                    '<div style="color: red;">NB! Du må fylle inn navnene på postkasseskiltet før du klikker videre på denne siden!</div>';
        $(".btn-legg-till").hide();
        $(".lottie-1").remove();
        $(".btn-legg-till").parent().append(html);
        $("h6.sub-1").remove();
        $(".post-warn").show();

        $(".btn-next-summary").attr("data-power", true);
    });

    $(".btn-next-summary").click(function(){
        console.log($(this).attr("data-power"));
        $('#addressModal').modal('toggle');
    })

    $(".continue-summary").click(function(){
        window.location.href = "/oppsummering/";
    });

    $(".btn-legg-till-2").click(function(){
        var html = '<div class="text-right d-block  order-1 order-md-2" style="width:135px;"><lottie-player style="height:30px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <h6 class="text-center mt-2 mb-0">Skiltet er lagt til</h6></div>';
        $(this).hide();
        $(this).parent().append(html);
    });

    //THANK YOU
    $(".btn-ty-ja").click(function(){
        var html = '<lottie-player style="height:56px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <br> <b>Takk! Vi kontakter deg snart</b>';
        $(this).hide();
        $(this).parent().append(html);
    });

    //SUMMARY
    $(".otpFooter").hide();
    $('#otpModal').on('hidden.bs.modal', function (e) {
        loadingProgress(0, true);
    });
    $("#btn-summary-send").click(function(){
        $('#otpModal').modal('toggle');
        var otp = $("#otp").val();
        $("#otpCountdown").html();  
        if(otp.length > 3){
            $('#otpModal').modal('toggle');
            var ctr = 3;
            var sumInterval = setInterval(function(){

                if(ctr == 3){
                    loadingProgress(1);
                }
                if(ctr == 2){
                    loadingProgress(2);
                    confirmOtp();
                    clearInterval(sumInterval);
                }
                ctr--;
                console.log(ctr);
            }, 3000);
        }else{
            alert("Koden du tastet inn var feil. Vennligst prøv igjen");
        }
    });

    $("#remove-pb").click(function(){
        $(".tr-pb").remove();
        updateCustomerData({"mailbox-sign" : 0, "pb-price" : 0});
        var newPrice = $("#total-price").val() - $("#pb-price").val();
        $("#total-price").val(newPrice);
    });
    $("#remove-ad").click(function(){
        $(".tr-ad").remove();
        updateCustomerData({"isAdv" : 0, "adv-price" : 0});
        var newPrice = $("#total-price").val() - 89;
        $("#total-price").val(newPrice);

        $("#total-price-cont").html(newPrice);
    });

    const myCalendar = new TavoCalendar('#my-calendar', {
        locale: "da",
        date: movingDate.val(),
        selected: [movingDate.val()],
        past_select: true,
    })

    const calendar2 = document.querySelector('#my-calendar');
    if(calendar2){
        calendar2.addEventListener('calendar-select', (ev) => {

            $("#date-from").html(movingDate.val());
            $("#date-to").html(myCalendar.getSelected());
            $('#confirmMove').modal('toggle')

        });
    }

    $("#confirm-move").click(function(){
        var date = myCalendar.getSelected();
        var dates = date.split("-");
        var fields = {moving_date_year : dates[0], moving_date_month : dates[1], moving_date_day : dates[2]};
        updateCustomerData(fields);
    });

    $("#save-address").click(function(){
        var fields = {}
        $(".address-field").each(function(i, obj){
            fields[$(obj).attr("id")] = $(obj).val();

            $("span[data-parent='"+$(obj).attr("id")+"']").html($(obj).val());
        });
        updateCustomerData(fields);
    });


    $("#save-people").click(function(){
        var fields = {}
        $(".cust-field").each(function(i, obj){
            fields[$(obj).attr("id")] = $(obj).val();
            $("span[data-parent='"+$(obj).attr("id")+"']").html($(obj).val());
        });
        updateCustomerData(fields);
    });

    //CONTACT US
    $(".btn-contact").click(function(){
        var from = $(this).attr("data-from");
        var next = $(this).attr("data-next");

        $("#"+from).hide();
        $("#"+next).fadeIn();
    });

    //IN FUNCTIONS
    function updateCompanyList(){
        var services = [];
        
        //get the updated company list to update services
        $(".company-list").each(function(i, obj){
            var companyName   = $(obj).attr("data-value");
            var companyNumber = $(obj).attr("data-company-number");
            var companyPeople = $(obj).attr("data-company-people");
            var isPS          = $(obj).attr("data-isps");
            console.log($(obj).attr("data-isps"));
            var compObj       = [companyName, companyNumber, companyPeople];
            
            if(isPS == "true"){
                compObj.push("isps");
            }
            services.push(compObj);
        });

        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), services : services},
            url: "/updateCompanyList",
            success: function(response){
                if($(".company-list").length == 0){
                    var nolist = '<tr class="default-selected"><td align="center">Vennligst velg et selskap</td></tr>';
                    $(".selected-list").append(nolist);
                }
            }
        });
    }

    function confirmOtp(){
        otpProcessing = true;
        var otp           = $("#otp").val();
        var otpTimeoutSec = 15;
        console.log(phone);
        var newPhone = phone.val().substr(0,1) == "+" ? phone.val().substr(3, phone.val().length) : phone.val().substr(2,phone.val().length);
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), otp : otp},
            url: "/confirmOtp",
            success: function(response){
                var obj = JSON.parse(response);
                loadingProgress(3);
                if(obj.status == 0 && obj.strex_resultcode == "Ok"){
                    loadingProgress(4);
                    clearInterval(otpInterval);
                    $("#otpModal").toggle();
                    window.location.href = "/takk";
                }else if(obj.status == 0 && obj.strex_resultcode == "Failed" && obj.strex_detailedstatuscode == "OneTimePasswordFailed"){
                    $("#tbl-loading tr:nth-child(4) td:nth-child(2) span").html("Koden du tastet inn var feil. Vennligst prøv igjen");

                    failedProgress();
                }else if(obj.status == 530){
                    // $("#otpCountdown").html("Payment failed. Attempting another payment method..");
                            window.location.href = "https://nettflytt.no/betaling/#"+newPhone;
                }else if(obj.status == 0 && obj.strex_resultcode == "Queued"){
                    otpInterval = setInterval(function(){
                        if(otpProcessing == false){
                            otpProcessing = true;
                            console.log("Checking payment status again..");
                            $.ajax({
                                type: "POST",
                                data: { _token : csrf.val()},
                                url: "/getOtpStatus",
                                success: function(response){
                                    otpProcessing == false;
                                    if(response.status == 0 && response.strex_resultcode == "Ok"){
                                        // $("#otpCountdown").html("Suksess!");
                                        clearInterval(otpInterval);
                                        loadingProgress(4);
                                        $("#otpModal").toggle();
                                        window.location.href = "/takk";
                                    }
                                }
                            });
                        }
                        otpTimeoutSec--;
                        if(otpTimeoutSec == 0){
                            // $("#otpCountdown").html("Payment failed. Attempting another payment method..");
                            clearInterval(otpInterval);
                            window.location.href = "https://nettflytt.no/betaling/#"+newPhone;
                        }

                        // $("#otpCountdown").html(otpTimeoutSec);
                    }, otpTimeout);
                }else{
                    // $("#otpCountdown").html("Payment failed. Attempting another payment method..");
                    clearInterval(otpInterval);
                    window.location.href = "https://nettflytt.no/betaling/#"+newPhone;
                }
                //otp processing is done, can check again if failed.
                otpProcessing = false;
            }
        });
    }

    function updateCustomerData(data){
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), fields : data},
            url: "/updateCustomerData",
            success: function(response){
                console.log(response);
            }
        });
    }

    function sendSMS(type, isUpdate){
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), type: type},
            url: "/sendSMS",
            success: function(response){
                if(isUpdate){
                    updateCustomerData({"isNorges" : 1});
                }
            }
        });
    }

    function searchCompany(query, cat){
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), query : query, cat : cat},
            url: "/searchCompany",
            success: function(response){
                var obj = JSON.parse(response);
                var html = "";
                if(obj.length > 0){
                    for(var q = 0; q < obj.length; q++){
                        var org = obj[q];
                        var isPowerSupplier = query == "strÃ¸m" ? " data-ispowersupplier='true'" : "";

                        if(!companyNumbers.includes(org.orgnr)){
                            html += '<tr class="item">'+
                            '<td>'+org.name+
                                '<button class="float-right btn btn-info btn-company-option" data-type="companyList" data-toggle="modal" data-target="#optionModal" data-company-name="'+org.name+'" data-company-number="'+org.orgnr+'" '+isPowerSupplier+'>Legg til</button>'+
                            '</td>'+
                            '</tr>';
                            companyNumbers.push(org.orgnr);
                        }
                    }
                    $(".receiver-search-result").show();
                    $(".search-no-result").hide();
                }else{
                    $(".receiver-search-result").hide();
                    $(".search-no-result").show();
                }

                $(".receiver-search-result").html(html);
                if(obj.length > 10){
                    $('.pagination').rpmPagination({
                      domElement:'.item',
                      total: obj.length
                    });
                }else{
                    $(".pagination").html("");
                }

                companyNumbers = [];
            }
        });
    }

    function loadingCompanies(){
        var html = '<tr class="item"><td align="center">Laster selskaper..</td></tr>';
        $(".receiver-search-result").html(html);
    }

    function postboxNames(){
        var allNames = [];
        if($("#rad1").val() != ""){
            allNames.push($("#rad1").val());
        }
        if($("#rad2").val() != ""){
            allNames.push($("#rad2").val());
        }
        if($("#rad3").val() != ""){
            allNames.push($("#rad3").val());
        }
        if($("#rad4").val() != ""){
            allNames.push($("#rad4").val());
        }
        if($("#rad5").val() != ""){
            allNames.push($("#rad5").val());
        }
        allNames = allNames.toString();
        var finalText = allNames.replace(/,/g, '<br>');
        $(".postbox-summary").html(finalText);

        globalAllNames = allNames;
    }

    function addName(collapse = true){
        if(fullName.val() == ""  || email.val() == "" || phone.val() == "" || day.val() == null || month.val() == null || year.val() == null){
            alert("Fyll ut skjemaet før du legger til et nytt navn.");
        }
        else{
         var pCtr   = $(".person").length;
         var newId  = Date.now();
         var type   = pCtr == 0 ? "(hovedperson)" : "(ekstraperson)";
         var html   = '<div class="card person" id="card_'+newId+'">'+
                        '<div class="p-2 pointer card-header d-flex align-items-center justify-content-between" id="'+newId+'" data-toggle="collapse" data-target="#col_'+newId+'" aria-expanded="true" aria-controls="collapseOne">'+
                            '<span>'+fullName.val()+' '+type+'</span>';
                            if(pCtr != 0){
                                html += '<i class="fa fa-times float-right" data-id="card_'+newId+'" style="margin-top:-3px;z-index:99999999999"></i>';
                            }
                    html += '</div>'+
                        '<div id="col_'+newId+'" class="collapse" aria-labelledby="'+newId+'" data-parent="#extra-names">'+
                            '<div class="bg-white card-body">'+
                                '<table class="w-100">'+
                                    '<tr>'+
                                        '<td>Full name</td>'+
                                        '<td><input type="text" class="person-input" value="'+fullName.val()+'" id="name_'+pCtr+'"></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>E-post</td>'+
                                        '<td><input type="text" class="person-input" value="'+email.val()+'" id="email_'+pCtr+'"></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Telefonnummer</td>'+
                                        '<td><input type="text" class="person-input" value="'+phone.val()+'" id="phone_'+pCtr+'"></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td>Fødselsdato</td>'+
                                         '<td><input type="date" class="person-input" value="'+year.val()+'-'+month.val()+'-'+day.val()+'" id="bday_'+pCtr+'"></td>'+
                                        // '<td><input type="date" class="person-input" value="2020-10-10" id="bday_'+pCtr+'"></td>'+
                                    '</tr>'+
                                '</table>'+
                            '</div>'+
                        '</div>';
            $("#extra-names").append(html);

            $('.collapse').collapse({
             toggle: false
            });

            $(".multi-collapse").collapse("hide")
            $(".multi-collapse").clone(true).insertAfter("div#customer-form:last");
            
            if(collapse){
                setTimeout(function(){
                    $(".multi-collapse").collapse("show");
                }, 500);
            }

            $(".multi-collapse")[1].remove();       

            fullName.val("");
            email.val("");
            phone.val("");
            day.val("");
            month.val("");
            year.val("");    

            //REMOVE REQUIRED FIELD TO PERSONAL INFORMATION IF FIRST PERSON IS ADDED
            $(".req-fld").removeAttr("required");
        }
    }

    function failedProgress(){
        $("#tbl-loading tr:nth-child(3) td:nth-child(1) i").remove();
        $("#tbl-loading tr:nth-child(3) td:nth-child(1) > div.spinner-border, #tbl-loading tr:nth-child(4) td:nth-child(1) > div.spinner-border").hide();
        $("#tbl-loading tr:nth-child(3) td:nth-child(1), #tbl-loading tr:nth-child(4) td:nth-child(1)").append(timesIcon);
        $("#tbl-loading tr:nth-child(3) td:nth-child(2) span, #tbl-loading tr:nth-child(4) td:nth-child(2) span").addClass("text-danger");
    }

    function loadingProgress(pos, reset = false){
        if(!reset){
            $("#tbl-loading tr:nth-child("+pos+") td:nth-child(1) > div.spinner-border").hide();
            $("#tbl-loading tr:nth-child("+pos+") td:nth-child(1)").append(checkIcon);
            $("#tbl-loading tr:nth-child("+pos+") td:nth-child(2) span").addClass("text-success");
        }else{
            $("#tbl-loading span").removeClass("text-success");
            $("#tbl-loading span").removeClass("text-danger");
            $("#tbl-loading tr td > div.spinner-border").show();
            $("#tbl-loading tr td i").remove();
            $("#tbl-loading tr:nth-child(4) td:nth-child(2) span").html("Fullfører");

        }
    }
});