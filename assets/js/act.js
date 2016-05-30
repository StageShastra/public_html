$(document).ready(function(){

	var url = "/public_html/actor/ajax",
		base = "/public_html/actor/",
		type = "POST",
		data = {};

	//$("#warningmsg").hide();
	$("#resendConfirmationModal").modal("hide");
	
	
	function removeDefaultCookies(){
		Cookies.remove("newInvite");
		Cookies.remove("project_ref");
		Cookies.remove("director_ref");
	}
	removeDefaultCookies();

	$(document).on("click", ".toggleEdit", function(){
		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		$(unhide).removeClass("hidden");
		$(hide).addClass("hidden");

		//console.log(hide, unhide);

	});
	//populate_photos();
	$(document).on("click", ".updateDataField", function(){

		var that = this;
		var str = '';
		var names = $(this).attr("data-input-names").split(",");
		var request = $(this).attr("data-request");
		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		var form = {};
		$.each( names, function(index, value){
			name = $.trim(value);
			form[name] = $('[name="'+name+'"]').val();
		});

		data = {request: request, data: JSON.stringify(form)};

		console.log(data);

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					
					if(request == 'EditLanguage' || request == 'EditSkills'){
						var html = '';
						$.each( form, function(index, value){
							if(index == "language" || index == "skills"){
								$.each( value.split(","), function(index, value){
									name = $.trim(value);
									name = name.toProperCase();
									html +='<div class="col-sm-4 vertical-padded">'
	                                    	+'<button type="button" class="btn tagp" style="max-width:auto;"aria-label="Left Align" >'
	                                        	+'<font class="taga-text">'+name+'</font>'
	                                    	+'</button>'
	                                		+'</div> ';
								});
							}
						});
						$(unhide).html(html);
					}else if( request == 'EditUsername' ){
						url = "http://castiko.com/" + form['username'];
						$("#actor_username_txt").html(url);
						$("#actor_username_txt").attr("href", url);
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
				$("#savedChnagedMsg").html(response.message);
				$("#savedChnaged").show(500).delay(3000).hide(500);
				//console.log(response);
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
			table_ref = $(this).attr("data-table-id"),
			failed = false;

			var form = {actor_ref: $("input[name='actor_ref']").val(), key: key, table_ref: table_ref};
			$(".input-error").remove();
			$.each( names, function(index, value){
				name = $.trim(value);
				val = $.trim($('[name="'+name+'"]').val());
				$('[name="'+name+'"]').removeClass("isError");
				if(name.match(/ex_title_/) || name.match(/ex_role_/) || name.match(/tr_/)){
					if(val == ''){
						$('[name="'+name+'"]').addClass("isError");
						failed = true;
					}
				}
				
				form[name] = val;
			});
			
			if(failed){
				return false;
			}

			data = {request: request, data: JSON.stringify(form)};

			//console.log(data);

			$.ajax({
				url: url,
				type: type,
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
					//console.log(response);
					$("#savedChnagedMsg").html(response.message);
					$("#savedChnaged").show(500).delay(3000).hide(500);
				}
			})


	});

	$(document).on("click", ".addExperience", function(){
		var that = this;
		$(".input-error").remove();
		var title = $("input[name='exp_title']").val();
		$("input[name='exp_title']").removeClass("isError");
		if(title == ''){
			$("input[name='exp_title']").addClass("isError");
			return false;
		}
		var role = $("input[name='exp_role']").val();
		$("input[name='exp_role']").removeClass("isError");
		if(role == ''){
			$("input[name='exp_role']").addClass("isError");
			return false;
		}
		var blurb = $("textarea[name='exp_blurb']").val();
		var link = $("input[name='exp_link']").val();
		data = {request: "AddExperience", data: JSON.stringify({title: title, role: role, blurb: blurb, link: link})};
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					html = response.data.html;
					//console.log(rData);
					$("#experiencelist").html(html);

					$("#experience_add").addClass("hidden");
					$("#closeexperienceicon").addClass("hidden");
					$("#openexperienceicon").removeClass("hidden");

				}
				$("#experiencelist").removeClass("hidden");
				$("#experience_add").addClass("hidden");
				$("#savedChnagedMsg").html(response.message);
				$("#savedChnaged").show(500).delay(3000).hide(500);
			}
		});
		return false;
	});


	$(document).on("click", ".addTraining", function(){
		var that = this;
		$(".input-error").remove();
		var title = $("input[name='trn_title']").val();
		$("input[name='trn_title']").removeClass("isError");
		if(title == ''){
			$("input[name='trn_title']").addClass("isError");
			return false;
		}
		var course = $("input[name='trn_course']").val();
		$("input[name='trn_course']").removeClass("isError");
		if(course == ''){
			$("input[name='trn_course']").addClass("isError");
			return false;
		}
		var blurb = $("textarea[name='trn_blurb']").val();
		
		var start = $("input[name='trn_start_time']").val();
		$("input[name='trn_start_time']").removeClass("isError");
		if(start == ''){
			$("input[name='trn_start_time']").addClass("isError");
			return false;
		}
		var end = $("input[name='trn_end_time']").val();
		$("input[name='trn_end_time']").removeClass("isError");
		if(end == ''){
			$("input[name='trn_end_time']").removeClass("isError");
			return false;
		}
		//console.log(blurb);
		data = {request: "AddTraining", data: JSON.stringify({title: title, course: course, blurb: blurb, start: start, end: end})};
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					html = response.data.html;
					//console.log(rData);
					$("#traininglist").html(html);
					$("#training_add").addClass("hidden");
					$("#closetrainingicon").addClass("hidden");
					$("#opentrainingicon").removeClass("hidden");
				}
				$("#traininglist").removeClass("hidden");
				$("#training_add").addClass("hidden");
				$("#savedChnagedMsg").html(response.message);
				$("#savedChnaged").show(500).delay(3000).hide(500);
			}
		});

		return false;
	});
	
	
	$(document).on("submit", "form#feetToCMConverter", function(){
		var that = this;
		var feet = Number($("select[name='feet']", $(this)).val());
		var inches = Number($("select[name='inches']", $(this)).val());
		inches = inches + (feet * 12);
		var cm = Math.ceil(inches / 0.39370);
		$("span#converted").html(cm);
		//$("#convertedBox").show();
		return false;
	});

	$(document).on("click", ".removeSpanBtn", function(){
		var conf = confirm("Are you sure you want to remove this ?");
		if(!conf)
			return false;
		var that = this;
		var key = Number($(this).attr("data-key"));
		var ref = Number($(this).attr("data-id"));
		var to_do = $(this).attr("data-type");
		if(to_do == 'experience')
			data = {request: "RemoveExperience", data: JSON.stringify({experience_ref: ref})};
		else
			data = {request: "RemoveTraining", data: JSON.stringify({training_ref: ref})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				if(response.status){
					if(to_do == "experience"){
						$("#" +  to_do + "-" + key).hide(500).remove();
						totalExp = $(".actExp").length;
						current = key + 1;
						if(totalExp > 0){
							console.log(key, totalExp);
							if(totalExp == 1){
								$(".nav_icons").remove();
								$(".actExp").removeClass("hidden");
							}else{
								prev = key - 1;
								next = key + 1;
								$("#experience-" + prev + " .righttnav").attr("data-unhide-id", "#experience-" + next);
								$("#experience-" + next + " .leftnav").attr("data-unhide-id","#experience-" + prev);
								$("#experience-" + next).removeClass("hidden");
							}
						}
					}else{
						$("#" +  to_do + "-" + key).hide(500).remove();
					}
				}else{
					alert("Failed to remove");
				}
			}
		});
		return false;
	});
	
	$(document).on("click", ".setProfilePic", function(){
		var img = $("a", $(this)).attr("href");
		$("#actorAvatar").attr("src", img);
		data = {request:"UpdateProfileImage",data:JSON.stringify({img:img})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#set_profile_photo").modal("hide");
				}else{
					alert(response.message);
				}
				
			}
		});
		return false;
	});
	
	
	
	$(document).on("click", "#resendConfirmationLink", function(){
		data = {request: "ResendConfirmationLink", data:JSON.stringify({})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				$("#resendCnfLnk-msg").html(response.message);
				$("#resendConfirmationModal").modal("show");
				setTimeout(function(){
					$("#resendConfirmationModal").modal("hide");
				}, 5000);
			}
		});
		return false;
	});
	
	$(document).on("click", ".removeImage", function(){
		var conf = confirm("Are you sure you want to remove this image ?");
		if(!conf)
			return false;
		
		var img = $(this).attr("data-image");
		var key = $(this).attr("data-key");
		data = {request: "RemoveImage", data: JSON.stringify({image: img})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#DocumentItem_" + key).addClass("animated fadeOut");
					$("#DocumentItem_" + key).remove();
				}else{
					alert(response.message);
				}
			}
		});
		return false;
	});
	
	$(document).on("click", ".shareButton", function(){
		var cond = $(this).attr("data-open");
		if(cond == "false"){
			$("#socialShare").show(500, "linear");
			$(this).attr("data-open", true);
		}else{
			$("#socialShare").hide(500, "linear");
			$(this).attr("data-open", false);
		}
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
function populate_photos()
{
	var json={};
	json.actor_images = $("#image_count").val();
	json.actor_profile_photo = $("#profile_pic").val();
	if(json.actor_images=="")
	{
		return;
	}
	var photoshtml='<div class="row" style="padding-right:15px;">'
                       +'<div class="DocumentList">'
                       +'  <ul class="list-inline">';

                       for(var k=0;k<json.actor_images;k++)
                       {
                        var str = json.actor_profile_photo;
                        var arr = str.split(".");
                        var ext = arr[2];
                        str1 = arr[0];
                        str2 = arr[1];
                        str2 = str2.substring(0, str2.length - 1);
                        str=str1+'.'+str2;
                        str+=k+'.'+ext;
                        //console.log(str);
        photoshtml+='<li class="DocumentItem">'
                       +'<a href="'+str+'" data-lightbox="'+json.actor_name+'"><img class="photo"src='+str+' height="100%" width=auto></img></a>' 
                       +'         </li>';
                      }
        photoshtml+='  </ul>'
                       +' </div>'
                       +' </div>';
        $("#photos_videos").html(photoshtml);
        $("#warningmsg").addClass("hidden");
        $("img").error(function () { 
	    $(this).hide();
	    // or $(this).css({visibility:"hidden"}); 
	});
	
	function SelectText(element) {
		var doc = document
			, text = doc.getElementById(element)
			, range, selection
		;    
		if (doc.body.createTextRange) {
			range = document.body.createTextRange();
			range.moveToElementText(text);
			range.select();
		} else if (window.getSelection) {
			selection = window.getSelection();        
			range = document.createRange();
			range.selectNodeContents(text);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}
	
	$(document).on("click", ".actor_link", function(){
		SelectText("actor_link");
	});

}

Dropzone.options.photoUpload={ 
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFilesize:2,
    addRemoveLinks:true,
    maxFiles: 10,
    dictDefaultMessage:'<b>Drag or click here to upload <span style="color:#FFAA3A;">at least one picture</span></b>.<span class="info-small gray"><li>Ideally, keep the image size less than 1.5MB</li></span>',
    acceptedFiles:'image/*',
    paramName:'file',
    dictInvalidFileType:'Please stick to image files.',
    drop: function()
    {
    	
    },
    // The setting up of the dropzone
    init: function()
    {
      var myDropzone = this;
      $("#upload-btn").click(function(e)
      {
        e.preventDefault();
        e.stopPropagation();
        myDropzone.processQueue();
      });

      // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
      // of the sending event because uploadMultiple is set to true.
      this.on("sendingmultiple", function(file, xhr, formData)
      {
       //console.log(actor);
      });
      this.on("drop", function()
      {
       $("#upload-btn").removeClass("disabled");
       console.log("Aa");
      });
      this.on("addedfile", function(file)
      {
       $("#upload-btn").removeClass("disabled");
       console.log("Aa");
      });
      this.on("successmultiple", function(files, response)
      { 
        //console.log(files);
        location.reload();
        console.log(response);
        
        // Gets triggered when the files have successfully been sent.
        // Redirect user or notify of success.
      });
      this.on("errormultiple", function(files, response)
      {
        // Gets triggered when there was an error sending the files.
        // Maybe show form again, and notify user of error
      });
  }

}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
