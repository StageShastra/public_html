$(document).ready(function(){

	var url = "/ajax/",
		type = "POST",
		data = {},
		formdata = {},
		base = "/"

	$(document).on("click", "button.select-btn", function(){
		var show_div = $(this).attr("data-show"),
			hide_div = $(this).attr("data-hide");
		$(hide_div).addClass("hidden");
		$(show_div).removeClass("hidden");
		return false;
	});

	$(document).on('submit', 'form.login-forms', function(){

		var that = this;
		$("input", $(this)).each(function(){
			var $input = $(this);
			formdata[$input.attr("name")] = $input.val();
		});
		var user = formdata['type'];
		data = {request: "UserLogin", data: JSON.stringify(formdata)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#login-error-" + user).removeClass("text-danger").addClass("text-success");
					$("input", $(that)).val("");

					window.location.href = base + user;
				}
				$("#login-error-" + user).html(response.message).show(500).delay(5000).hide(500);
			}

		});

		return false;

	});


	/* Forgot Password Page */

	$("#gotcodediv").hide();
    $("#error-alert").hide();

    $(document).on('click', '#btn-gotcode', function(event){
    	event.preventDefault();
    	$("#getcodediv").hide();  
    	$("#gotcodediv").show();

    	return false;
    });


    $(document).on("submit", "form#forgot-form", function(){
    	var that = this;
    	var email = $("input[name='email']", $(this)).val();

    	data = {request: 'ForgotPassword', data: JSON.stringify({email: email})};

    	$.ajax({
    		url: url,
    		type: type,
    		data: data,
    		success: function(response){
    			//console.log(response);
    			if(response.status){
    				$("#error-forgot-password").removeClass("text-warning").addClass("text-success");
    			}
    			$("#error-forgot-password").html(response.message).show(500).delay(5000).hide(500);
    		}

    	});

    	return false;
    });

    $(document).on("submit", "form#change-password", function(){
    	var that = this;
    	$("input", $(this)).each(function(){
			var $input = $(this);
			formdata[$input.attr("name")] = $input.val();
		});
    	data = {request: "ChangePassword", data: JSON.stringify(formdata)};

    	$.ajax({
    		url: url,
    		type: type,
    		data: data,
    		success: function(response){
    			if(response.status){
    				$("#error-change-password").removeClass("text-warning").addClass("text-success");
    			}
    			$("#error-change-password").html(response.message).show(500).delay(5000).hide(500);
    		}
    	});

    	return false;
    });




});