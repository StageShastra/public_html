$(document).ready(function(){

	var url = "../resources/ajax.php",
		type = "POST",
		data = {},
		formdata = {};


	$(document).on("submit", "form#actor-signup-form", function(){

		var that = this;
		$("input").each(function(){
			var $input = $(this);
			formdata[$input.attr("name")] = $input.val();
		});

		data = {request: "ActorSignUp", data: JSON.stringify(formdata)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#signup-error").removeClass("text-danger").addClass("text-success");
					$("input", $(that)).val("");
				}
				$("#signup-error").html(response.message).show(500).delay(3000).hide(500);
				//console.log(response);
			}
		});
		return false;

	});

	$(document).on("submit", "form#login-form", function(){
		var that = this;
		var email = $("input[name='email']").val();
		var password = $("input[name='password']").val();

		data = {request: "ActorLogin", data: JSON.stringify({ email: email, password: password })};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#signup-error").removeClass("text-danger").addClass("text-success");
					$("input", $(that)).val("");

					window.location.href = "act.php";
				}
				$("#signup-error").html(response.message).show(500).delay(3000).hide(500);
				//console.log(response);
			}
		});

		return false;
	});

});