$(document).ready(function() {
    function removePanel(){
        console.log($(this));
    }

	var fullName  = $("#full-name");
	var email 	  = $("#email");
	var phone     = $("#phone");
	var day       = $("#birth_day");
	var month     = $("#birth_month");
    var year      = $("#birth_year");
	var csrf      = $("#csrf");
	var rcvrSlct  = "";
    var rcvrDlt   = "";
    var months    = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];
    var companies = [];
	//INDEX PAGE
    $(".req-fld").keyup(function(){
        if($("#name_0").length != 0){
            if(fullName.length != 0 && email.length != 0 && phone.length != 0 && day.length != 0 && month.length != 0 && year.length != 0){
                $(".req-fld").attr("required", true);
            }else{
                $(".req-fld").removeAttr("required");
            }
        }
    });

    if($("#customer-form").length != 0){
        $(".multi-collapse").collapse();
    }

    if($(".company-list").length != 0){
        $(".company-list").each(function(ind, elem){
            companies.push($(elem).text());
        })
    }

    if($("#name_0").length != 0){
        $(".req-fld").removeAttr("required");
    }

    $("#add-name").click(function(){
        if(fullName.val() == ""  || email.val() == "" || phone.val() == "" || day.val() == null || month.val() == null || year.val() == null){
            alert("Please complete the form before adding a new name");
        }
        else{
         var pCtr   = $(".person").length;
         var newId  = Date.now();
         var html   = '<div class="card person" id="card_'+newId+'">'+
                        '<div class="p-2 pointer card-header d-flex align-items-center justify-content-between" id="'+newId+'" data-toggle="collapse" data-target="#col_'+newId+'" aria-expanded="true" aria-controls="collapseOne">'+
                            '<span>'+fullName.val()+'</span>'+
                            '<i class="fa fa-times float-right" data-id="card_'+newId+'" style="margin-top:-3px;z-index:99999999999"></i>'+
                        '</div>'+
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
            

            setTimeout(function(){
                $(".multi-collapse").collapse("show");
            }, 500);

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
        }
    });

    //confirm delete
    $("#confirm-delete").click(function(){
        var company = $(this).attr("data-parent");
        if(company){
            var val     = $(this).attr("data-value");
            $("#"+company).remove();
            companies = companies.filter(function(item) {
                return item !== val;
            })
            console.log(companies);
            updateCompanyList();
        }
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
            var eqFld = $(this).attr("data-conn");
            $("#"+eqFld).val(val);
        }

    });
    //select option
    $(".index-option").click(function(){
    	$(".index-option").removeClass("active-option");
        $(this).addClass("active-option");
    	var val = $(this).attr("data-value");
        
        $("#new_house_type").val(val);

            console.log($("#email_0").val());
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
    $(".category-item").click(function(){
    	$(".category-item").removeClass("active-option");
    	$(this).addClass("active-option");
    });

    $("#btn-go-offer").click(function(){
    	var isPowerSupplier = false;
    	var isNull 			= true;

    	$(".active-option").each(function(obj){
    		var opt = $(this).attr("data-val");
    		if(opt == "Strøm"){
    			isPowerSupplier = true;
    		}
    		isNull = false;
    	});

    	// if(isNull){
    		// alert("Please select atleast 1 service");
    	// }else{
    		if(!isPowerSupplier){
    			$(".cat-n-search, .label-none, .title-receiver").hide();
    			$(".ps-cont").show();
    		}else{
    			window.location.href = "/offers/";
    		}
    	// }
    });

    $(".select-result").click(function(){
    	rcvrSlct = "";
    	rcvrSlct = $(this).attr("data-val");
    });

    $(".select-delete").click(function(){
        rcvrDlt = "";
        rcvrDlt = $(this).attr("data-value");
        $("#company-name").html(rcvrDlt);
    });

    $("#confirm-notif").click(function(){
        if(jQuery.inArray(rcvrSlct, companies) !== -1){
            alert("Company is already in the list");
        }else{

        var newId  = Date.now();
        var html = '<tr id="comp_'+newId+'">'+
                        '<td width="10%"><i class="fas fa-check"></i></td>'+
                        '<td>'+rcvrSlct+'</td>'+
                        '<td><i class="fas fa-times pointer" data-parent="comp_'+newId+'" data-value="'+rcvrSlct+'" data-toggle="modal" data-target="#deleteModal" data-toggle="modal" data-target="#deleteModal"></i></td>'+
                    '</tr>';

        $(".default-selected").hide();
        $(".selected-list").append(html);

        //add selected company to the list
        companies.push(rcvrSlct);


        updateCompanyList();
        }
    });


    //OFFERS PAGE
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

    const myCalendar = new TavoCalendar('#my-calendar', {
         locale: "da"
      // settings here
    })

    //POSTBOX
    $(".pb-field").keyup(function(e){
    	var val = $(this).val();
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
        var finalText = allNames.replace(/,/g, ', <br>');
    	$(".postbox-summary").html(finalText);
    });

    $(".btn-legg-till").click(function(){
        var html = '<div class="text-center d-block  order-1 order-md-2"><lottie-player style="height:56px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <h6 class="mt-4">Postkasseskiltet er lagt i ordren</h6></div>';
        $(this).hide();
        $(this).parent().append(html);
    });

    //THANK YOU
    $(".btn-ty-ja").click(function(){
        var html = '<lottie-player style="height:56px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <br> <b>Takk! Vi kontakter deg snart</b>';
        $(this).hide();
        $(this).parent().append(html);
    });


    //IN FUNCTIONS
    function updateCompanyList(){
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), companies : companies },
            url: "/updateCompanyList",
            success: function(response){
                console.log(response)
            }
        });
    }
});