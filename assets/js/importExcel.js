$(document).ready(function(){

	var used = [];
	
	$(document).on("change", "#columns", function(){
		$that = $(this);
		v = Number($(this).val());
		$("#columnHeaders").show(100);
		for(var i = 1; i < 8; i++){
			b = (i > v) ? 'none' : 'block';
			$("#col" + i).css("display", b);
		}	
	});

	$(document).on("change", "select", function(){
		if($(this).val() == 'empty'){
			$(this).css("background", "#fff").css("color", "#FF003A");
		}else{
			$(this).css("background", "honeydew").css("color", "#000");
		}

		
		if(!$(this).hasClass("firstColumn")){
			i = $(this).attr("name");
			i = Number(i.replace('col', ''))-1;
			v = $(this).val().toLowerCase();
			flag = false;
			for(u in used){
				if(used[u] == v)
					flag = true;
			}
			if(flag){
				$(this).val("empty")
					.css("background", "#fff").css("color", "#FF003A");
				alert("This column name is already used.");
				return false;
			}else{
				used.push(v);
			}
		}

		checkCompletion();
	});

	var checkCompletion = function(){
		v = Number($("#columns").val());
		$("#excelFile").prop("disabled", false);
		for(i = 1; i <= v; i++){
			if($("#col" + i).val() == 'empty')
				$("#excelFile").prop("disabled", true);
		}
	};

	$(document).on("change", "#excelFile", function(){
		if($(this).val() == '')
			$("#finalSubmit").prop("disabled", true);
		else
			$("#finalSubmit").prop("disabled", false);
	});

	$(document).on("submit", 'form#excelUpload', function(){
		fields = '', flag = false;
		$("select.hiddenoption").each(function (i, v) {
			vl = $(this).val().toLowerCase();
			if(vl != 'empty'){
				if(vl == 'email' || vl == 'phone')
					flag = true;
				fields += vl+',';
			}
		});
		if(!flag){
			alert("Atleast email or phone number required.");
			return false;
		}
		fields = JSON.stringify(fields);
		$("input[name='fields']", $(this)).val(fields);
	});

});