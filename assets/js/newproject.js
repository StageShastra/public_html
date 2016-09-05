var roles=[];
var role_id_count=0;
var role_count=0;
var questions=[];
var q_count=0;
var project_id;
$(document).ready(function(){
$(document).on("click", ".toggleEdit", function(){

		var unhide = $(this).attr("data-unhide-id");
		var hide = $(this).attr("data-hide-id");
		$(unhide).removeClass("hidden");
		$(hide).addClass("hidden");

		//console.log(hide, unhide);

	});

});
function edit_role(id){
	$("#role_"+id).addClass("hidden"); //hides that role
	$("#request_input").val("update"); //sets request arameter as update
	$("#role_id_input").val(id); //sets role id
	$("#add_role_form_submit").attr("data-unhide-id","#add_role_form_open,#role_"+id); //sets data-hide-id for edit
	$("#add_role_form_close").attr("data-unhide-id","#add_role_form_open,#role_"+id); //sets data-hide-id for edit
	$("#add_role_form").removeClass("hidden"); //makes the form visible
	$("#role_input").val(roles[id].role_name); // fills the form
	$("#role_description_input").val(roles[id].role_description); //fills the role description
	$("#role_scenes_input").val(roles[id].role_scenes);
	$("#add_role_form_close").removeClass("hidden");
	
	
}
function add_role(){
	$("#request_input").val("add");
	$("#roleid_input").val(0);
	

}
function role_add_edit()
{	
	//case when you add a new role
	if($("#request_input").val()=="add"){
		var role={};
		if($("#role_input").val()=="" || $("#role_description_input").val()=="" || $("#role_input_scenes").val()=="" )
		{
			$("#add_edit_form_not_valid").removeClass("hidden");
			$("#add_edit_form_info").removeClass("hidden");
			return;

		}
		role.role_name=$("#role_input").val();
		role.role_description=$("#role_description_input").val();
		role.role_scenes=$("#role_scenes_input").val();
		role.role_status=1;
		roles[role_count]=role;
		append_role(role_count);
		role_count++;
		$("#add_edit_form_info").addClass("hidden");

	}
	//case 1 ends

	//case when you edit an existing role
	if($("#request_input").val()=="update"){
		var id=$("#role_id_input").val();
		if($("#role_input").val()=="" || $("#role_description_input").val()=="" || $("#role_input_scenes").val()=="" )
		{
			$("#add_edit_form_not_valid").removeClass("hidden"); //post validation
			$("#add_edit_form_info").removeClass("hidden"); //post validation
			return;

		}
		roles[id].role_name=$("#role_input").val(); //editing the values in object
		roles[id].role_description=$("#role_description_input").val(); //editing the values in object
		roles[id].role_scenes=$("#role_scenes_input").val(); //editing the values in object

		$("#role_name_"+id).html("+ "+roles[id].role_name); //updating view with new role name
		$("#add_edit_form_info").addClass("hidden");
		
	}	
}
function remove_role(id){
	roles[id].role_status=0;
	$("#role_"+id).addClass("hidden");

}
function append_role(id){
	var prehtml=$("#role_list").html();
	var appendHTML='<span class="role-plus" id="role_'+id+'">'
                   +'<span id="role_name_'+id+'"class="role_name">+ '+roles[id].role_name+'</span>'
                   +'<span class="glyphicon glyphicon-pencil" onclick="edit_role('+id+')"></span>'
                   +'<span class="glyphicon glyphicon-trash"  onclick="remove_role('+id+')"></span>'
                   +'<br>'
                   +'</span>';
    prehtml=appendHTML+prehtml;
    $("#role_list").html(prehtml);

}
function form_submit(){
	var title=$("#title").val();
	var client = $("#client").val();
	var shoot_begins = $("#shoot_begins").val();
	var shoot_ends = $("#shoot_ends").val();
	var project_date = $("#project_date").val();
	if(title=="" || client=="" || shoot_begins=="" || project_date=="" || role_count==0)
	{
		alert("Please fill the form completely");
		return;
	}
	var isAud=1;
	data = {request: "createNewPorject",
	 		data: JSON.stringify({
	 								project_name: title, 
	 								project_client: client, 
	 								project_date: project_date,
	 								project_shoot_begins: shoot_begins,
	 								project_shoot_ends:shoot_ends, 
	 								isAud: isAud}
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				project_id=response;
				save_roles(response);
			}
		});
}
function save_roles(id)
{	
	for(i=0;i<roles.length;i++)
	{
		if(roles[i].role_status!=0)
		{	
			index=i;
			data = {request: "createNewRole",
	 		data: JSON.stringify({
	 								role_name: roles[i].role_name, 
	 								role_description: roles[i].role_description, 
	 								role_scenes: roles[i].role_scenes,
	 								role_project: id
	 							 }
	 							)};

		$.ajax({
			url: url,
			type: type,
			data: data,
			async:false,
			success: function(response){
				set_role_id(i,response);
				
			}
		});
		}

	}
	show_question_dashboard();
	
}
function set_role_id(i, id){
	roles[i].role_id=id;
	console.log(roles);
}
function show_question_dashboard(){
	$("#create_project_home").addClass("animated fadeOut");
	$("#create_project_home").addClass(" hidden");
	$("#set_questions").removeClass("hidden");
	$("#set_questions").addClass("animated fadeIn");
	$("body").scrollTop(0);
	var prehtml=$("#question_role_options").html();
	for(i=0;i<roles.length && roles[i].role_status!=0;i++)
	{	
		prehtml+='<option value="'+i+'">'+roles[i].role_name+'</option>';
	}
	$("#question_role_options").html(prehtml);
}
function edit_question(id){
	$("#question_"+id).addClass("hidden"); //hides that role
	$("#request_input_q").val("update"); //sets request arameter as update
	$("#question_id_input_q").val(id); //sets role id
	$("#add_question_form_submit").attr("data-unhide-id","#add_question_form_open,#question_"+id); //sets data-hide-id for edit
	$("#add_role_form_close").attr("data-unhide-id","#add_question_form_open,#question_"+id); //sets data-hide-id for edit
	$("#add_question_form").removeClass("hidden"); //makes the form visible
	$("#question_input").val(questions[id].question_description); // fills the form
	$("#question_role_options").val(questions[id].q_addto); //fills the question description
	$("#question_type_all").val(questions[id].q_type); //fills the question description
	$("#add_question_form_close").removeClass("hidden");
	
	
}
function add_question(){
	$("#request_input_q").val("add");
	$("#roleid_input_q").val(0);
	

}
function add_edit_question()
{	
	//case when you add a new role
	if($("#request_input_q").val()=="add"){
		var question={};
		if($("#question_input").val()=="" || $("#question_role_options").val()=="" || $("#question_type_all").val()=="" )
		{
			$("#add_edit_form_not_valid_q").removeClass("hidden");
			$("#add_edit_form_info_q").removeClass("hidden");
			return;
		}


		question.question_description=$("#question_input").val();
		question.q_addto=$("#question_role_options").val();
		question.q_type=$("#question_type_all").val();
		question.q_status=1;
		questions[q_count]=question;
		append_question(q_count);
		q_count++;
		$("#add_edit_form_info_q").addClass("hidden");


	}
	//case 1 ends

	//case when you edit an existing role
	if($("#request_input_q").val()=="update"){
		var id=$("#question_id_input_q").val();
		if($("#question_input").val()=="" || $("#question_role_options").val()=="" || $("#question_type_all").val()=="")
		{
			$("#add_edit_form_not_valid_q").removeClass("hidden");
			$("#add_edit_form_info_q").removeClass("hidden");
			return;

		}
		questions[id].question_description=$("#question_input").val(); //editing the values in object
		questions[id].q_addto=$("#question_role_options").val(); //editing the values in object
		questions[id].q_type=$("#question_type_all").val() //editing the values in object

		$("#question_name_"+id).html("Q. "+questions[id].question_description); //updating view with new role name
		$("#add_edit_form_info_q").addClass("hidden");
		$("#add_question_form").addClass("hidden");
		add_question_form
	}	
}
function remove_question(id){
	questions[id].q_status=0;
	$("#question_"+id).addClass("hidden");

}
function append_question(id){
	var prehtml=$("#question_list").html();
	var appendHTML='<span class="role-plus" id="question_'+id+'">'
                   +'<span id="question_name_'+id+'"class="role_name">Q. '+questions[id].question_description+'</span>'
                   +'<span class="glyphicon glyphicon-pencil" onclick="edit_question('+id+')"></span>'
                   +'<span class="glyphicon glyphicon-trash"  onclick="remove_question('+id+')"></span>'
                   +'</span><br>';
    prehtml=appendHTML+prehtml;
    $("#question_list").html(prehtml);

}
function question_submit(){
	for(i=0;i<questions.length && questions[i].q_status!=0;i++)
	{	
		index=i;
		if(questions[i].q_addto==-1)
		{
			for(k=0;k<roles.length && roles[k].role_status!=0;k++)
			{	
				save_link_question(i,roles[k].role_id,project_id);
			}
		}
		else
		{
			save_link_question(index,roles[questions[index].q_addto].role_id,project_id);
		}
		
	}
	window.location.assign("http://castiko.com/director/castingsheet/"+project_id);

}
function save_link_question(q_index,role_id,project_id)
{
	var question = questions[q_index].question_description;
	var question_type = questions[q_index].q_type;
	var question_addto = role_id;
	var project_id = project_id;
	console.log(questions);
	console.log("q_type "+question_type);
	console.log("question_addto "+question_addto);
	console.log("Question was "+question);
	console.log("index to see in roles " +q_index);
	console.log(roles);
	console.log("================================");
	data = {request: "insertNewQuestion",
	 		data: JSON.stringify({
	 								question: question, 
	 								question_type: question_type, 
	 								question_addto: question_addto,
	 								project_id: project_id,
	 							 }
	 							)};
	 		//console.log(data);

		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response){
				console.log(response);
			}
		});
}