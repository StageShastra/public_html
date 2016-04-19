$(document).ready(function(){

	$(".toggleEdit").on("click", function(){
		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		$(unhide).removeClass("hidden");
		$(hide).addClass("hidden");

		//console.log(hide, unhide);
	});

	$(document).on("click", ".updateDataField", function(){

		var that = this;
		var str = '';
		var names = $(this).attr("data-input-names").split(",");
		var request = $(this).attr("data-request");
		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		var form = {actor_ref: $("input[name='actor_ref']").val()};
		$.each( names, function(index, value){
			name = $.trim(value);
			form[name] = $('[name="'+name+'"]').val();
		});

		data = {request: request, data: JSON.stringify(form)};

		console.log(data);

		$.ajax({
			url: "../resources/ajax.php",
			type: "POST",
			data: data,
			success: function(response){
				if(response.status){
					
					if(request == 'EditLanguage' || request == 'EditSkills'){
						var html = '';
						$.each( form, function(index, value){
							if(index == "language" || index == "skills"){
								$.each( value.split(","), function(index, value){
									name = $.trim(value);
									html +='<div class="col-sm-4 vertical-padded">'
	                                    	+'<button type="button" class="btn tagp" aria-label="Left Align" >'
	                                        	+'<font class="taga-text">'+name+'</font>'
	                                    	+'</button>'
	                                		+'</div> ';
								});
							}
						});
						$(unhide).html(html);
					}else{
						$.each( form, function(index, value){
							if(index == "sex")
								if(value == "M")
									value = "Male";
								else
									value = "Female";
							$("#actor_" + index).html(value);
						});
					}

					
				}
				$(unhide).removeClass("hidden");
				$(hide).addClass("hidden");
				console.log(response);
			}
		});

		return false;
	});


	$(document).on("click", ".btnExpAndTraining", function(){
		var that = this,
			names = $(this).attr("data-input-names").split(","),
			request = $(this).attr("data-request"),
			unhide = $(this).attr("data-unhide-id"),
			hide = $(this).attr("data-hide-id"),
			key = $(this).attr("data-key"),
			table_ref = $(this).attr("data-table-id");

			var form = {actor_ref: $("input[name='actor_ref']").val(), key: key, table_ref: table_ref};

			$.each( names, function(index, value){
				name = $.trim(value);
				form[name] = $('[name="'+name+'"]').val();
			});

			data = {request: request, data: JSON.stringify(form)};

			console.log(data);

			$.ajax({
				url: "../resources/ajax.php",
				type: "POST",
				data: data,
				success: function(response){
					if(response.status){
						$.each( form, function(index, value){
							$("#actor_" + index).html(value);
						});

						$(unhide).removeClass("hidden");
						$(hide).addClass("hidden");
					}

					$(unhide).removeClass("hidden");
					$(hide).addClass("hidden");
					console.log(response);
				}
			})


	});

	$(document).on("click", ".addExperience", function(){
		var that = this;
		var title = $("input[name='exp_title']").val();
		var role = $("input[name='exp_role']").val();
		var blurb = $("textarea[name='exp_blurb']").val();

		data = {request: "AddExperience", data: JSON.stringify({title: title, role: role, blurb: blurb})};
		console.log(data);
		$.ajax({
			url: "../resources/ajax.php",
			type: "POST",
			data: data,
			success: function(response){
				if(response.status)
					location.reload();
				console.log(response);
			}
		});

		return false;
	});


	$(document).on("click", ".addTraining", function(){
		var that = this;
		var title = $("input[name='trn_title']").val();
		var course = $("input[name='trn_course']").val();
		var blurb = $("textarea[name='trn_blurb']").val();
		var start = $("input[name='trn_start_time']").val();
		var end = $("input[name='trn_end_time']").val();

		data = {request: "AddTraining", data: JSON.stringify({title: title, course: course, blurb: blurb, start: start, end: end})};
		console.log(data);
		$.ajax({
			url: "../resources/ajax.php",
			type: "POST",
			data: data,
			success: function(response){
				if(response.status)
					location.reload();
				console.log(response);
			}
		});

		return false;
	});

});

String.prototype.toProperCase = function () {
    return this.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
};
$("input").tooltip({
 
      // place tooltip on the right edge
      position: "right",
 
      // a little tweaking of the position
      offset: [0, 0],
 
      // use the built-in fadeIn/fadeOut effect
      effect: "none",
 
      // custom opacity setting
      opacity: 0.7
 
});