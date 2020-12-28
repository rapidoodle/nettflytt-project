$(document).ready(function() {
    function removePanel(){
        console.log($(this));
    }

	var fullName = $("#full-name");
	var email 	 = $("#email");
	var phone    = $("#phone");
	var day      = $("#birth_day");
	var month    = $("#birth_month");
	var year     = $("#birth_year");
	var rcvrSlct = "";
    var months   = ['Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember'];

	//INDEX PAGE
	// $(".group-form input, .add-form input, .group-form select").on("focus", function(e){
 //        $(this).parent().addClass("input-group-focus");
 //        $(this).parent().find("span.input-group-text").css("height:", "30px");
 //        $(this).css("height:", "30px");
	// }).blur(function(e){
 //        $(this).parent().removeClass("input-group-focus");
 //        $(this).parent().find("span.input-group-text").css("height:", "32px");
 //        $(this).parent().find("input.form-control").css("height:", "32px");
 //    });



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
        console.log('event triggered');
    });

    $(".card-header").on("click", function(){
        var thisid = $(this).attr("data-id");
        console.log(thisid);
        $("#"+thisid).remove();

    });
    $(document).click(function(event) {
        var thisid = $(event.target).attr("data-id");
        if(thisid){
            console.log(thisid);
            $("#"+thisid).remove();
            if($(".person").length == 0){
                $(".req-fld").attr("required", true);
            }

        }
    });
    //auto fill summary
    $(".smy-fld").keyup(function(e){
    	var val = $(this).val();
    	var eqFld = $(this).attr("data-conn");

        if($(".person").length == 0){
            $("#"+eqFld).val(val);
        }
    });
    //select option
    $(".index-option").click(function(){
    	$(".index-option").removeClass("active-option");
        $(this).addClass("active-option");
    	var val = $(this).attr("data-value");
        
        $("#new_house_type").val(val);
    });
    //submit index form 
    $("#index-form").submit(function(){
        for(var q = 0; q <= $(".person").length; q++ ){
            var name  = $("#name_"+q).val();
            var phone = $("#phone_"+q).val();
            var email = $("#email_"+q).val();
            var person = {phone: phone, name: name, email: email};
            var inp   = '<input type="hidden" name="person'+q+'" value="'+JSON.stringify(person)+'">'; 
            $(this).append(inp);
            alert(JSON.stringify(person));
        }
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
    	console.log(rcvrSlct);
    });

    $("#confirm-notif").click(function(){
    	var html = '<tr>'+
                    	'<td><i class="fas fa-check"></i></td>'+
                        '<td>'+rcvrSlct+'</td>'+
                        '<td><i class="fas fa-times"></i></td>'+
                    '</tr>';

    	$("#selected-list").append(html);
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
        allNames = allNames.toString();
        var finalText = allNames.replace(/,/g, ', <br>');
    	$(".postbox-summary").html(finalText);
    });

    //THANK YOU
    $(".btn-ty-ja").click(function(){
        var html = '<lottie-player style="height:56px" src="https://assets10.lottiefiles.com/packages/lf20_bP7KzP.json" background="transparent"  speed="1" autoplay></lottie-player> <br> <b>Takk! Vi kontakter deg snart</b>';
        $(this).hide();
        $(this).parent().append(html);
    });
});