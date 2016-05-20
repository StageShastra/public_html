$(document).ready(function(){

	var url = "/public_html/beta/actor/ajax",
		base = "/public_html/beta/",
		type = "POST",
		data = {};

	$("#warningmsg").hide();

	$(".toggleEdit").on("click", function(){
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
					console.log(response);
				}
			})


	});

	$(document).on("click", ".addExperience", function(){
		var that = this;
		var title = $("input[name='exp_title']").val();
		var role = $("input[name='exp_role']").val();
		var blurb = $("textarea[name='exp_blurb']").val();
		var link = $("input[name='exp_link']").val();
		data = {request: "AddExperience", data: JSON.stringify({title: title, role: role, blurb: blurb, link: link})};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
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
		//console.log(blurb);
		data = {request: "AddTraining", data: JSON.stringify({title: title, course: course, blurb: blurb, start: start, end: end})};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status)
					location.reload();
				console.log(response);
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
		$("#convertedBox").show();
		$("span#converted").html(cm);
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

}

Dropzone.options.photoUpload={ 
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFilesize:2,
    addRemoveLinks:true,
    maxFiles: 10,
    dictDefaultMessage:'Drag or click here to upload <span style="color:#FFAA3A;">at least one picture</span>.<span class="info-small gray"><li>Ideally, keep the image size less than 1.5MB</li><li>You can add more later</li></span>',
    acceptedFiles:'image/*',
    paramName:'file',
    dictInvalidFileType:'Please stick to image files.',
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
      this.on("successmultiple", function(files, response)
      { 
        //console.log(files);
        console.log(response);
        if(response)
        {
         location.reload();
        }
        else
        { 
          $("#unsuccessful").show();
        }
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