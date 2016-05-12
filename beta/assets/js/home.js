$(document).ready(function(){

	var count = 0,
		select = [],
		url = "/public_html/beta/ajax/",
		type = "POST",
		data = {},
		base = "/public_html/beta/",
		actors = [],
		actorEmails = [],
		actorMobile = [];

	$("#success_send").hide();
	$("#failure_send").hide();  
	$('#contactmodal').modal('hide');

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
  			content = '<div class="showwelcome"><font class="info gray">Ola! It looks like you are new over here. <br>Why don\'t you start with inviting some actors?'
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
    		content += '<th data-sort="string">'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span> <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></font></th>';
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
					+		'<img src="'+base + '/assets/img/' +actorsInfo[i].StashActor_avatar+'" />'
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
		var id = 0, email = '', mobile = '';

		$("input[name='checkactor']").each(function(){
			id = Number($(this).val());
			if(checked){
				$(this).attr('checked', 'true');
				actorEmails.push(actors[id].StashActor_email);
				actorMobile.push(actors[id].StashActor_mobile);
			}else{
				$(this).removeAttr("checked");
				email = actors[id].StashActor_email;
				mobile = actors[id].StashActor_mobile;

				actorEmails.splice(actorEmails.indexOf(email), 1);
				actorMobile.splice(actorEmails.indexOf(mobile), 1);
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
		}else{
			email = actors[id].StashActor_email;
			mobile = actors[id].StashActor_mobile;

			actorEmails.splice(actorEmails.indexOf(email), 1);
			actorMobile.splice(actorEmails.indexOf(mobile), 1);
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
				console.log(response);
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

});