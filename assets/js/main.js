if(window.location.hash== "#login")
{
    $("#loginModal").modal("show");
    console.log(window.location);
}
$(document).ready(function(){
	//For Main Sevrer
	var url = "/ajax/",
		base = "/";
		
	//For Localhost
	/*var url = "/public_html/beta/ajax/",
		base = "/public_html/beta/";
	*/

	var type = "POST",
		data = {},
		formdata = {};

	$(document).on("click", "button.select-btn", function(){
		var show_div = $(this).attr("data-show"),
			hide_div = $(this).attr("data-hide");
		$(hide_div).addClass("hidden");
		$(show_div).removeClass("hidden");
		return false;
	});

    function firstToUpperCase( str ) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

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
					//$("input", $(that)).val("");
                    if(response.data.redirect){
                        if( typeof redirect_url != 'undefined' && redirect_url != '' && user == 'actor' )
                            window.location.href = redirect_url;
                        else
                            window.location.href = base + user;
                    }else{
                        window.location.href = base + "payment";
                    }
				}else{
                    //console.log(data);
                    $("#login-error-" + user).html(response.message).show(500).delay(5000).hide(500);
                }
				
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
    				$("#sent_code").removeClass("text-warning").addClass("text-success");
                    $("#getcodediv").hide();  
                    $("#gotcodediv").show();
                    $("#sent_code").html(response.message).show(500);
    			}
    			$("#error-forgot-password").html(response.message).show(500);
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
                    $("#error-change-password").html(response.message).show(500).delay(5000).hide(500);
                    setTimeout(function(){
                        window.location.href = base;
                    }, 5000);
    			}else{
                    $("#error-change-password").html(response.message).show(500).delay(5000).hide(500);
                }
    			
    		}
    	});

    	return false;
    });

    $(document).on("submit", "form#mobileVerfication", function(){
        var that = this;
        var otp = $("input[name='otp']", $(this)).val();
        data = {request: "VerifyOTP", data: JSON.stringify({otp: otp})};
        $.ajax({
            url: base + "actor/ajax",
            type: type,
            data: data,
            success: function(response){
                if(response.status){
                    $(that).remove();
                    $("#error-notice").addClass("text-success").html(response.message).show(500);
                }else{
                    $("#error-notice").addClass("text-danger").html(response.message).show(500);
                }
            }
        });
        return false;
    });



    function casting_director_click(){
    var image = document.getElementById('cd_icon');
    if (image.src.match("_on")) {
        image.src = "../img/cd_off.png";
    } else {
        image.src = "../img/cd_on.png";
    }
}
function actor_click(){
    var image = document.getElementById('actor_icon');
    if (image.src.match("_on")) {
        image.src = "../img/actor_off.png";
    } else {
        image.src = "../img/actor_on.png";
    }
}
$(document).on("click", ".toggleEdit", function(){
        var unhide = $(this).attr("data-unhide-id");
        var hide = $(this).attr("data-hide-id");
        $(unhide).removeClass("hidden");
        $(hide).addClass("hidden");

        //console.log(hide, unhide);

    });


$(document).on("submit", "form#contactForm", function(){
    var data={};
    var name = $("#name_sender").val();
    var email = $("#email_sender").val();
    var phone = $("#phone_sender").val();
    var message = $("#message").val();
    data.request = "save_contact_message";
    data.data = JSON.stringify({name:name,email:email,phone:phone,message:message});
    $.ajax({
            url: url,
            type:type,
            data: data,
            success: function(response){
                if(response.status){
                    $("#contactForm").addClass("animated rubberband");
                    $("#name_sender").val("");
                    $("#email_sender").val("");
                    $("#name_sender").val("");
                    $("#phone_sender").val("");
                    $("#message").val("");
                    $("#success").removeClass("hidden");
                    setTimeout(function(){
                        $("#success").addClass("animated fadeOut");
                    }, 5000);
                }else{
                    console.log(response);
                }
                
            }
        });

        return false;
});
  

 

});



