$(document).ready(function(){

	var url = "/Castiko/project/ajax/",
		base = "/Castiko/",
		type = "POST",
		data = {};


	$(document).on("click", ".responseToAudtion", function(){
		$that = $(this);
		cate = $("#projectInfoId").attr("data-for");
		cate_id = Number($("#projectInfoId").attr("data-id"));
		res = Number($(this).attr("data-response"));
		if( res == 1 ){
			l = 'success',
			a = 'Yes';
		}else if(res == 2){
			l = 'danger',
			a = 'No';
		}else{
			l = 'warning',
			a = 'May be';
		}

		data = {request: "ResponseAudition", data: JSON.stringify({ for: cate, forId: cate_id, res: res })};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$(".responseToAudtion").removeClass("disabled");
					$that.addClass("disabled");

					$("#res-message").html( "You selected <span class='label label-"+l+"'>"+a+"</span>. Still you can change your choice." )
				}else{
					alert(" Failed. Try again. ");
				}
			}
		});

	});

});