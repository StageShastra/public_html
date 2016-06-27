$(document).ready(function(){
	if (plan==0)
	{
		select_basic();
	}
	else if(plan==1)
	{
		select_pro();
	}
	else if(plan==2)
	{
		select_pro_plus();
	}
	//change in plan
	$("#planselector").change(function(){
		if($("#planselector").val()=="Basic")
		{
			select_basic();
			console.log("selectting basic");
		}
		else if($("#planselector").val()=="Pro")
		{
			select_pro();
			console.log("selectting pro");
		}
		else if($("#planselector").val()=="Pro-Plus")
		{
			select_pro_plus();
			console.log("selectting pro-plus");
		}

	});
	$("#months").change(function(){
		var amount = 200 * $("#months").val();
		$("#net_amount").html(amount);
		if ($("#months").val()==3)
		{
			$("#checkout_btn_pro").removeClass("hidden");
			$("#checkout_btn_pro_6").addClass("hidden");
			$("#checkout_btn_pro_12").addClass("hidden");
			console.log("chango 3");

		}
		else if(($("#months").val()==6))
		{
			$("#checkout_btn_pro").addClass("hidden");
			$("#checkout_btn_pro_12").addClass("hidden");
			$("#checkout_btn_pro_6").removeClass("hidden");
			console.log("chango 6");
			
		}
		else if(($("#months").val()==12))
		{
			$("#checkout_btn_pro").addClass("hidden");
			$("#checkout_btn_pro_6").addClass("hidden");
			$("#checkout_btn_pro_12").removeClass("hidden");
			console.log("chango 12");
		}
	});
})
function select_basic(){
	var price = "5000/month";
	var link = "<a href=#>Register</a>";
	var amount = "5000";
	var button = "Register";
	$("#months").html("1 month");
	$("#pro_content").addClass("hidden");
	$("#pro_plus_content").addClass("hidden");
	$("#basic_content").removeClass("hidden");
	$("#price_per_month").html(price);
	$("#checkout_btn_basic").removeClass("hidden");
	$("#checkout_btn_pro").addClass("hidden");
	$("#checkout_btn_pro_plus").addClass("hidden");
	$("#net_amount").html(amount);


}

function select_pro(){
	var price = "4500/month";
	var link='<a href="https://www.instamojo.com/paycastiko/castiko-actor-membership-pro-plan-3-months/" rel="im-checkout" data-behaviour="remote" data-style="no-style" data-text="Checkout With Instamojo" data-token="43c9fd9353701a50b5cceafef6e13b6f"></a>';
			+'<script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>';
	var amount = 27000;
	$("#months").html("6 months");
	$("#basic_content").addClass("hidden");
	$("#pro_plus_content").addClass("hidden");
	$("#pro_content").removeClass("hidden");
	$("#months_row").removeClass("hidden");
	$("#price_per_month").html(price);
	$("#checkout_btn_pro").removeClass("hidden");
	$("#checkout_btn").addClass("hidden");
	$("#net_amount").html(amount);
}
function select_pro_plus(){
	var price = "4000/month";
	var link='<a href="https://www.instamojo.com/paycastiko/castiko-actor-membership-pro-plan-3-months/" rel="im-checkout" data-behaviour="remote" data-style="no-style" data-text="Checkout With Instamojo" data-token="43c9fd9353701a50b5cceafef6e13b6f"></a>';
			+'<script src="https://d2xwmjc4uy2hr5.cloudfront.net/im-embed/im-embed.min.js"></script>';
	var amount = 48000;
	$("#months").html("12 months");
	$("#pro_content").addClass("hidden");
	$("#basic_content").addClass("hidden");
	$("#pro_plus_content").removeClass("hidden");
	$("#months_row").removeClass("hidden");
	$("#price_per_month").html(price);
	$("#checkout_btn_pro").removeClass("hidden");
	$("#checkout_btn").addClass("hidden");
	$("#net_amount").html(amount);
}