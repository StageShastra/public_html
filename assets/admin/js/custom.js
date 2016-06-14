$(document).ready(function(){

	/***
		Globale Variables
	***/

	var url = "/InternshipProjects/Chynko/adminapi/request/",
		_token = '',
		data = {},
		type = "POST",
		span = "span.span-token";


	$(document).on("click", 'button.admin-status',  function(){
		var that = this;
		var id = Number($(this).attr("data-admin"));
		var status = 0;
		var cls = "unblock";
		_token = $(span).attr("data-token");
		if($(this).hasClass("block")){
			status = 1;
			cls = 'block';
		}else{
			status = 0;
			cls = 'unblock';
		}
		data = {request: "UpdateAdmin", data: {id: id, status: status}, _token: _token};
		//console.log(data);

		swal({
			title: "Are you sure?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, do it!",
			closeOnConfirm: false
		}, 

		function () {
			$.ajax({
				url: url,
				type: type,
				data: data,
				success: function(data){
					$(span).attr("data-token", data._token);
					if(data.status){
						swal("Success!", "Action is Successfully Taken", "success");
						$(window).delay(3000);
						window.location.reload();
					}else{
						swal("Error!", "Sorry! Some Error Occured.", "error");
					}
				}
			});
		});
	});


	// Order Status

	$(document).on("submit", "form#update-order-status", function(){

		var that = this;
		var status = Number($("select[name='status']").val());
		var order = Number($("input[name='order']").val());
		_token = $(span).attr("data-token");
		data = {request: "UpdateOrderStatus", data: {order: order, status: status}, _token: _token};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(data){
				$(span).attr("data-token", data._token);
				$("p.display_message").html(data.message).fadeIn(500).delay(3000).fadeOut(500).delay(2000);
				if(data.status){
					$(window).delay(3000);
					window.location.reload();
				}
			}
		});
		return false;
	});

});