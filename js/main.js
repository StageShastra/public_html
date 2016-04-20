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
		//alert("x");
		data = {request: "ActorSignUp", data: JSON.stringify(formdata)};
		console.log(data);
		$("#sign-upbtn").addClass("hidden");
		//$("#spinner").removeClass("hidden");
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response==1){
					$("#signup-error").removeClass("text-danger").addClass("text-success");
					$("input", $(that)).val("");
				}
				var message;
				//console.log(response+"jjj");
				if(response==1)
				{
					message="You are Successfully signed up, please check your email for  confirmation link. You can now sign in.";
				}
				if(response==2)
				{
					message="This user already exists. Please login."
				}
				if(response==0)
				{
					message="Sorry some error occured, please try again."
				}
				$("#signup-error").html(message).show(500).delay(5000).hide(500);
				console.log(message);
				console.log(response);
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
				if(response==1){
					$("#signup-error").removeClass("text-danger").addClass("text-success");
					$("input", $(that)).val("");

					window.location.href = "act.php";
				}
				var message;
				//console.log(response+"jjj");
				if(response==1)
				{
					message="Login Success";
				}
				if(response==2)
				{
					message="This user does not exist. Please Sign Up!."
				}
				if(response==0)
				{
					message="Sorry some error occured, please try again."
				}
				$("#signup-error").html(message).show(500).delay(3000).hide(500);
				//console.log(response);
			}
		});

		return false;
	});

});