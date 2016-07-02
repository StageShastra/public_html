$(document).ready(function(){

	var url = base_url + "admin/ajax",
		type = "post",
		data = {};

	$(document).on("submit", "form#updatePassword", function(){
		$that = $(this);
		$(".form-group").removeClass("has-error");
		error = false;
		form = {};
		$("input[type='password']", $(this)).each(function(index, value){
			name = $(this).attr("name");
			val = $(this).val();
			if($.trim(val) == ''){
				$(this).parent().parent().addClass("has-error");
				error = true;
			}
			form[name] = val;
		});
		if(error)
			return false;

		if(form['new_pass'] != form['cnf_pass']){
			$(".err_msg").html(" New password and confirm password did not matched. ").show(500).delay(3000).hide(500);
			return false;
		}

		data = {request: "ChangePassword", data: JSON.stringify(form)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$(".err_msg").css("color", "green");
					$("input[type='password']", $that).val('');
				}
				$(".err_msg").html(response.message).show(500).delay(5000).hide(500);
			}
		});

		return false;

	});

	function previewImages(input, location){
		if (input.files && input.files[0]) {
            var reader = new FileReader();


            reader.onload = function (e) {
                $(location).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
	}

	$(document).on('change', ".live-display", function(){
		var displayIn = $(this).attr('data-for');
		previewImages(this, displayIn);
	});


	/* make admin page */

	$("#allowedPages").hide();
	var allowedPages = [];

	$(document).on("click", ".adminAuth", function(){
		opt = Number($(this).val());

		if(opt == 1){
			$("#allowedPages").hide(500);
			allowedPages = adminPages;
		}else{
			$("#allowedPages").show(500);
			allowedPages = [];
		}
	});

	$(document).on("click", ".pageInit", function(){
		id = $(this).attr("data-id");
		checked = ($(id).attr("data-checked") == 'true') ? true : false;
		$(id).attr("data-checked", !checked);		
		$(".checkbox-inline", $(id)).each(function(index, value){
			$("input[type='checkbox']", $(this)).prop("checked", !checked);
		});
		key = Number($(this).attr("data-key"));
		allowedPages[key] = adminPages[key];
		//console.log(allowedPages);
	});

	$(document).on("click", ".pageSub", function(){
		id = $(this).attr("data-id");
		checked = ($(id).attr("data-checked") == 'true') ? true : false;
		k2 = Number($(this).attr("data-key"));
		k1 = Number($(this).attr("data-key-main"));

		if(checked){
			$(id).attr("data-checked", !checked);
		}
		if($(this).is(":checked")){
			name = $(this).attr("data-name");
			method = $(this).attr("data-method");
			view = Number($(this).attr("data-view"));
			allowedPages[k1]['pages'][k2] = { name: name, method: method, view: view };
		}else{
			allowedPages[k1]['pages'][k2] = {};
		}
		 
	});

	function filterAllowedPages() {
		filteredAllowedPages = [];
		for(i = 0; i < allowedPages.length; i++){
			if( typeof allowedPages[i] == 'undefined' )
				continue;
			thisPage = {};
			thisPage['identifier'] = allowedPages[i]['identifier'],
			thisPage['name'] = allowedPages[i]['name'],
			thisPage['pages'] = [];
			pages = allowedPages[i]['pages'];
			for( j = 0; j < pages.length; j++ ){
				if(typeof pages[j]['name'] != 'undefined')
					thisPage['pages'].push( {name: pages[j]['name'], method: pages[j]['method'], view: pages[j]['view']} );
			}
			filteredAllowedPages.push(thisPage);
		}
		allowedPages = filteredAllowedPages;
		//console.log(allowedPages);
	}

	$(document).on("submit", "form#addAdminform", function(){
		filterAllowedPages();
		$("input[name='allowedpages']", $(this)).val(JSON.stringify( allowedPages ));
		return true;
	});

	$(document).on("click", ".sendMail", function(){
		message = $(".summernote").code();
		$(".summernote").destroy();
		$("textarea#mailMessage").val(message);
		//console.log(message);
		$("form#composeMail").submit();
		return false;
	});

	$(document).on("change", "input#promoCode", function(){
		$that = $(this);
		term = $(this).val();
		data = {request: "CheckPromo", data: JSON.stringify({term: term})};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				if(response.status){
					$that.parent().parent().addClass("has-error");
					$that.after("<i class='help-block m-b-none'> this promocode already used. </i>");
				}else{
					$("i.help-block").remove();
				}
			}
		});
	});


	$("#modelDisplay").modal("hide");
	modalType = '';
	autoLink_base = base_url + "admin/autoComplete/";
	director_ids = [], project_ids = [];

	$(document).on("click", ".toggleAddModal", function(){
		type = $(this).attr("data-for");
		mfor = $("#modelTBody").attr("data-for");
		if(type != mfor){
			$("#modelTBody").html("");
		}
		$("input#searchTableRefer").val("");
		modalType = type;
		autoLink = '';

		updateTableList(modalType);

		if( type == 'director' ){
			$(".updateModelTitle").html("Director");
			$("#searchTableRefer").attr("placeholder", "Type Director Name, Email, Mobile here...");
			autoLink = autoLink_base + type;
			$("#modelTBody").attr("data-for", 'director');
		}else{
			$(".updateModelTitle").html("Project");
			$("#searchTableRefer").attr("placeholder", "Type Project Name here...");
			autoLink = autoLink_base + type;
			autoLink += "?director=" + encodeURI($("input[name='director_ids']").val());
			$("#modelTBody").attr("data-for", 'project');
		}

		$("#modelDisplay").modal("show");

		$("#searchTableRefer").autocomplete({
			source: autoLink,
			minLenght: 2,
			select: function(ev, ui){
				
				id = Number(ui.item.id);
				name = ui.item.value;
				obj = {name: name, id: id};
				if( !alreadySelected( id, type ) ){
					if(type == 'director'){
						director_ids.push(obj);
						$("#modelTBody").append( "<tr> <td><a href='"+base_url+"admin/director/"+id+"'> "+name+" </a></td> <td><a href='#' class='btn-danger btn btn-xs removeFromTd' data-for='director' data-id='"+id+"'><i class='fa fa-ban'></i></a></td> </tr>" );
					}else{
						project_ids.push(obj);
						$("#modelTBody").append( "<tr> <td><a href='"+base_url+"admin/project/"+id+"'> "+name+" </a></td> <td><a href='#' class='btn-danger btn btn-xs removeFromTd' data-for='project' data-id='"+id+"'><i class='fa fa-ban'></i></a></td> </tr>" );
					}
				}else{
					alert("Already Selected...");
				}
			}
		});

		return false;
	});

	function alreadySelected(id, ty) {
		if(ty == 'director')
			arr = director_ids;
		else
			arr = project_ids;

		for( i = 0; i < arr.length; i++ ){
			if(arr[i].id == id)
				return true;
		}
		return false;
	}

	function updateTableList( arg ) {
		if(arg == 'director')
			arr = director_ids;
		else
			arr = project_ids;

		$("#modelTBody").html("");
		for( i = 0; i < arr.length; i++ ){
			name = arr[i].name;
			id = arr[i].id;
			$("#modelTBody").append( "<tr> <td><a href='"+base_url+"admin/"+arg+"/"+id+"'> "+name+" </a></td> <td><a href='#' class='btn-danger btn btn-xs removeFromTd' data-for='"+arg+"' data-id='"+id+"'><i class='fa fa-ban'></i></a></td> </tr>" );
		}
	}

	$(document).on("click", ".saveChanges", function(){
		txt = "Not Selected";
		ids = [];
		if( modalType == 'director'){
			len = director_ids.length;
			if(len){
				txt = "";
				for( i = 0; i < len; i++ ){
					txt += director_ids[i].name + ", ";
					ids.push(director_ids[i].id);
				}
				txt += len + " directors selected";
				$(".addOrUpdate").html("Change");
			}else{
				$(".addOrUpdate").html("Add");
			}
			$("#director_list").html(txt);
			$("input[name='director_ids']").val(JSON.stringify(ids));
		}else{
			len = project_ids.length;
			if(len){
				txt = "";
				for( i = 0; i < len; i++ ){
					txt += project_ids[i].name + ", ";
					ids.push(project_ids[i].id);
				}
				txt += len + " projects selected";
				$(".addOrUpdate").html("Change");
			}else{
				$(".addOrUpdate").html("Add");
			}
			$("#project_list").html(txt);
			$("input[name='project_ids']").val(JSON.stringify(ids));
		}
		$("#modelDisplay").modal("hide");
		return false;
	});

	$(document).on("click", ".removeFromTd", function(){
		ty = $(this).attr("data-for");
		id = $(this).attr("data-id");
		if(ty == 'director')
			arr = director_ids;
		else
			arr = project_ids;

		
		for( i = 0; i < arr.length; i++ ){
			if(arr[i].id == id){
				arr.splice(i, 1);
				break;
			}
		}

		$(this).parent().parent().remove();
		return false;
	});


	// Flow Chart Line...

	function flowLineChart( graphData, divId) {
		var barOptions = {
	        series: {
	            lines: {
	                show: true,
	                lineWidth: 2,
	                fill: true,
	                fillColor: {
	                    colors: [{
	                        opacity: 0.0
	                    }, {
	                        opacity: 0.0
	                    }]
	                }
	            }
	        },
	        xaxis: {
	            ticks: [[0,'Sent'],[1,'Seen'],[2,'Chose Plan'],[3,'Signed Up'],[4,'Clicked Checkout'],[5,'Paid'],[6,'Confirmed'],[7,'Completed']]
	        },
	        colors: ["#1ab394"],
	        grid: {
	            color: "#999999",
	            hoverable: true,
	            clickable: true,
	            tickColor: "#D4D4D4",
	            borderWidth:0
	        },
	        legend: {
	            show: false
	        },
	        tooltip: true,
	        tooltipOpts: {
	            content: "%y"
	        }
	    };
	    var barData = {
	        label: "bar",
	        data: graphData
	    };
	    $.plot($(divId), [barData], barOptions);
	}

	function pieChart(pro, basic, reg) {
		var data = [{
	        label: "Paid Pro",
	        data: pro,
	        color: "#d3d3d3",
	    }, {
	        label: "Basic",
	        data: basic,
	        color: "#bababa",
	    }, {
	        label: "Other",
	        data: reg,
	        color: "#79d2c0",
	    }];

	    var plotObj = $.plot($("#flot-pie-chart"), data, {
	        series: {
	            pie: {
	                show: true
	            }
	        },
	        grid: {
	            hoverable: true
	        },
	        tooltip: true,
	        tooltipOpts: {
	            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
	            shifts: {
	                x: 20,
	                y: 0
	            },
	            defaultTheme: false
	        }
	    });
	}

	if( typeof graph !== 'undefined' ){
		data = {request: "EmailGraphData", data: '{}'};
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				flowLineChart(response.data.main, '#flot-line-chart-main');
				flowLineChart(response.data.email, '#flot-line-chart');
				flowLineChart(response.data.sms, '#flot-line-chart-2');
				//console.log(response.data.main[5][1], response.data.main[8][1], response.data.main[3][1]);
				pieChart(response.data.main[5][1], response.data.main[8][1], response.data.main[3][1]);
			}
		});
	}
	

});