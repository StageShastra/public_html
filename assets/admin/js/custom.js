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

});