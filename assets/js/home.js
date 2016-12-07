$(document).ready(function(){
	showSpinner();
	var count = 0,
		select = [],
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
	//autocmpletion starts

	$(".bootstrap-tagsinput input").addClass("autoCompleteSkill");

	var ac = "";

	function split( val ) {
      return val.split( /,\s*/ );
    }

	function extractList(term) {
		return split( term ).pop();
	}

	$(".autoCompleteSkill")
		.bind( "keydown", function(event){
			if( event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active ){
				event.preventDefault();
			}

			plc = $(this).attr("placeholder").replace(":", "");
			if(plc.search("Language")!=-1){
				plc="language";
				ac="tags";
			} 
			else if(plc.search("Tags")!=-1){
				plc="tags";
				ac="tags";
			}
			else if(plc.search("Searchtags")!=-1){
				plc = "searchtags";
				ac = "tags";
			}
			else {
				plc="askills";
				ac="skills";
			}
		})
		.autocomplete({
			minLength: 1,
			source: function(request, response){
				$.getJSON(base + "actor/skillSuggestions/" + ac, {
					term: extractList(request.term)
				}, response);
			},
			search: function(){
				var term = extractList(this.value);
				if(term.length < 2){
					return false;
				}
			},
			focus: function(){
				return false;
			},
			select: function(event, ui){
				var terms = split($("input#"+plc).val());
				//console.log(terms);
				//terms.pop();
				terms.push(ui.item.value);
				
				//terms.push("");
				this.value = '';
				$("input#" + plc).val($("input#" + plc).tagsinput('items'));
				$("input#" + plc).tagsinput('add', ui.item.value);
				//console.log(terms);
				return false;
			}
		});
	//autocompletion ends
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
		var totalActors = Number(actorsInfo.length);

		var ckh = (selectAll) ? "checked" : "";
		var $table = $("#browse-table");
		var content = '<span class="info-small gray pull-left">'+totalActors+' actors found.<br></span><table class="table table-striped display" id="actor_table">'
               		+ '<thead center>'
               		+ '<tr><th id="selectallcheckbox"><input type="checkbox" '+ckh+' name="selectallactor" id="selectallactor" class="css-checkbox" /><label for="selectallactor" class="css-label"></label></th><th>Profile</th>';
        
        for(var i = 0; i < select.length; i++){
    		content += '<th data-sort="string">'+select[i]+' <font class="sortbuttons"><span class="glyphicon glyphicon-sort" aria-hidden="true"></span></font></th>';
    	}

    	content += "<th>Action</th></tr></thead>";
    	content += "<tbody>";
    	var link = '', tag = '';
		
		
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
		$("#logo_start").attr("src",base+"assets/img/spinner.gif");
		data = {request: "FetchActors", data: JSON.stringify(selectedCat)};
		//console.log(data);
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				$("#logo_start").attr("src",base+"/assets/img/logo.png");
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
  					+ '<span class="glyphicon glyphicon-filter"></span> &nbsp; Change Filters</button></div><br><br><br><br><br>';
  		$table.html(content);
	}

	function showSpinner(argument) {
		var $table = $("#browse-table");
		var content = '<div class="showwelcome" id="spinner" style="margin-bottom:50px;">'
					+ '<center><img src="'+base+'assets/img/spinner.gif" /><br>'
					+ '<span class="loader_text">bringing forth your precious...</span></div>';
		$table.html(content);
	}

	$(document).on("click", ".resetAll", function(){
		var $form = $("form#" + $(this).attr("data-form"));
		$("input,textarea", $form).val("");
		$("span.label-info").remove(); 
		return false;
	});

	var searchData = {};


	$(document).on("submit", "form#advanceSearch", function(){
		var that = this;
		$('#advancedSearch').modal('hide');
		showSpinner();
		var formdata = {};
		$("input", $(this)).each(function(){
			if(typeof $(this).attr("name") != 'undefined' )
				formdata[$(this).attr("name")] = $(this).val();
		});
		formdata['dponly'] = 0;
		if($("input[name='dponly']", $(this)).is(":checked"))
			formdata['dponly'] = 1;
		searchData = formdata;
		data = {request: "AdvanceSearch", data: JSON.stringify(formdata)};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				if(response.status){
					populateActorList(response.data, 1);
					console.log(response.data);
				}else{
					$("#main-container").html("");
					noActorFound();
				}
			}
		});
		$(".filterblocks").html('');
		for (var key in searchData){
			if(typeof searchData[key] !== 'function' && searchData[key] !== ''){
				if(key == 'dponly' && searchData[key] == 0){
					continue;
				}
				if(key == 'agemin'){
					name = "Min Age: ";
				}

				if(key == 'agemax'){
					name = "Max Age: ";
				}

				if(key == 'heightmin'){
					name = "Min Height: ";
				}

				if(key == 'sex'){
					name = "Sex: ";
				}

				if(key == 'heightmax'){
					name = "Max Height: ";
				}

				btn = '<button type="button" class="btn taga taga-selected toggleSearchfilter" data-key="'+key+'"  aria-label="Left Align" id="Name" data-cate="Name">'
                    + '<font class="">'+ name + searchData[key] +'</font>'
                    + '<span class="glyphicon glyphicon-remove pull-right no-top removeSearchFilter" aria-hidden="true"></span>'
                    + '</button>';

				if(key == 'dponly' && searchData[key] == 1){
					name = "Image: ";
					btn = '<button type="button" class="btn taga taga-selected toggleSearchfilter" data-key="'+key+'" style="width:auto; min-width:1px;background-color: #FF9800; color:white;" aria-label="Left Align" id="Name" data-cate="Name">'
	                    + '<font class="">'+ name +'<i class="fa fa-check-circle-o"></i> </font>'
	                    + '<span class="glyphicon glyphicon-remove pull-right no-top removeSearchFilter" aria-hidden="true"></span>'
	                    + '</button>';
				}

				if(key == 'skills' || key == 'projects' || key == 'actor_names'|| key == 'tags'){
					peices = searchData[key].split(",");
					btn = '';
					for(k in peices){
						btn += '<button type="button" class="btn taga taga-selected toggleSearchfilter" data-key="'+key + '-' + peices[k] +'" style="width:auto; min-width:1px;background-color: #FF9800; color:white;" aria-label="Left Align" id="Name" data-cate="Name">'
		                    + '<font class="">'+ peices[k] +'</font>'
		                    + '<span class="glyphicon glyphicon-remove pull-right no-top removeSearchFilter" aria-hidden="true"></span>'
		                    + '</button>';
					}
				}
				$(".filterblocks").append(btn);	
			}
		}
		return false;
	});

	$(document).on("click", ".removeSearchFilter", function(){
		$btn = $(this).parent();
		thisKey = $btn.attr("data-key");
		$btn.remove();

		peices = thisKey.split('-');

		if(thisKey == 'dponly'){
			searchData[dponly] = 0;
		}else if(peices.length == 2){
			d = searchData[peices[0]];
			console.log(d, peices[1]);
			searchData[peices[0]] = d.replace(peices[1], "");
		}else{
			searchData[thisKey] = "";
		}

		data = {request: "AdvanceSearch", data: JSON.stringify(searchData)};
		showSpinner();
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				//console.log(response);
				if(response.status){
					populateActorList(response.data, 1);
				}else{
					$("#main-container").html("");
					noActorFound();
				}
			}
		});
	});
	
	$(document).on("click", "img.showDetails", function(){
		var id = $(this).attr("data-id");
		var str = '';
		var t = actors[id].StashActor_dob;
		var d = new Date(t * 1000);
		content = '<div class="modal-header">'
 		   +'		<button type="button" class="close" data-dismiss="modal">&times;</button>'
		   +'			<a class="firstcolor actormodaltitle" href="'+ base+actors[id].StashActor_username +'"><div class="modal-title info" style="">' + actors[id].StashActor_name + '</a></div>'
		   +'	   </div>'
		   +'      <div class="modal-body" style="height:100%;">'
		   +'      		<div class="row">'
           +'      			<div class="DocumentList">'
	           +'           	<ul class="list-inline">';
	           						images = JSON.parse(actors[id].StashActor_images);

	           						if(images.length==0 || images.length== null)
	           							content+='<li class="DocumentItem">'
	           						+'This actor has not added any photos yet.'
	           						+'</li>';

	           						for(var k = 0;k < images.length; k++){
		            				image = images[k];
		            				str = base + "assets/img/actors/" + image;
		            				content += '<li class="DocumentItem">'
		   +'						<a href="'+str+'" data-lightbox="'+actors[id].StashActor_name+'"><img class="photo" src='+str+' height="100%" width=auto></img></a>' 
		   +'         				</li>';
		        }
		        content += '                 </ul>'
               +'             </div>'
               +'       </div>'

           +'		<div class="row light-padded">'
           +'			<div class="col-lg-5" style="text-align: left;">'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Age-Range:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_range +'yrs</font>'
           +'           	</div>'
           +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Height:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_height +'cms</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Weight:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_weight +'kgs</font>'
           +'           	</div>'
           +'             	<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Email:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_email +'</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">Phone:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_mobile +'</font>'
           +'           	</div>'
		   +'          		<div class="col-lg-4">'
           +'               	<font class="info-medium firstcolor">WhatsApp:</div>' 
           +'				<div class="col-lg-8">'
           +'					<span class="gray">'+ actors[id].StashActor_whatsapp +'</font>'
           +'           	</div>'
           +'			</div>'
           +'			<div class="col-lg-7"  style="text-align: left;">'
           +'          		<div class="col-lg-12">'
           +'               	<font class="info-medium firstcolor">Projects:</div>' 
           +'				<div class="col-lg-12">'
           +'					<span class="gray">'+ actors[id].StashActor_projects +'</font>'
           +'           	</div>'
           +'				<div class="col-lg-12">'
           +'               	<a class="firstcolor actormodaltitle" href="'+ base+actors[id].StashActor_username +'"><font class="info-medium firstcolor">See videos</a></div>'
           +'			</div>'
           +'		</div>'

          

                       +'     </div><!--modal body end -->'
                       
        $("#actor_detail").html(content);
        $('#detailsActor').modal('show');

        data = {request: "QuickViewNotice", data: JSON.stringify({actor: actors[id].StashActor_actor_id_ref})};
        $.ajax({
        	url: url,
        	type: type,
        	data: data,
        	success: function(response){
        		//
        	}
        });

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


	/*
		For duplicate contacts
	*/

	var duplicateContacts = [];
	var duplicateType = '';
	var dupProject = 0;
	var dupMsgId = 0;

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
				if(response.data.duplicate != 0){
					duplicates = response.data.duplicateEmail;
					dupMsgId = response.data.msg;
					duplicateType = 'email';
					dupList = '';
					dupProject = response.data.project_id;
					for(var i = 0; i < duplicates.length; i++){
						dupList += "<span class='label label-info'>"+duplicates[i]+"</span>";
						duplicateContacts.push(duplicates[i]);
					}
					$("#contactsDuplicate").html(dupList);
					$("#successInvitation").modal("show");
				}else{
					$("#inviteSuccessMsg").html(response.message);
					$("#inviteSuccess").modal("show");
				}
				$("#inviteActors").hide();
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
				if(response.data.duplicate != 0){
					duplicates = response.data.duplicateNums;
					dupMsgId = response.data.msg;
					dupProject = response.data.project_id;
					dupList = '';
					duplicateType = 'sms';
					for(var i = 0; i < duplicates.length; i++){
						dupList += "<span class='label label-info'>"+duplicates[i]+"</span>";
						duplicateContacts.push(duplicates[i]);
					}
					$("#contactsDuplicate").html(dupList);
					$("#successInvitation").modal("show");
				}else{
					$("#inviteSuccessMsg").html(response.message);
					$("#inviteSuccess").modal("show");
				}
				$("#inviteActors").hide();
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
		show_loader(target);
		data = {request: "ContactList", data: JSON.stringify({ for: thisfor })};
		$(target + " table tbody").html("");
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				data = response.data;
				var prehtml="<table><tbody>";
				for( i = 0; i < data.length; i++ ){
					txt1 = ( data[i].others != 0 ) ? " and " + data[i].others + " others" : "";

					txt2 = "<button class='sentto'> "+ data[i].first.charAt(0).toUpperCase() +" </button>";
					txt2 += "			<span class='row_text'> "+ data[i].first + txt1 +"</span>";

					if(typeof data[i].firstUser != "undefined"){
						if(data[i].firstUser.avatar != 'default.png'){
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
					   //hide_loader(target);
					prehtml+=tr;
					//console.log(target + " table tbody");

				}
				$(target ).html(prehtml);
			}
		});
	});

	if( typeof convo != 'undefined' ){
		if( convo ){
			$("#clickFirst").trigger("click");
		}
	}
	function show_loader(id)
	{	var text = "conversations are being loaded..."
		var content = '<div class="loader"><img src="'+base+'assets/img/spinner.gif" height="300"><br><span class="loader_text">'+text+'</span></div>';
		$(id).html(content);
		console.log(content);
	}
	function hide_loader(id)
	{
		$(id).html("");	
	}
	function populateForInviteConv( obj, that, thisId, thisfor ) {
		contacts = obj.users;
		usertr = "";
		for( i = 0; i < contacts.length; i++ ){
			a = ( typeof contacts[i].avatar == 'undefined' ) ? "default.png" : contacts[i].avatar;
			if(typeof contacts[i].avatar == 'undefined'){
				img = "<button class='sentto'> "+ contacts[i].name.charAt(0).toUpperCase() +" </button>";
			}else{
				if(contacts[i].avatar == 'default.png'){
					img = "<button class='sentto'> "+ contacts[i].name.charAt(0).toUpperCase() +" </button>";
				}else{
					img = "<img src='"+base+"assets/img/actors/"+contacts[i].avatar+"' class='thumbnails_small'>";
				}
			}
			usertr += "<tr>"
				   + "<td class='col-sm-2 vertical_middle'>"+ img +"</td>"
				   + "<td class='col-sm-4 row_text vertical_middle'>"+contacts[i].name+"<br><span class='contact_info'>"+contacts[i].contact+"</span></td>"
				   + "<td class='col-sm-3 vertical_middle'><span class='label label-"+contacts[i].label+"'>"+contacts[i].status+"</span></td>"
				   + "</tr>";
		}

		div1 = "<div class='col-sm-4 reciepients'><table class='messages table table-striped'><tbody> "+ usertr +" </tbody></table></div>";
		msg = obj.msg[2];
		iframeSrc = base + "director/emailPreview/?msg=" + encodeURI( msg );
		div2 = "<div class='col-sm-6'><iframe src='"+iframeSrc+"' class='center' id='emailPreviewiFrame' width='600' height='500'></iframe></div>";
		div3 = "<div class='col-sm-2'>"
			 + "<div class='conversation_summary'><h3>Conversation Summary</h3><hr>"
			 + "<span class='row_text'>Recipients: "+ obj.recipient +" </span><br>"
			 + "<span class='row_text'>Responses</span><br>"
			 + "<button class='btn btn-danger'>Pending: <span class='badge'>"+obj.pending+"</span></button>"
			 + "<button class='btn btn-info'>Seen: <span class='badge'>"+obj.seen+"</span></button>"
			 + "<button class='btn btn-success'>Joined: <span class='badge'>"+obj.used+"</span></button>"
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
			if(typeof contacts[i].avatar == 'undefined'){
				img = "<button class='sentto'> "+ contacts[i].name.charAt(0).toUpperCase() +" </button>";
			}else{
				if(contacts[i].avatar == 'default.png'){
					img = "<button class='sentto'> "+ contacts[i].name.charAt(0).toUpperCase() +" </button>";
				}else{
					img = "<img src='"+base+"assets/img/actors/"+contacts[i].avatar+"' class='thumbnails_small'>";
				}
			}
			usertr += "<tr>"
				   + "<td class='col-sm-2 vertical_middle'>"+img+"</td>"
				   + "<td class='col-sm-4 row_text vertical_middle'>"+contacts[i].name+"<br><span class='contact_info'>"+contacts[i].contact+"</span></td>"
				   + "<td class='col-sm-3 vertical_middle'><span class='label label-"+contacts[i].label+"'>"+contacts[i].status+"</span></td>"
				   + "</tr>";
		}

		div1 = "<div class='col-sm-4 reciepients'><table class='messages table table-striped'><tbody> "+ usertr +" </tbody></table></div>";
		msg = obj.msg[2];
		iframeSrc = base + "director/emailPreview/?msg=" + encodeURI( msg );
		div2 = "<div class='col-sm-6'><iframe src='"+iframeSrc+"' class='center' id='emailPreviewiFrame' width='600' height='500'></iframe></div>";
		div3 = "<div class='col-sm-2'>"
			 + "<div class='conversation_summary'><h3>Conversation Summary</h3><hr>"
			 + "<span class='row_text'>Recipients: "+ obj.recipient +" </span><br>"
			 + "<span class='row_text'>Responses</span><br>"
			 + "<button class='btn btn-info'>Seen: <span class='badge'>"+obj.seen+"</span></button>"
			 + "<button class='btn btn-success'>Yes: <span class='badge'>"+obj.yes+"</span></button>"
			 + "<button class='btn btn-danger'>No: <span class='badge'>"+obj.no+"</span></button>"
			 + "<button class='btn btn-warning'>Maybe: <span class='badge'>"+obj.maybe+"</span></button>"
			 + "<br></div></div>";

		fianlTr = "<td colspan='12'><div class='row'>"+ div1 + div2 + div3 +"</div></td>";
		$(".convo-trs").hide();
		$("#convo-"+thisfor + "-" + thisId).html(fianlTr).show(500);
		 $('#email_table').DataTable();
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


	$(document).on("click", ".toggleEditTagBox", function(){
		if(Number($(this).attr("data-hide"))){
			$(this).addClass("hidden");
			$("#backcustomtag").removeClass("hidden");
			$(".bulkUserRemove").addClass("hidden");
			$(".toggleProjectBox").addClass("hidden");
			$(".edittag-box").removeClass("animated fadeOutRight");
			$(".edittag-box").addClass("animated fadeInRight");
			$(".edittag-box").removeClass("hidden");
			$(this).attr("data-hide", 0);
		}
		else{
			$(".edittag-box").removeClass("animated fadeInRight");
			$(".edittag-box").addClass("animated fadeOutRight");
			$(".toggleEditTagBox").removeClass("hidden");
			$(".bulkUserRemove").removeClass("hidden");
			$(".toggleProjectBox").removeClass("hidden");
			$(this).attr("data-hide", 1);
			(".edittag-box").addClass("hidden");
			$("#backcustomtag").removeClass("hidden");
			
		}
		return false;
	});

	$(document).on("click", ".backTag", function(){
		//alert("rajul");
		$(".edittag-box").hide(500);
		$(document).on(".toggleEditTagBox").attr("data-hide",1);

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
	$(document).on("click", ".confirmeditTag", function(){
		conf = confirm("Are you sure to tag them with these tags ?");
		if(conf){
			/*pid = Number($("#addPName").attr("data-id"));
			if(pid == 0){
				$("#addPName").after("<p class='help-text text-danger'> Please select a project first. </p>");
				return false;
			}*/
			toAdd = [];
			for(i = 0; i < actorRef.length; i++){
				id = actorRef[i];
				toAdd.push(Number(actors[id].StashActor_actor_id_ref));
			}
			

			 tag = $("#tags").val();
			 //alert(tag);

			data = {request: "BulkCustomTag", data: JSON.stringify({list: toAdd, listid: actorRef, tag: tag})};
			console.log(data);
			$.ajax({
				url: url,
				type: type,
				data: data,
				success: function(response){
					$("#bulkActionModel").modal("hide");
					//$("#tagErr").html(response.message).show(500).delay(3000).hide(500);
					if(response.status){
						
						$("#feedback").removeClass("error_feedback");
						$("#feedback").removeClass("hidden");
						$("#feedback").addClass("alert-success");
						$("#tags").val("");
						$("#feedback").addClass("animated fadeInUp");
						$("#feedback").html("Tags succesfully added");
						$("#feedback").show(500).delay(5000).hide(500);
					//	$("#feedback").addClass("hidden");

					}
					else
					{   
						$("#feedback").removeClass("hidden");
						$("#feedback").removeClass("alert-success");
						$("#feedback").addClass("error_feedback");
						$("#feedback").addClass("animated fadeInUp");
						$("#feedback").html(response.message);
						$("#feedback").show(500).delay(5000).hide(500);
						//$("#feedback").addClass("hidden");
					}

				}
				
			});

		}
		return false;
	});
	$(document).on("click", ".changePassword", function(){
		cur_p = $("input[name='current_passowrd']").val();
		new_p = $("input[name='new_passowrd']").val();
		con_p = $("input[name='confirm_passowrd']").val();
		if(con_p != new_p){
			$("#changepassword_err").html("New password and Confirm password did not match.").show(500).delay(3000).hide(500);
			return false;
		}
		data = {request: "ChangePasswordIn", data: JSON.stringify({ current: cur_p, password: new_p, confirm: con_p })};
		$.ajax({
			url: url,
			type: type,
			data: data, 
			success: function(response){
				$("#changepassword_err").html(response.message).show(500).delay(3000).hide(500);
				if(response.status){
					setTimeout(function(){
						window.location.href = base;
					}, 5000);
				}
			}
		});
		return false;
	});

	$(document).on("click", ".duplicateTags", function(){
		data = {request: "BulkDupTag", data: JSON.stringify({contacts: duplicateContacts, type: duplicateType, project: dupProject})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				$("#dupTagSucessMsg").html(response.message);
				$("#successInvitation").modal("hide");
				$("#dupTagSucess").modal("show");
			}
		});
		return false;
	});
	$(document).on("click", ".duplicateReInvite", function(){
		data = {request: "BulkDupReInvite", data: JSON.stringify({contacts: duplicateContacts, type: duplicateType, project: dupProject, msgID: dupMsgId})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				$("#dupTagSucessMsg").html(response.message);
				$("#successInvitation").modal("hide");
				$("#dupTagSucess").modal("show");
			}
		});
		return false;
	});












	// Code for Director Page/Profile

	function previewImages(input, location){
		if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function (e) {
                $(".img-preview img").attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
	}

	var topAlertDisplay = function(msg) {
		w = $(window).width();
		$alert = $(".top-alert-bar");
		aw = $alert.width();
		dw = w/2 - aw/2;
		$alert.css("left", dw);
		$alert.find('p').html(msg);
		$alert.show(100).delay(3000).hide(100);	
	};

	$(document).on('change', ".showPreview", function(){
		//var displayIn = $(this).attr('data-for');
		previewImages(this);
	});

	$(document).on("submit", "form#form-directorpage-first", function(){
		form = new FormData(this);
		$.ajax({
			url: base + "director/directorpageupdate",
			type: type,
			data: form,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response){
				topAlertDisplay(response.message);
				//$.delay(500);
				if(response.status){
					$activeAccord = $(".accordion.active");
					$nextAcord = $activeAccord.next().next();
					$nextAcord.addClass("active");
					$nextAcord.next().addClass("show");

					$("html, body").animate({
						scrollTop: $nextAcord.offset().top - 200
					}, 1000);
				}
				
			}
		});
		return false;
	});

	$(document).on("change", "select#no-of-teammates", function(){
		n = Number($(this).val());
		

		teamtr = $("tr.dummy-tr").html();
		totTr = $(".teammates tbody tr").length;
		$allTbodyTr = $(".teammates tbody tr");
		$eleTbody = $(".teammates tbody");
		if(n == totTr)
			return;
		else if(n > totTr){
			nw = n-totTr;
			if(nw == 0)
				topAlertDisplay('Please select atleast 1 team member.');
			for(i = 0; i < nw; i++){
				newTr = "<tr>"+teamtr+"</tr>";
				$eleTbody.append(newTr);
			}
		}else{
			nw = totTr-n;
			if(nw <= totTr)
				nw = totTr-nw-1;
			for(i = totTr-1; i > nw; i--){
				$allTbodyTr.eq(i).remove();
			}
		}
		//console.log(n, totTr, nw);

		$("#teammates").removeClass("hidden");
	});

	/*$(document).on("click", ".update-page-team", function(){
		$allTbodyTr = $(".teammates tbody tr");
		d = [];
		
		$allTbodyTr.each(function(){
			tmp = {};
			tmp['name'] = $(this).find("input[name='name']").val();
			tmp['title'] = $(this).find("input[name='title']").val();
			tmp['desc'] = $(this).find("input[name='desc']").val();
			tmp['imdb'] = $(this).find("input[name='imdb']").val();
			tmp['fb'] = $(this).find("input[name='fb']").val();
			d.push(tmp);
		});

		data = {
			request: 'TeamUpdate',
			data: JSON.stringify(d)
		};

		$.ajax({
			url: base + "director/secure/",
			type: type,
			data: data,
			success: function(response){
				topAlertDisplay(response.message);
				if(response.status){
					$activeAccord = $(".accordion.active");
					$nextAcord = $activeAccord.next().next();
					$nextAcord.addClass("active");
					$nextAcord.next().addClass("show");

					$teamTable = $("table#display-team-detail tbody");
					team = response.data.team;
					i=0;
					tr = '';
					for(t = 0; t < team.length; t++){
						
						i++;
						tr += "<tr><td>"+i+"</td>"
						   + "<td>"+ team[t].DirectorTeam_name +"</td>"
						   + "<td>"+ team[t].DirectorTeam_title +"</td>"
						   + "<td>"+ team[t].DirectorTeam_desc +"</td>"
						   + "<td>"+ team[t].DirectorTeam_imdb +"</td>"
						   + "<td>"+ team[t].DirectorTeam_fb +"</td>"
						   + "<td><a href='#' class='team-member-delete' data-member-ref='"+team[t].DirectorTeam_id+"'><i class='fa fa-trash'><></a></td></tr>";
						
					}
					$teamTable.append(tr);
				}
			}
		})
		return false;
	});*/

	$(document).on("click", ".page-project-update", function(){
		$projectInputs = $(".projectinput");
		d = {};
		$projectInputs.find("input, select").each(function(){
			if($(this).attr("type") == 'radio'){
				name = $(this).attr("name");
				d[$(this).attr("name")] = $("input[name='"+name+"']:checked").val();
			}else{
				d[$(this).attr("name")] = $(this).val();
			}
			
		});
		data = {
			request: "AddProjectWork",
			data: JSON.stringify(d)
		};
		$.ajax({
			url: base + "director/secure",
			type: type,
			data: data,
			success: function(response){
				topAlertDisplay(response.message);
				if(response.status){
					pwork = response.data.work;
					console.log(pwork);
					$displayPWork = $("#display-project-work");
					div = '';
					for(i = 0; i < pwork.length; i++){
						div += '<div class="col-lg-1 removesidepadding" data-work-ref="'+ pwork[i].DirectorWork_id +'"><span class="glyphicon glyphicon-eye-open"> </span> &nbsp;<span class="glyphicon glyphicon-pencil p-work-edit"></span> &nbsp; <span class="glyphicon glyphicon-trash p-work-delete"> </span></div>'
							+ '<div class="col-lg-11 removesidepadding"> <b>'+pwork[i].DirectorWork_title+'</b> '+ pwork[i].DirectorWork_producer + '  ' + pwork[i].DirectorWork_date +' </div>';
						
					}
					$displayPWork.html(div);

					$activeAccord = $(".accordion.active");
					$nextAcord = $activeAccord.next().next();
					$nextAcord.addClass("active");
					$nextAcord.next().addClass("show");

					$("#projectform").toggleClass('hidden');
  					$("#newprojectbutton").toggleClass('hidden');
				}
			}
		})
		return false;
	});

	$(document).on("change", "input[name='contactustext']", function(){
		if($(this).val() == '')
			return false;


		data = {
			request: "UpdateContactText",
			data: JSON.stringify({ text: $(this).val() })
		};

		$.ajax({
			url: base + "director/secure",
			type: type,
			data: data,
			success: function(response){
				topAlertDisplay(response.message);
			}
		})
	});

	$(document).on("click", ".team-member-delete", function(){
		$that = $(this);
		conf = confirm("You are sure to remove member from the list ?");
		if(!conf)
			return false;

		member_ref = $(this).attr("data-member-ref");
		data = {
			request: "DeleteTeamMember",
			data: JSON.stringify({member_ref: member_ref})
		};
		$.ajax({
			url: base + "director/secure",
			type: type,
			data: data,
			success: function(response){
				topAlertDisplay(response.message);
				if(response.status){
					$that.parent().parent().remove();
				}
			}
		});
		return false;
	});

	$(document).on("click", ".p-work-delete", function(){
		$that = $(this);
		conf = confirm("You are sure to remove this work ?");
		if(!conf)
			return false;

		work_ref = $(this).parent().attr("data-work-ref");
		data = {
			request: "DeleteDirectorWork",
			data: JSON.stringify({work_ref: work_ref})
		};
		$.ajax({
			url: base + "director/secure",
			type: type,
			data: data,
			success: function(response){
				topAlertDisplay(response.message);
				if(response.status){
					$parent = $that.parent();
					$next = $parent.next();

					$parent.remove();
					$next.remove();
				}
			}
		});
		return false;
	});

	$(document).on("keyup", "input[name='companyurl']", function(){
		v = $(this).val();
		$("#pagename-typing").text(v);
		if(v == '')
			return false;
		if(v.match(/^[a-zA-Z0-9_\-\.]+$/i) == null){
			$("#pagename-typing-error").css("color", 'red').text("special character not allowed accept ( . _ - )");
		}else{
			$("#pagename-typing-error").text("");
		}
	});

	$("input[name='companyurl']").change(function(){
		name = $(this).val();
		if(name.length < 6){
			$("#pagename-typing-error").css("color", 'red').text("Page link cannot be less then 6 characters");
			return false;
		}else{
			$("#pagename-typing-error").text("");
		}

		data = {
			request: "CheckPageName",
			data: JSON.stringify({pagename: name})
		};
		$.ajax({
			url: base + "director/secure",
			type: type,
			data: data,
			success: function(response){
				c = 'red';
				if(response.status)
					c = 'green';
				$("#pagename-typing-error").css("color", c).html(response.message);
			}
		});
	});


	$(document).on("click", ".displayFullWorkDetail", function(){
		$that = $(this);
		$displayArea = $(".videoprojectcard");
		ref = $(this).attr("data-work-ref");
		ytube = $(this).attr("data-ytube");
		embed = 'https://www.youtube.com/embed/' + ytube;
		parseWorkJSON = JSON.parse(WorkJSON);
		thisWork = parseWorkJSON[ref];

		$(".videoprojectmedia iframe").attr("src", embed);
		$tds = $(".videoprojecttable tr td:last-child");
		/*tds.each(function(){
			$(this).text("Dilip");
		});*/
		$tds.eq(0).text(thisWork.DirectorWork_title);
		$tds.eq(1).text(thisWork.DirectorWork_producer);
		$tds.eq(2).text(thisWork.DirectorWork_date);
		$tds.eq(3).text(thisWork.DirectorWork_remark);

		statusApp = (thisWork.DirectorWork_work_status == 1) ? 'Accepting application!' : 'Application closed!';
		$tds.eq(4).text(statusApp);

		return false;
	});

	$(document).on("click", ".upload-trigger", function(){
		//console.log($(this).parent().find("input[type='file']"));
		$(this).parent().find("input[type='file']").click();
		//return false;
	});

	$(document).on("change", ".team-pic", function(){
		$that = $(this);
		if (this.files && this.files[0]) {
            var reader = new FileReader();


            reader.onload = function (e) {
                $that.prev().attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
		
	});

	$(document).on("click", ".update-page-team", function(){
		form = new FormData();
		$allTbodyTr = $(".teammates tbody tr");
		d = [];
		i = 0;
		$allTbodyTr.each(function(){
			tmp = {};
			tmp['name'] = $(this).find("input[name='name']").val();
			tmp['title'] = $(this).find("input[name='title']").val();
			tmp['desc'] = $(this).find("input[name='desc']").val();
			tmp['imdb'] = $(this).find("input[name='imdb']").val();
			tmp['fb'] = $(this).find("input[name='fb']").val();
			tmp['image'] = $(this).find("input[type='file']")[0].files[0];
			if(typeof tmp['image'] == 'undefined')
				i = 1;
			form.append("name[]", tmp['name']);
			form.append("desc[]", tmp['desc']);
			form.append("title[]", tmp['title']);
			form.append("imdb[]", tmp['imdb']);
			form.append("fb[]", tmp['fb']);
			form.append("image[]", tmp['image']);
			
		});

		if(i){
			topAlertDisplay("Please upload image for team member.");
			return false;
		}

		$.ajax({
			url: base + "director/teamUpload",
			type: type,
			data: form,
			contentType: false,
			cache: false,
			processData: false,
			success: function(response){
				topAlertDisplay(response.message);
				if(response.status){
					$activeAccord = $(".accordion.active");
					$nextAcord = $activeAccord.next().next();
					$nextAcord.addClass("active");
					$nextAcord.next().addClass("show");

					$("#teammates").hide(100);

					$teamTable = $("table#display-team-detail tbody");
					team = response.data.team;
					i=0;
					tr = '';
					for(t = 0; t < team.length; t++){
						
						i++;
						tr += "<tr><td>"+i+"</td>"
						   + "<td>"+ team[t].DirectorTeam_name +"</td>"
						   + "<td>"+ team[t].DirectorTeam_title +"</td>"
						   + "<td>"+ team[t].DirectorTeam_desc +"</td>"
						   + "<td>"+ team[t].DirectorTeam_imdb +"</td>"
						   + "<td>"+ team[t].DirectorTeam_fb +"</td>"
						   + "<td><a href='#' class='team-member-delete' data-member-ref='"+team[t].DirectorTeam_id+"'><i class='fa fa-trash'><></a></td></tr>";
						
					}
					$teamTable.append(tr);
				}
			}
		})
		return false;
	});

});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
});



//This is not yet working it is a partial code copied from act.js



