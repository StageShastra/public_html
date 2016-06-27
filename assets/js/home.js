$(document).ready(function(){
	
	//For Main Sevrer

	var url = "/public_html/ajax/",
		base = "/public_html/";
		
	//For Localhost
	/*var url = "/Castiko/beta/ajax/",
		base = "/Castiko/beta/";
	*/
	
	var count = 0,
		select = [],
		type = "POST",
		data = {},
		actors = [],
		actorEmails = [],
		actorMobile = [],
		actorRef = [],
		selectAll = false;

	$("#success_send").hide();
	$("#failure_send").hide();
	$(".notice-selected-actors").hide();
	$('#contactmodal').modal('hide');
	
	
	function removeDefaultCookies(){
		Cookies.remove("newInvite");
		Cookies.remove("project_ref");
		Cookies.remove("director_ref");
	}
	removeDefaultCookies();

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
	
	function setDefaultCategory(checked){
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
	}

	$(document).on("click", 'input[name="checkboxG1"]', function(){
		var checked = $(this).is(":checked");
		var list = ['Name','Age','Sex','Email','Mobile'];
		setDefaultCategory(checked);
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
		var m = (isAllowed) ? "inviteActors" : "notAllowedModal";
		var $div = $("#browse-table");
  			content = '<div class="showwelcome"><font class="info gray">Hola! It looks like you are new here. <br>Why don\'t you start with inviting some actors?'
  					+ '<br><button type="submit" class="btn submit-btn firstcolor"  data-toggle="modal" data-target="#'+m+'" id="btn-login" ><span class="glyphicon glyphicon-plus"></span> &nbsp;Invite  Actor</button></div>';
  			$div.html(content);
	}
	
	function appendPagination(current, total) {
		var li_1 = "";
		var cls = (current == 1) ? "" : "changePage";
		if(current == 1)
			li_1 = "<li class='disabled'><span aria-hidden='true'>&laquo;</span></li>"
		else
			li_1 = "<li><a href='#' aria-label='Previous' class='"+cls+"' data-page-no='"+(current-1)+"'><span aria-hidden='true'>&laquo;</span></a></li>";
		
		var content = "	<nav>"
					+ "		<ul class='pagination pagination-lg'>"
					+ li_1;
					for(var p = 1; p <= total; p++){
						if(current == p)
							content += "<li class='active'><a href='#'>" + p + "  <span class='sr-only'>(current)</span></a></li>";
						else
							content += "<li><a href='#' class='changePage' data-page-no='"+p+"'>" + p + "</a></li>";
					}
					cls = (current == total) ? "" : "changePage";
					if(current == total)
						li_1 = "<li class='disabled'><span aria-hidden='true'>&raquo;</span></li>"
					else
						li_1 = "<li><a href='#' aria-label='Next' class='"+cls+"' data-page-no='"+(current+1)+"'><span aria-hidden='true'>&raquo;</span></a></li>";
					content += li_1 + "</ul>"
							+ "</nav>";
		//console.log(current, total);
		$("#main-container").html(content);
	}

	function populateActorList(actorsInfo, currentPage){
		actors = actorsInfo;
		var ckh = (selectAll) ? "checked" : "";
		var $table = $("#browse-table");
		var content = '<table class="table table-striped display" id="actor_table">'
               		+ '<thead center>'
               		+ '<tr><th id="selectallcheckbox"><input type="checkbox" '+ckh+' name="selectallactor" id="selectallactor" class="css-checkbox" /><label for="selectallactor" class="css-label"></label></th><th>Profile</th>';
        
        for(var i = 0; i < select.length; i++){
    		content += '<th data-sort="string">'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></font></th>';
    	}

    	content += "<th>Link</th></tr></thead>";
    	content += "<tbody>";
    	var link = '', tag = '';
		
		var totalActors = Number(actorsInfo.length);
    	var maxActors = 20;
    	var totalPages = Math.ceil(totalActors/maxActors);
    	var init = (currentPage * maxActors) - maxActors;
    	var actorCovered = (currentPage - 1) * maxActors;
    	var actorLeft = totalActors - actorCovered;
    	var final = (actorLeft >= maxActors) ? maxActors : actorLeft;
		
		final = init + final;
    	/*Actor Profile displaying goes here*/
    	for(var i = init; i < final; i++){
			
			//username = $.trim(actorsInfo[i].StashActor_email.split("@")[0]);
			link = base + actorsInfo[i].StashActor_username;

    		if($.inArray(i, actorRef) != -1){
				chk = "checked";
			}else{
				chk = "";
			}

    		content += '<tr id="datarow'+i+'">'
    				+ '<td id="selectallcheckbox_" style="vertical-align:middle;">'
					+ 	'<input type="checkbox" name="checkactor" '+chk+' id="checkactor'+i+'" value='+i+' class="css-checkbox" /><label for="checkactor'+i+'" class="css-label"></label>'
              		+ '</td>' 
              		+ '<td style="vertical-align:middle-top;">'
                	+ 	'<div class="center">'
					+		'<img src="'+base + 'assets/img/actors/' +actorsInfo[i].StashActor_avatar+'" class="showDetails profile_image" data-id="'+i+'" />'
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
                    + 			'<a href="'+link+'" target="_blank"> <span class="glyphicon glyphicon-share row_btn"></span>'
                    +			'</a>'
                    +				'<span class="glyphicon glyphicon-trash removeActor row_btn" data-actor-id="'+i+'"></span>'
                    + 		'</font>'
                    + '</td></tr>';

    	}


    	content += "</tbody></table>";
		appendPagination(currentPage, totalPages);


    	$table.html(content);
    	$(function(){
        	$("table").stupidtable();
    	});
   		$("img").error(function () { 
    		$(this).hide(); 
		});
	}
	
	$(document).on("click", ".changePage", function(){
		var page = Number($(this).attr("data-page-no"));
		//console.log("page changed");
		populateActorList(actors, page);
		checkContactModal();
		return false;
	});

	function getActorProfile(){
		var selectedCat = JSON.parse(Cookies.get('categories'));
		$("#logo_start").addClass("rotate-img");
		data = {request: "FetchActors", data: JSON.stringify(selectedCat)};
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				$("#logo_start").removeClass("rotate-img");
				$("#prelogin").addClass("hidden");
     			$("#home").removeClass("hidden");
     			if(response.status){
     				populateActorList(response.data, 1);
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
			c++;
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
		var count = 0;
		var $noticeBox = $(".notice-selected-actors");
		actorEmails = [];
		actorMobile = [];
		actorRef = [];
		$noticeBox.show();
		if(checked){
			selectAll = true;
			$checkactor.prop("checked", true);
			count = actors.length;
			for(var i = 0; i < count; i++){
				actorEmails.push(actors[i].StashActor_email);
				actorMobile.push(actors[i].StashActor_mobile);
				actorRef.push(i);
			}
			$("p span", $noticeBox).html(count);
			$("#totalSelected").html(count);
			//console.log("All Selected");
			populateReceipents('name');
		}else{
			selectAll = false;
			$checkactor.prop("checked", false);
			$("p span", $noticeBox).html(0);
			$("#totalSelected").html(0);
			$(".selectedActors").html("");

			setTimeout(function(){
				$noticeBox.hide();
			}, 1000);
		}
		//console.log(actorMobile, actorEmails, actorRef);
	});

	function appendReceipents(id) {
		var content = "";
		//username = $.trim(actors[id].StashActor_email.split("@")[0]);
		username = actors[id].StashActor_username;
		link = base + username;
		content += '<div class="media selected-actors" id="selected-actor-'+id+'">'
				+  '	<div class="media-left">'
				+  '		<a href="'+link+'" target="_blank" class="selected-act-img">'
				+  '			<img class="media-object " src="'+base+'assets/img/actors/'+actors[id].StashActor_avatar+'">'
				+  ' 		</a>'
				+  '	</div>'
				+  '	<div class="media-body selected-act-name">'
				+  '		<a href="'+link+'" target="_blank">'+ actors[id].StashActor_name + '</a>'
				+  '	</div>'
				+  '	<div class="media-right selected-act-remove" data-actor-id="'+id+'"><a href="#">x</a></div>'
				+  '</div>';
		$(".selectedActors").append(content);
		checkContactModal();
	}

	$(document).on('click', 'input[name="checkactor"]', function(){
		var checked = $(this).is(":checked");
		id = Number($(this).val());
		var $noticeBox = $(".notice-selected-actors");
		$noticeBox.show();
		if(checked){
			actorEmails.push(actors[id].StashActor_email);
			actorMobile.push(actors[id].StashActor_mobile);
			actorRef.push(id);
			//console.log("append triggered", id);
			appendReceipents(id);
		}else{
			email = actors[id].StashActor_email;
			mobile = actors[id].StashActor_mobile;
			ref = id;

			actorEmails.splice(actorEmails.indexOf(email), 1);
			actorMobile.splice(actorMobile.indexOf(mobile), 1);
			actorRef.splice(actorRef.indexOf(ref), 1);

			$(".selectedActors #selected-actor-" + id).addClass("animated fadeOut");
			setTimeout(function(){
				$(".selectedActors #selected-actor-" + id).remove();
			}, 500);
			//console.log("remove append triggered");
		}
		$("p span", $noticeBox).html(actorRef.length);
		$("#totalSelected").html(actorRef.length);

		if(actors.length == actorRef.length){
			$("#selectallactor").prop("checked", true);
			selectAll = true;
		}else{
			$("#selectallactor").prop("checked", false);
			selectAll = false;
		}

		if(actorRef.length == 0){
			//$("p span", $noticeBox).html(0);
			setTimeout(function(){
				$noticeBox.hide();
			}, 1000);
		}
		//console.log(actorMobile, actorEmails, actorRef);

	});

	function deleteAllSelected(argument) {
		$(".selectedActors").html("");
		actorEmails = [];
		actorMobile = [];
		actorRef = [];
		$('input[name="checkactor"]').prop("checked", false);
		$("#selectallactor").prop("checked", false);
		selectAll = false;
		var $noticeBox = $(".notice-selected-actors");
		$("p span", $noticeBox).html(0);
		$("#totalSelected").html(0);
		setTimeout(function(){
			$noticeBox.hide();
		}, 1000);
	}

	$(document).on("click", "#deleteAllSelectedBtn", function(){
		var conf = confirm("Are you sure to remove all selected actors ?");
		if(conf){
			deleteAllSelected();
		}
		return false;
	});

	function populateReceipents( tag ){
		var id = 0;
		var content = "";
		//console.log("populateReceipents", actorRef);
		$(".selectedActors").html("");
		for(var i = 0; i < actorRef.length; i++){
			id = actorRef[i];
			//username = $.trim(actors[id].StashActor_email.split("@")[0]);
			username = actors[id].StashActor_username;
			link = base + username;
			content += '<div class="media selected-actors" id="selected-actor-'+id+'">'
					+  '	<div class="media-left">'
					+  '		<a href="'+link+'" target="_blank" class="selected-act-img">'
					+  '			<img class="media-object " src="'+base+'assets/img/actors/'+actors[id].StashActor_avatar+'">'
					+  ' 		</a>'
					+  '	</div>'
					+  '	<div class="media-body selected-act-name">'
					+  			actors[id].StashActor_name
					+  '	</div>'
					+  '	<div class="media-right selected-act-remove" data-actor-id="'+id+'"><a href="#">x</a></div>'
					+  '</div>';
		}
		$(".selectedActors").html(content);
		checkContactModal();
	}
	//$('#contactmodal').modal("show");
	$(document).on("click", ".populateContactForm", function(){
		$(".notice-selected-actors").hide();
		$('#contactmodal').removeClass("hidden");
		//populateReceipents('email');
		return false;
	});

	$(document).on("click", ".bulk-btn", function(){
		$(".notice-selected-actors").hide();
		$('#bulkActionModel').removeClass("hidden");
		//populateReceipents('email');
		return false;
	});

	$(document).on("click", ".selected-act-remove", function(){
		var id = Number($(this).attr("data-actor-id"));
		var $noticeBox = $(".notice-selected-actors");
		email = actors[id].StashActor_email;
		mobile = actors[id].StashActor_mobile;
		ref = id;

		actorEmails.splice(actorEmails.indexOf(email), 1);
		actorMobile.splice(actorMobile.indexOf(mobile), 1);
		actorRef.splice(actorRef.indexOf(ref), 1);

		$("#selected-actor-" + id).addClass("animated fadeOut");
		setTimeout(function(){
			$("#selected-actor-" + id).remove();
		}, 500);

		$("#checkactor" + id).prop("checked", false);
		$("#selectallactor").prop("checked", false);
		count = actorRef.length;
		$("#totalSelected").html(count);
		$("p span", $noticeBox).html(count);

		selectAll = false;

		return false;
	});

	function checkContactModal() {
		var hidden = $("#contactmodal").attr("aria-hidden");
		if(hidden == 'false'){
			console.log("Open");
			$(".notice-selected-actors").hide();
		}
	}

	/*function updateContactCheckbox() {
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
	});*/

	$(document).on("click", ".sendMail", function(){
		var conf = confirm("Are you sure you want to send this message ?");
		if(!conf)
			return false;
		
		var contact = {};
		var tempRef = [];
		for(var i = 0; i < actorRef.length; i++){
			//console.log(actors[actorRef[i]].StashActor_actor_id_ref);
			tempRef.push(actors[actorRef[i]].StashActor_actor_id_ref);
		}
		contact['email'] = actorEmails;
		contact['ref'] = tempRef;

		var subject = $("#subject").val();
		var mail_message = $("#message").val();
		project_name = $("#cEmail_PName").val();
		project_date = $("#cEmail_PDate").val();
		isAud = 0;
		if($("#emailCheck").is(":checked"))
			$isAud = 1;

		data = {request: "ContactActorByEmail", data: JSON.stringify({isAud: isAud, contact: contact, subject: subject, mail: mail_message, project_name: project_name, project_date: project_date})};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				$('#contactmodal').modal('hide');
				$("#inviteSuccessMsg").html(response.message);
				$("#inviteSuccess").modal("show");
				setTimeout(function(){
					$("#inviteSuccess").modal("hide");
				}, 3000);
			}
		});
		return false;
	});

	$(document).on("click", ".sendSMS", function(){
		var conf = confirm("Are you sure you want to send this message ?");
		if(!conf)
			return false;
		
		
		var contact = {};
		var tempRef = [];
		for(var i = 0; i < actorRef.length; i++){
			//console.log(actors[actorRef[i]].StashActor_actor_id_ref);
			tempRef.push(actors[actorRef[i]].StashActor_actor_id_ref);
		}
		contact['mobile'] = actorMobile;
		contact['ref'] = tempRef;

		project_name = $("#cSMS_PName").val();
		project_date = $("#cSMS_PDate").val();
		isAud = 0;
		if($("#smsCheck").is(":checked"))
			$isAud = 1;

		var sms_message = $("#textsms").val();
		data = {request: "ContactActorBySMS", data: JSON.stringify({contact: contact, sms: sms_message, project_name: project_name, project_date: project_date, isAud: isAud})};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				$('#contactmodal').modal('hide');
				$("#inviteSuccessMsg").html(response.message);
				$("#inviteSuccess").modal("show");
				setTimeout(function(){
					$("#inviteSuccess").modal("hide");
				}, 3000);
			}
		});
		return false;
	});

	var checkCat = Cookies.get("isCat");

	if(checkCat){
		select = JSON.parse(Cookies.get("categories"));
		getActorProfile();
	}else{
		//setDefaultCategory(true);
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

	$(document).on("click", ".resetAll", function(){
		var $form = $("form#" + $(this).attr("data-form"));
		$("input,textarea", $form).val("");
		$("span.label-info").remove(); 
		return false;
	});

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
					populateActorList(response.data, 1);
				}else{
					$("#main-container").html("");
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
		var t = actors[id].StashActor_dob;
		var d = new Date(t * 1000);
		content = '<div class="center">'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Name:<span class="gray">'+ actors[id].StashActor_name +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Email: <span class="gray">'+ actors[id].StashActor_email +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">DOB: <span class="gray">'+ d.getUTCDate() + '-' + (d.getUTCMonth() + 1)+ '-' + d.getUTCFullYear()+'</font>'
           +'             </div>'
           +'         </div>'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Whatsapp: <span class="gray">'+ actors[id].StashActor_whatsapp +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Phone: <span class="gray">'+ actors[id].StashActor_mobile +'</font>'
           +'             </div>'
           +'             <div class="col-sm-4">'
           +'                 <font class="info-medium firstcolor">Age-Range: <span class="gray"> '+ actors[id].StashActor_range+' years</font>'
           +'             </div>'
           +'         </div>'
           +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4">'
           +'					<font class="info-medium firstcolor">Height: <span class="gray">'+ actors[id].StashActor_height +'cms</font>'
           +'             </div>'
           +'             <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Weight: <span class="gray">'+ actors[id].StashActor_weight +'kgs</font>'
           +'             </div>'
           +'            <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Language: <span class="gray">'+ actors[id].StashActor_language+'</font>'
           +'             </div>'
           +'         </div>'
		   +'         <div class="row collapsedetail">'
           +'             <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Skills: <span class="gray">'+ actors[id].StashActor_skills+'</font>'
           +'             </div>'
           +'            <div class="col-sm-4 scrolr">'
           +'                 <font class="info-medium firstcolor">Projects: <span class="gray">'+ actors[id].StashActor_projects+'</font>'
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

	function smsCharCounter(textbox, countID, msgID) {
		txt = $.trim($(textbox).val());
		len = txt.length;
		if(len >= 579){
			$(textbox).val(txt.substring(0, 280));
			alert("character limit exceed.");
			return;
		}
		reminder = 160 - (len % 160);
		numMsg = Math.ceil(len / 160);
		$(countID).html(reminder);
		$(msgID).html(numMsg);
		//console.log(txt, len, reminder, numMsg);
	}

	$("#text-sms").on("keyup", function(){
		smsCharCounter("#text-sms", "#invite-charCounter", "#invite-msgCounter");
	});

	$("#text-sms").on("change", function(){
		smsCharCounter("#text-sms", "#invite-charCounter", "#invite-msgCounter");
	});

	$("#textsms").on("keyup", function(){
		smsCharCounter("#textsms", "#audi-charCounter", "#audi-msgCounter");
	});

	$("#textsms").on("change", function(){
		smsCharCounter("#textsms", "#audi-charCounter", "#audi-msgCounter");
	});

	$(document).on("submit", "form#emailInvitationForm", function(){
		var conf = confirm("Are you sure you want to send this message ?");
		if(!conf)
			return false;
		var that = this;
		var emails = $("textarea[name='emails']", $(this)).val(),
			msg = $("textarea[name='email-msg']", $(this)).val(),
			project_name = $("input[name='project_name']", $(this)).val(),
			project_date = $("input[name='project_date']", $(this)).val(),
			subject = $("input[name='subject']", $(this)).val();

		data = {request: "EMailInvitation", data: JSON.stringify({
			emails: emails,
			msg: msg,
			project_name: project_name,
			project_date: project_date,
			subject: subject
		})};
		console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				/* if(response.status){
					//$("#invite-error").removeClass("text-danger").addClass("text-success");
					$("input, textarea", $(that)).val('');
				}
				//$("#invite-error").html(response.message).show().delay(5000); */
				$("#inviteSuccessMsg").html(response.message);
				$("#inviteActors").hide();
				$("#inviteSuccess").modal("show");
			}
		});
		return false;
	});

	$(document).on("submit", "form#smsInvitationForm", function(){
		var conf = confirm("Are you sure you want to send this message ?");
		if(!conf)
			return false;
		var that = this;
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
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				/* if(response.status){
					$("#invite-error").removeClass("text-danger").addClass("text-success");
					$("input, textarea", $(that)).val('');
				}
				$("#invite-error").html(response.message).show().delay(5000); */
				$("#inviteSuccessMsg").html(response.message);
				$("#inviteActors").hide();
				$("#inviteSuccess").modal("show");
			}
		});
		return false;
	});
	
	$(document).on("click", "a.changeCategory", function(){
		
		Cookies.remove("isCat");
		location.reload();
		return false;
	});
	
	$(document).on("click", ".resetAllContact", function(){
		document.getElementById('subject').value="";
		document.getElementById('message').value="";
		document.getElementById('textsms').value="";
		return false;
	});
	
	$(".projectName").autocomplete({
		source: base + "home/autoComplete/",
		minLenght: 2,
		select: function(ev, ui){
			console.log(ui);
			$("input[name='project_date']").val(ui.item.date);
		}
	});

	$("#addPName").autocomplete({
		source: base + "home/autoComplete/",
		minLenght: 2,
		select: function(ev, ui){
			console.log(ui);
			$("input#addPName").val(ui.item.name);
			$("input#addPName").attr("data-id", Number(ui.item.id));
		}
	}); 
	
	$(document).on("click", ".addSuggestionText", function(){
		var name = $(this).attr("data-name");
		var txt = $("textarea[name='"+name+"']").val();
		console.log(txt);
		var add = $(this).attr("data-add");
		txt += " " + add;
		$("textarea[name='"+name+"']").val(txt);
		smsCharCounter("#text-sms", "#invite-charCounter", "#invite-msgCounter");
		//console.log(txt, name);
		return false;
	});

	$(document).on("click", ".previewEmailBtn", function(){
		txtId = $(this).attr("data-id");
		txt = $(txtId).val();
		txt = encodeURI(txt);
		src = base + "director/emailPreview/?msg=" + txt;
		if(txtId == "#emailtxtMsg"){
			src += "&link=%23&linkname=Accept+Invitation";	
		}
		$("#emailPreviewiFrame").attr("src", src);
		$("#emailPreview").modal("show");
		return false;
	});

	$(document).on("click", ".previewSMSBtn", function(){
		txtId = $(this).attr("data-id");
		msg = $(txtId).val();
		msg = msg.split("\n");
		txt = "Dear Actor,<br>";
		for(var i = 0; i < msg.length; i++){
			txt += msg[i];
			txt += "<br>";
			if($.trim(msg[i]) == '')
				txt += "<br>";
		}

		if(txtId == "#text-sms"){
			txt = txt + "<br>http://invite.castiko.com/AG8hik";
		}

		txt = txt + "<br>Powered By Castiko";
		$("#previewSMSTxt").html(txt);
		$("#previewSMS").modal("show");
		return false;
	});
	$(document).on("click", ".toggleview", function(){
		var unhide = $(this).attr("data-unhide-id");
		if($(unhide).toggle('slow'));
		//console.log(hide, unhide);
	});

	$(document).on("click", ".addPrevMessage", function(){
		$that = $(this);
		from = $(this).attr("data-from");
		offset = parseInt($(this).attr("data-offset"));
		data = {request: "LastMessages", data: JSON.stringify({ from: from, offset: offset })};
		name = $(this).attr("data-name");
		

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if( response.status ){
					$("textarea[name='"+name+"']").val( response.data.msg );
					//offset += 1;
					$that.attr("data-offset", response.data.offset);
				}
				$("#displaydate-" + from).html(response.message);

			}
		});

		return false;
	});

	$(document).on("click", "a.contactListNav", function(){
		$that = $(this);
		thisfor = $(this).attr("data-for");
		target = $(this).attr("href");
		data = {request: "ContactList", data: JSON.stringify({ for: thisfor })};
		$(target + " table tbody").html("");
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				data = response.data;
				for( i = 0; i < data.length; i++ ){
					txt1 = ( data[i].others != 0 ) ? " and " + data[i].others + " others" : "";

					txt2 = "<button class='sentto'> "+ data[i].first.charAt(0).toUpperCase() +" </button>";
					txt2 += "			<span class='row_text'> "+ data[i].first + txt1 +"</span>";

					if(typeof data[i].firstUser != "undefined"){
						if(data[i].firstUser.avatar){
							txt2 = "<img src='"+base+"assets/img/actors/"+ data[i].firstUser.avatar +"' class='thumbnails'>";
							txt2 += "			<span class='row_text'> "+ data[i].firstUser.name + txt1 +"</span>";
						}
					}


					tr = "";
					tr += "<tr class='nextRowData' data-hide='0' data-id='"+data[i].id+"' data-for='"+thisfor+"'>"
					   + "	<td class='col-sm-3'>"
					   + "		<div class='addresse_details'>"
					   + 			txt2
					   + "	</div></td>"
					   + "	<td class='col-sm-8 subject'>"+data[i].subject[1]+"</td>"
					   + "	<td class='col-sm-1 sent_on'> "+ data[i].date +" </td>"
					   + "</tr><tr class='convo-trs' id='convo-"+thisfor+"-"+data[i].id+"' style='display:none;'></tr>";

					$(target + " table tbody").append(tr);
					//console.log(target + " table tbody");

				}
			}
		});
	});

	if( typeof convo != 'undefined' ){
		if( convo ){
			$("#clickFirst").trigger("click");
		}
	}

	function populateForInviteConv( obj, that, thisId, thisfor ) {
		contacts = obj.users;
		usertr = "";
		for( i = 0; i < contacts.length; i++ ){
			a = ( typeof contacts[i].avatar == 'undefined' ) ? "default.png" : contacts[i].avatar;
			usertr += "<tr>"
				   + "<td class='col-sm-2 vertical_middle'><img src='"+base+"assets/img/actors/"+a+"' class='thumbnails_small'></td>"
				   + "<td class='col-sm-4 row_text vertical_middle'>"+contacts[i].name+"<br><span class='contact_info'>"+contacts[i].contact+"</span></td>"
				   + "<td class='col-sm-3 vertical_middle'><span class='label label-"+contacts[i].label+"'>"+contacts[i].status+"</span></td>"
				   + "</tr>";
		}

		div1 = "<div class='col-sm-3 reciepients'><table class='messages table table-striped'><tbody> "+ usertr +" </tbody></table></div>";
		msg = obj.msg[2];
		iframeSrc = base + "director/emailPreview/?msg=" + encodeURI( msg );
		div2 = "<div class='col-sm-6'><iframe src='"+iframeSrc+"' class='center' id='emailPreviewiFrame' width='600' height='500'></iframe></div>";
		div3 = "<div class='col-sm-3'>"
			 + "<div class='conversation_summary'><h3>Conversation Summary</h3><hr>"
			 + "<span class='row_text'>Recipients: "+ obj.recipient +" </span>"
			 + "<span class='row_text'>Responses</span><br>"
			 + "<button class='btn btn-info'>Seen: <span class='badge'>"+obj.seen+"</span></button>"
			 + "<button class='btn btn-info'>Joined: <span class='badge'>"+obj.used+"</span></button>"
			 + "<button class='btn btn-info'>Pending: <span class='badge'>"+obj.pending+"</span></button>"
			 + "<br></div></div>";

		fianlTr = "<td colspan='12'><div class='row'>"+ div1 + div2 + div3 +"</div></td>";
		$(".convo-trs").hide();
		$("#convo-"+thisfor + "-" + thisId).html(fianlTr).show(500);
	}

	function populateForAuditionConv( obj, that, thisId, thisfor ) {
		contacts = obj.users;
		usertr = "";
		for( i = 0; i < contacts.length; i++ ){
			a = ( typeof contacts[i].avatar == 'undefined' ) ? "default.png" : contacts[i].avatar;
			usertr += "<tr>"
				   + "<td class='col-sm-2 vertical_middle'><img src='"+base+"assets/img/actors/"+a+"' class='thumbnails_small'></td>"
				   + "<td class='col-sm-4 row_text vertical_middle'>"+contacts[i].name+"<br><span class='contact_info'>"+contacts[i].contact+"</span></td>"
				   + "<td class='col-sm-3 vertical_middle'><span class='label label-"+contacts[i].label+"'>"+contacts[i].status+"</span></td>"
				   + "</tr>";
		}

		div1 = "<div class='col-sm-3 reciepients'><table class='messages table table-striped'><tbody> "+ usertr +" </tbody></table></div>";
		msg = obj.msg[2];
		iframeSrc = base + "director/emailPreview/?msg=" + encodeURI( msg );
		div2 = "<div class='col-sm-6'><iframe src='"+iframeSrc+"' class='center' id='emailPreviewiFrame' width='600' height='500'></iframe></div>";
		div3 = "<div class='col-sm-3'>"
			 + "<div class='conversation_summary'><h3>Conversation Summary</h3><hr>"
			 + "<span class='row_text'>Recipients: "+ obj.recipient +" </span>"
			 + "<span class='row_text'>Responses</span><br>"
			 + "<button class='btn btn-info'>Seen: <span class='badge'>"+obj.seen+"</span></button>"
			 + "<button class='btn btn-info'>Yes: <span class='badge'>"+obj.yes+"</span></button>"
			 + "<button class='btn btn-info'>No: <span class='badge'>"+obj.no+"</span></button>"
			 + "<button class='btn btn-info'>Maybe: <span class='badge'>"+obj.maybe+"</span></button>"
			 + "<br></div></div>";

		fianlTr = "<td colspan='12'><div class='row'>"+ div1 + div2 + div3 +"</div></td>";
		$(".convo-trs").hide();
		$("#convo-"+thisfor + "-" + thisId).html(fianlTr).show(500);
	}

	$(document).on("click", ".nextRowData", function(){
		if( Number($(this).attr("data-hide")) ){
			$(".convo-trs").hide();
			$(this).attr("data-hide", 0);
			return false;
		}else{
			$(this).attr("data-hide", 1);
		}
		that = this;
		thisfor = $(this).attr("data-for");
		thisId = $(this).attr("data-id");

		data = {request: "ContactData", data: JSON.stringify({id: thisId, for: thisfor})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if( thisfor == 'iEmail' || thisfor == 'iSMS' )
					populateForInviteConv( response.data, that, thisId, thisfor );
				else
					populateForAuditionConv( response.data, that, thisId, thisfor );
			}
		})
		return false;
	});

	$(document).on("click", ".bulkUserRemove", function(){
		
		conf = confirm( "Are you sure to remove selected Actor from your list ?" );
		if(!conf)
			return false;

		toRemove = [];
		for(i = 0; i < actorRef.length; i++){
			id = actorRef[i];
			toRemove.push(Number(actors[id].StashActor_actor_id_ref));
		}

		data = {request: "BulkRemove", data: JSON.stringify({list: toRemove, listid: actorRef})};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if( response.status ){
					removed = response.data.removed;
					for( i = 0; i < removed.length; i++ ){
						//console.log('#datarow'+removed[i]);
						$('#datarow'+removed[i]).remove();
					}
					deleteAllSelected();
				}else{
					alert(response.message);
				}
			}
		});

	});

	$(document).on("click", ".toggleProjectBox", function(){
		if(Number($(this).attr("data-hide"))){
			$(".project-box").show(500);
			$(this).attr("data-hide", 0);
		}
		else{
			$(".project-box").hide(500);
			$(this).attr("data-hide", 1);
		}
		return false;
	});

	$(document).on("click", ".confirmTag", function(){
		conf = confirm("Are you sure to tag them in selected project ?");
		if(conf){
			pid = Number($("#addPName").attr("data-id"));
			if(pid == 0){
				$("#addPName").after("<p class='help-text text-danger'> Please select a project first. </p>");
				return false;
			}
			toAdd = [];
			for(i = 0; i < actorRef.length; i++){
				id = actorRef[i];
				toAdd.push(Number(actors[id].StashActor_actor_id_ref));
			}

			data = {request: "BulkProjectTag", data: JSON.stringify({list: toAdd, listid: actorRef, project: pid})};

			$.ajax({
				url: url,
				type: type,
				data: data,
				success: function(response){
					$("#tagProjectErr").html(response.message).show(500).delay(3000).hide(500);
					if(response.status){
						$("#addPName").val("");
					}
				}
			});

		}
		return false;
	});

});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
