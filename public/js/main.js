$(document).ready(function() {
	var fullName = $("#full-name");
	var email 	 = $("#email");
	var phone    = $("#phone");
	var day      = $("#day");
	var month    = $("#month");
	var year     = $("#year");

	var rcvrSlct = "";

	//INDEX PAGE
	$(".group-form input, .add-form input, .group-form select").on("focus", function(e){
        $(this).parent().addClass("input-group-focus");
	}).blur(function(e){
        $(this).parent().removeClass("input-group-focus");
    });

    $("#add-name").click(function(){
		var html 	 = '<div class="mb-2 input-group group-form add-form">'+
                        '<input type="text" disabled class="form-control" value="'+fullName.val()+'">'+
                        '<div class="input-group-append">'+
                            '<span class="input-group-text edit-name">'+
                                '<i class="fa fa-bars"></i></span>'+
                        '</div>'+
                    '</div>';
        $("#extra-names").append(html);

        fullName.val("");
        email.val("");
        phone.val("");
        day.val("");
        month.val("");
        year.val("");
    });

    //auto fill summary
    $(".smy-fld").keyup(function(e){
    	var val = $(this).val();
    	var eqFld = $(this).attr("data-conn");

    	$("#"+eqFld).val(val);
    });
    //select option
    $(".index-option").click(function(){
    	$(".index-option").removeClass("active-option");
    	$(this).addClass("active-option");
    });
    //submit index form 
    $("#submit-form").click(function(){
    	// $("#index-form").submit();
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
    // $(".card-header").click(function(){
    //     $(".card-header").removeClass("active");
    //     $(this).addClass("active");
    // });

    $('#offersAcdn').on('shown.bs.collapse', function () {
      var header = $("div.collapse.show").attr("aria-labelledby");
      $("#"+header).addClass("active");
    })
    
    $('#offersAcdn').on('hidden.bs.collapse', function () {
      var prev = $("div.card-header.active").removeClass("active");
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
});