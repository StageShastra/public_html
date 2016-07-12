$(document).ready(function(){

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
	    url = "/project/ajax/";
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$(".responseToAudtion").removeClass("disabled");
					$that.addClass("disabled");

					$("#res-message").html( "You have selected <span class='label label-"+l+"'>"+a+"</span>. You can change your choice anytime." )
				}else{
					alert(" Failed. Try again. ");
					console.log(data);
				}
			}
		});

	});

});