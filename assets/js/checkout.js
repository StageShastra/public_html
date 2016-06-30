$(document).ready(function(){

	if( payee == 'actor' ){
		if( plan == 0 )
			actorBasicPlan();
		else
			actorProPlan();
	}else{
		if( plan == 0 )
			directorBasicPlan();
		else if( plan == 1 )
			directorProPlan();
		else
			directorProPlusPlan();
	}



	$(document).on("change", "#planselector", function(){
		planVal = $(this).val();
		if( planVal == 'Basic' )
			directorBasicPlan();
		else if( planVal == 'Pro' )
			directorProPlan();
		else if( planVal == 'Pro-Plus' )
			directorProPlusPlan();
		else if( planVal == 'Actor-Basic' )
			actorBasicPlan();
		else if( planVal == 'Actor-Pro' )
			actorProPlan();
		else
			alert("Invalid Selection.");
	});

	$(document).on("change", "#months", function(){

		monthVal = $(this).val();
		var amount = 200 * Number( monthVal );
		$("#net_amount").html(amount);
		$(".checkout_btn").addClass("hidden");
		if($.isNumeric(monthVal)){
			h = monthVal;
		}else{
			h = monthVal.toLowerCase().replace("-", "_");
		}
		$("#checkout_btn_pro_" + h).removeClass("hidden");

	});

	/* Actor Plans */

	function actorBasicPlan() {
		var price = "0/month";
		var amount = "0";
		var button = "Register";

		$("#pro_content").addClass("hidden");
		$("#months_row").addClass("hidden");
		$("#basic_content").removeClass("hidden");
		$("#price_per_month").html(price);
		$(".checkout_btn").addClass("hidden");
		$("#checkout_btn_basic_actor").removeClass("hidden");
		$("#net_amount").html(amount);
	}

	function actorProPlan() {
		var price = "200/month";
		monthVal = $("#months").val();
		var amount = 200 * monthVal;
		$("#basic_content").addClass("hidden");
		$("#pro_content").removeClass("hidden");
		$("#months_row").removeClass("hidden");
		$("#price_per_month").html(price);
		$(".checkout_btn").addClass("hidden");
		$("#checkout_btn_pro_" + monthVal).removeClass("hidden");
		$("#net_amount").html(amount);
	}


	/* Director Plans */

	function directorBasicPlan() {
		var price = "5000/month";
		var amount = "5000";
		var button = "Register";
		$("#months").html("1 month");
		$("#net_amount").html(amount);
		$("#price_per_month").html(price);

		$("#pro_content").addClass("hidden");
		$("#pro_plus_content").addClass("hidden");
		$("#basic_content").removeClass("hidden");
		$(".checkout_btn").addClass("hidden");
		$("#checkout_btn_basic").removeClass("hidden");
	}

	function directorProPlan() {
		var price = "4500/month";
		var amount = 27000;
		$("#months").html("6 months");
		$("#net_amount").html(amount);
		$("#price_per_month").html(price);

		$("#basic_content").addClass("hidden");
		$("#pro_plus_content").addClass("hidden");
		$("#pro_content").removeClass("hidden");
		$("#months_row").removeClass("hidden");
		$(".checkout_btn").addClass("hidden");
		$("#checkout_btn_pro").removeClass("hidden");
	}

	function directorProPlusPlan() {
		var price = "4000/month";
		var amount = 48000;
		$("#months").html("12 months");
		$("#price_per_month").html(price);
		$("#net_amount").html(amount);

		$("#pro_content").addClass("hidden");
		$("#basic_content").addClass("hidden");
		$("#pro_plus_content").removeClass("hidden");
		$("#months_row").removeClass("hidden");
		$(".checkout_btn").addClass("hidden");
		$("#checkout_btn_pro_plus").removeClass("hidden");
		$("#checkout_btn").addClass("hidden");
	}


	$(document).on("click", "#checkout_btn_basic_actor", function(){
		data = {request: "GoBasic", data: JSON.stringify({plan: 'Basic'})};
		$.ajax({
			url: "/ajax/",
			type: "POST",
			data: data,
			success: function(response){
				if(response.status){
					setTimeout( function(){

						window.location.href = "/payment/success/basic";
					}, 500 );
				}
			}
		});
		return false;
	});

});
