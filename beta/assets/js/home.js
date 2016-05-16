$(document).ready(function(){

	var count = 0,
		select = [],
		url = "/public_html/beta/ajax/",
		type = "POST",
		data = {},
		base = "/public_html/beta/",
		actors = [],
		actorEmails = [],
		actorMobile = [],
		actorRef = [];

	$("#success_send").hide();
	$("#failure_send").hide();  
	//$('#contactmodal').modal('hide');

	$(document).on("click", ".addToCategories", function(){
		if(count == 5){
			alert("You have already selected 5 categories.Click on start to browse.");
			return false;
		}
		cat = $(this).attr("data-cate");
		select.push(cat);
		var id='#'+cat+"-remove";
		var tagid='#'+cat;
		$(id).removeClass("hidden");
    	$(tagid).addClass("taga-selected");
    	count++;
    	return false;
	});

	$(document).on("click", ".removeCate", function(){
		var cat = $(this).attr("data-cate");
		var index = select.indexOf(cat);
		select.splice(index, 1);
		var id='#'+cat+"-remove";
		var tagid='#'+cat;
		$(tagid).removeClass("taga-selected");
		$(id).addClass("hidden");
		count--;
		event.stopPropagation();
		return false;
	});

	$(document).on("click", 'input[name="checkboxG1"]', function(){
		var checked = $(this).is(":checked");
		var list = ['Name','Age','Sex','Email','Mobile'];
		if(checked){
			select = [];
			count = 5;
			for(var i = 0; i < list.length; i++)
				select.push(list[i]);
		}else{
			select = [];
			count = 0;
		}
	});

	$(document).on("click", ".removeActor", function(){
		var actorRef = Number($(this).attr("data-actor-id"));
		var res = confirm("Delete actor "+ actors[actorRef].StashActor_name+" from your list.");
		if(res){
			data = {request: "RemoveActor", data: JSON.stringify({actor_ref: actors[actorRef].StashActor_actor_id_ref})};

			$.ajax({
				url: url,
				type: type,
				data: data,
				success: function(response){
					console.log(data);
					if(response.status){
						$('#datarow'+actorRef).addClass("animated fadeOut");
						setTimeout(
						function(){
							//do something special
							$('#datarow'+actorRef).addClass("hidden");
						}, 1000);
					}else{
						alert(response.message);
					}
				}
			});
		}

		return false;
	});

	function showAddActor(){
		var $div = $("#browse-table");
  			content = '<div class="showwelcome"><font class="info gray">Hola! It looks like you are new over here. <br>Why don\'t you start with inviting some actors?'
  					+ '<br><button type="submit" class="btn submit-btn firstcolor"  data-toggle="modal" data-target="#inviteActors" id="btn-login" ><span class="glyphicon glyphicon-plus"></span> &nbsp;Invite  Actor</button></div>';
  			$div.html(content);
	}

	function populateActorList(actorsInfo){
		actors = actorsInfo;
		var $table = $("#browse-table");
		var content = '<table class="table table-curved display" id="actor_table">'
               		+ '<thead center>'
               		+'<tr><th id="selectallcheckbox"><input type="checkbox" name="selectallactor" id="selectallactor" class="css-checkbox" /><label for="selectallactor" class="css-label"></label></th><th>Profile</th>';
        
        for(var i = 0; i < select.length; i++){
    		content += '<th data-sort="string">'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></font></th>';
    	}

    	content += "</tr></thead>";
    	content += "<tbody>";
    	var url = '', tag = '';

    	/*Actor Profile displaying goes here*/
    	for(var i = 0; i < actorsInfo.length; i++){

    		url = base + 'director/actor/' + actorsInfo[i].StashActor_actor_id_ref + '/' + actorsInfo[i].StashActor_name.replace(" ", "-");

    		content += '<tr id="datarow'+i+'">'
    				+ '<td id="selectallcheckbox_">'
					+ 	'<input type="checkbox" name="checkactor" id="checkactor'+i+'" value='+i+' class="css-checkbox" /><label for="checkactor'+i+'" class="css-label"></label>'
              		+ '</td>' 
              		+ '<td style="vertical-align:middle-top;">'
                	+ 	'<div class="img-div center">'
					+		'<img src="'+base + '/assets/img/' +actorsInfo[i].StashActor_avatar+'" class="showDetails" data-id="'+i+'" />'
					+	'</div>'
              		+ '</td>';

            for(var j = 0; j < select.length; j++){
            	tag = 'StashActor_' + select[j].toLowerCase();
            	content += '<td style="vertical-align:middle;">'
                        +      '<span class="info gray scrolr">' + actorsInfo[i][tag] + '</span>'
                        + '</td>';
            }

            content += '<td style="vertical-align:middle;">'
                    +      '<font class="sortbuttons">'
                    + 			'<a href="'+url+'" target="_blank"  class="btn submit-btn firstcolor toggle-btn" style="right:50px;" >'
                    + 				'<span class="glyphicon glyphicon-share"></span>'
                    +			'</a>'
                    +			'<button  class="btn submit-btn firstcolor toggle-btn removeActor" data-actor-id="'+i+'">'
                    +				'<span class="glyphicon glyphicon-trash"></span>'
                    +			'</button>'
                    + 		'</font>'
                    + '</td></tr>';

    	}


    	content += "</tbody></table>";


    	$table.html(content);
    	$(function(){
        	$("table").stupidtable();
    	});
   		$("img").error(function () { 
    		$(this).hide(); 
		});
	}

	function getActorProfile(){
		var selectedCat = JSON.parse(Cookies.get('categories'));
		data = {request: "FetchActors", data: JSON.stringify(selectedCat)};
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				$("#prelogin").addClass("hidden");
     			$("#home").removeClass("hidden");
     			if(response.status){
     				populateActorList(response.data);
     			}else{
     				showAddActor();
     			}
			}
		});
	}

	$(document).on("click", "#filter", function(){
		if(count < 5){
			alert("Please select at least five fields");
			return false;
		}

		if(count > 5){
			alert("You have selected more than 5 categories.Please select only 5");
			return false;
		}
		var selectedCat = JSON.stringify(select);
		Cookies.set("isCat", true);
		Cookies.set("categories", selectedCat);
		getActorProfile();
		return false;
	});

	function populateCategories(){
		var categories = ['Name','Age','Height','Sex','Email','Mobile','Whatsapp','Weight','Range'];
		var c = 0;
		var $id_cate = $("#categories");
		var html = '<font class="info gray left padded left-align">Please select your categories that you would like to browse through.</font><font class="info-small gray"><i>(Any 5)</i></font>';
		for ( var i = 0; i < categories.length; i++ ){
			if(c % 3 == 0){
				if(c != 0){
					html += '</div><div class="row">';
				}else{
					html += '<div class="row">';
				}
			}

			html += '<div class="col-sm-4 vertical-padded">'
				 +	'<button type="button" class="btn taga addToCategories" aria-label="Left Align" id="'+categories[i]+'" data-cate="'+categories[i]+'">'
				 + '<font class="taga-text">'+categories[i]+'</font>'
				 + '<span class="glyphicon glyphicon-remove pull-right hidden no-top removeCate" aria-hidden="true" id="'+categories[i]+'-remove" data-cate="'+categories[i]+'"></span>'
				 + '</button></div>';
			c++
		}

		html += '</div><div class="row">'
			 +'<div class="col-sm-6 vertical-padded">'
  			 +'<input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox" />'
  			 +'<label for="checkboxG1" class="css-label">Default<br><font class="info-small">'
  			 +'<i>(Name, Age, Sex, Email, Mobile)</i></font></label>'
			 +'</div></div><div class="row vertical-padded">'
		     +'<div class="col-sm-4 vertical-padded" id="cat-btn">'
  			 +'<button type="submit" class="btn submit-btn firstcolor" id="filter"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Start</button>'
			 +'</div></div>';

		$id_cate.html(html);
	}

	$(document).on("click", "#selectallactor", function(){
		var checked = $(this).is(":checked");
		var $checkactor = $('input[name="checkactor"]');
		var id = 0, email = '', mobile = '', ref = 0;

		$("input[name='checkactor']").each(function(){
			id = Number($(this).val());
			if(checked){
				$(this).attr('checked', 'true');
				actorEmails.push(actors[id].StashActor_email);
				actorMobile.push(actors[id].StashActor_mobile);
				actorRef.push(actors[id].StashActor_actor_id_ref);
			}else{
				$(this).removeAttr("checked");
				email = actors[id].StashActor_email;
				mobile = actors[id].StashActor_mobile;
				ref = actors[id].StashActor_actor_id_ref;

				actorEmails.splice(actorEmails.indexOf(email), 1);
				actorMobile.splice(actorEmails.indexOf(mobile), 1);
				actorRef.splice(actorEmails.indexOf(ref), 1);
			}
		});

		//console.log(actorMobile, actorEmails);
	});

	$(document).on('click', 'input[name="checkactor"]', function(){
		var checked = $(this).is(":checked");
		id = Number($(this).val());
		if(checked){
			actorEmails.push(actors[id].StashActor_email);
			actorMobile.push(actors[id].StashActor_mobile);
			actorRef.push(actors[id].StashActor_actor_id_ref);
		}else{
			email = actors[id].StashActor_email;
			mobile = actors[id].StashActor_mobile;
			ref = actors[id].StashActor_actor_id_ref;

			actorEmails.splice(actorEmails.indexOf(email), 1);
			actorMobile.splice(actorEmails.indexOf(mobile), 1);
			actorRef.splice(actorEmails.indexOf(ref), 1);
		}
		//console.log(actorMobile, actorEmails);
	});

	function populateReceipents( tag ){
		var $receipents = $("#receipents");
		var receipentData = [];
		if(tag == 'email')
			receipentData = actorEmails;
		else
			receipentData = actorMobile;
		var total = receipentData.length;
		var content = '';
		if(total > 3){
			var other = total - 2;
			content = '<br>'+receipentData[0]+', '+receipentData[1]+' and <br><font class="info-small gray">'+other+' others.';
		}else{
			content = '<br>';
			for(var i = 0; i < total; i++){
				content += receipentData[i];
				if(total - i != 1)
					content += ", ";
				else
					content += ".";
			}
		}

		$receipents.html(content);
	}

	$(document).on("click", ".populateContactForm", function(){
		$('#contactmodal').removeClass("hidden");
		populateReceipents('email');
		return false;
	});

	function updateContactCheckbox() {
		var $checkbox = $(".contact-checkbox");
		var field = '', tag = '';
		$checkbox.each(function(){
			field = $(this).attr("data-field");
			if($(this).is(":checked")){
				tag += field.replace("-field", "");
				$("." + field).removeClass("hidden");
			}else{
				$("." + field).addClass("hidden");
			}
		});

		$("input[name='sendVia']").val(tag);
		if(tag == 'sms'){
			populateReceipents("mobile");
		}else{
			populateReceipents("email");
		}
	}

	$(document).on("click", ".contact-checkbox", function(){
		updateContactCheckbox();
	});

	$(document).on("click", ".sendMail", function(){
		var sendVia = $("input[name='sendVia']").val();
		var contact = {}, tag = '';
		contact['ref'] = actorRef;
		if(sendVia == 'email'){
			tag = 'email';
			contact['email'] = actorEmails;
		}else if(sendVia == 'sms'){
			tag = 'sms';
			contact['mobile'] = actorMobile;
		}else{
			tag = 'both';
			contact['email'] = actorEmails;
			contact['mobile'] = actorMobile;
		}

		var subject = $("#subject").val();
		var mail_message = $("#message").val();
		var sms_message = $("#textsms").val();
		data = {request: "ContactActors", data: JSON.stringify({contact: contact, subject: subject, mail: mail_message, sms: sms_message, tag: tag})};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				if(response.status){
     				$('#contactmodal').modal('hide');
     				$("#success_send").show(); 
    				$("#success_send").fadeTo(2000, 500).slideUp(500, function(){
        				$("#success_send").alert('close');
                	});
    			}else{
      				$("#failure_send").show();
      				$("#failure_send").fadeTo(2000, 500).slideUp(500, function(){
        				$("#failure_send").alert('close');
                	});
    			}
			}
		});
		return false;
	});

	var checkCat = Cookies.get("isCat");

	if(checkCat){
		select = JSON.parse(Cookies.get("categories"));
		getActorProfile();
	}else{
		populateCategories();
	}


	/* Advance Search Starts */

	function noActorFound(argument) {
		var $table = $("#browse-table");
		var content = '<div class="showwelcome">'
					+ '<font class="info gray">'
					+ 'Oops! It looks like no actor match your criteria. <br>Why don\'t you try changing some of the filters?'
  					+ '<br><button type="button" class="btn submit-btn firstcolor" data-toggle="modal" data-target="#advancedSearch" id="btn-login" >'
  					+ '<span class="glyphicon glyphicon-filter"></span> &nbsp; Change Filters</button></div>';
  		$table.html(content);
	}

	function showSpinner(argument) {
		var $table = $("#browse-table");
		var content = '<div class="showwelcome" id="spinner">'
					+ '<center><img src="'+base+'assets/img/logo.png" class="rotate-img center" width="80px" height="80px"/><br>'
					+ '<font class="info gray">Crunching the latest data for you!</div>';
		$table.html(content);
	}

	$(document).on("submit", "form#advanceSearch", function(){
		var that = this;
		$('#advancedSearch').modal('hide');
		showSpinner();
		var formdata = {};
		$("input", $(this)).each(function(){
			if(typeof $(this).attr("name") != 'undefined' )
				formdata[$(this).attr("name")] = $(this).val();
		});
		data = {request: "AdvanceSearch", data: JSON.stringify(formdata)};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				console.log(response);
				if(response.status){
					populateActorList(response.data);
				}else{
					noActorFound();
				}
			}
		})
		return false;
	});

	$(document).on("click", "img.showDetails", function(){
		var id = $(this).attr("data-id");
		var str = '';
		//console.log(actors[id]);
		content = '<div class="center">'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Name :<span class="gray">'+ actors[id].StashActor_name +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Email : <span class="gray">'+ actors[id].StashActor_email +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">DOB : <span class="gray">'+ actors[id].StashActor_dob +'</font>'
           +'             </div>'
           +'         </div>'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Whatsapp :<span class="gray">'+ actors[id].StashActor_whatsapp +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Phone : <span class="gray">'+ actors[id].StashActor_mobile +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Age-Range :<span class="gray"> '+ actors[id].StashActor_range+' years</font>'
           +'             </div>'
           +'         </div>'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'                 <div class="col-sm-6 " style="padding-left:0px">'
           +'                     <font class="info-medium firstcolor">Height : <span class="gray">'+ actors[id].StashActor_height +'cms</font>'
           +'                 </div>'
           +'                <div class="col-sm-6">'
           +'                    <font class="info-medium firstcolor">Weight :<span class="gray">'+ actors[id].StashActor_weight +'kgs</font>'
           +'                 </div>'
           +'             </div>'
           +'             <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Skills :<span class="gray">'+ actors[id].StashActor_skills+'</font>'
           +'             </div>'
           +'            <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Language : <span class="gray">'+ actors[id].StashActor_language+'</font>'
           +'             </div>'
           +'         </div>'
           +'         <div class="row" style="padding-right:15px;">'
           +'             <div class="DocumentList">'
           +'                 <ul class="list-inline">';
           images = JSON.parse(actors[id].StashActor_images);
           for(var k = 0;k < images.length; k++){
	            image = images[k];
	            str = base + "assets/img/actors/" + image;
	            content += '<li class="DocumentItem">'
	           +'<a href="'+str+'" data-lightbox="'+actors[id].StashActor_name+'"><img class="photo" src='+str+' height="100%" width=auto></img></a>' 
	           +'         </li>';
	        }
	        content += '                 </ul>'
                       +'             </div>'
                       +'         </div>'
                       +'     </div>'
                       +'</div> ';
        $("#actor_detail").html(content);
        $('#detailsActor').modal('show');
	});

	/*function charCounter(that, action) {
		var limit = Number($("#sms-char-left").text());
		var count = Number($("#no-of-sms").text());
		var cur = Number($(that).val().length);
		limit -= 1;
		if(diff == -1){
			limit = 160;
			count += 1;
		}

		$("#sms-char-left").html(limit);
		$("#no-of-sms").html(count);
	}

	$("#text-sms").on("keyup", function(){
		charCounter(this, 'up');
	});*/

	/*$("#text-sms").on("keydown", function(){
		charCounter(this, 'down');
	});*/

	$(document).on("submit", "form#emailInvitationForm", function(){
		var emails = $("textarea[name='emails']", $(this)).val(),
			msg = $("textarea[name='email-msg']", $(this)).val(),
			project_name = $("input[name='project_name']", $(this)).val(),
			project_date = $("input[name='project_date']", $(this)).val();

		data = {request: "EMailInvitation", data: JSON.stringify({
			emails: emails,
			msg: msg,
			project_name: project_name,
			project_date: project_date
		})};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#invite-error").removeClass("text-danger").addClass("text-success");
				}
				$("#invite-error").html(response.message).show().delay(5000).hide();
			}
		});
		return false;
	});

	$(document).on("submit", "form#smsInvitationForm", function(){
		var mobiles = $("textarea[name='mobiles']", $(this)).val(),
			msg = $("textarea[name='sms']", $(this)).val(),
			project_name = $("input[name='project_name']", $(this)).val(),
			project_date = $("input[name='project_date']", $(this)).val();

		data = {request: "SMSInvitation", data: JSON.stringify({
			mobiles: mobiles,
			msg: msg,
			project_name: project_name,
			project_date: project_date
		})};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$("#invite-error").removeClass("text-danger").addClass("text-success");
				}
				$("#invite-error").html(response.message).show().delay(5000).hide();
			}
		});
		return false;
	});

});