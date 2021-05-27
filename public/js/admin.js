
$(document).ready(function() {
    var csrf            = $("#csrf");
    $(".get-storage").click(function(){
        var token = $(this).attr("data-token");
        var title = $(this).attr("data-title");
        var modal = $(this).attr("data-modal");
        var table = $(this).attr("data-table");
        var type  = $(this).attr("data-type");

        $("."+title).html("");
        $("."+table).html("");
        $("."+table).html("<tr><td><b>Loading Customer Data..</b></td></tr>");
        getStorage(token, title, modal, type, table);
    });

    $('#reportTable').DataTable( {
        columnDefs: [ { type: 'date', 'targets': [3] } ],
        order: [[ 4, 'desc' ]],
        "bDestroy": true 
    });

    $('#reportTable2').DataTable( {
        columnDefs: [ { type: 'date', 'targets': [3] } ],
        order: [[ 4, 'desc' ]],
        "bDestroy": true 
    });

    function getStorage(token, title, modal, type, table){
		$('#'+modal).modal('toggle');
        $.ajax({
            type: "POST",
            data: { _token : csrf.val(), token: token},
            url: "/recover-storage",
            success: function(response){
                var obj = JSON.parse(response);
            	var html = '<tr>'+
			                    '<td>Full name</td>'+
			                    '<td>'+obj.first_name+' '+obj.last_name+'</td>'+
			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>Phone numer</td>'+
			                    '<td>'+obj.phone+'</td>'+
			                '</tr>'+  
                            '<tr>'+
                                '<td>Email</td>'+
                                '<td>'+obj.email+'</td>'+
                            '</tr>'+
			            	'<tr>'+
			                    '<td>New Address</td>'+
			                    '<td>'+obj.new_address+'</td>'+
			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>Postcode</td>'+
			                    '<td>'+obj.new_post+'</td>'+
			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>City</td>'+
			                    '<td>'+obj.new_place+'</td>'+
			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>Moving date</td>'+
			                    '<td>'+obj.moving_date_year+'-'+obj.moving_date_month+'-'+obj.moving_date_day+'</td>'+
			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>Birth date</td>'+
			                    '<td>'+obj.birth_year+'-'+obj.birth_month+'-'+obj.birth_day+'</td>'+

			                '</tr>'+ 
			            	'<tr>'+
			                    '<td>Type</td>'+
			                    '<td>'+type+'</td>'+
			                '</tr>';
                $("."+table).html(html);
                $("."+title).html(obj.first_name+' '+obj.last_name);
            }
        });
    }
});
